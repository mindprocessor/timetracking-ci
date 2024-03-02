<?php

namespace Track\Controllers\Admin;
use Exception;
use Track\Controllers\MainController; 


class AdminUsersController extends MainController{
    
    public function users(){
        $users = $this->model_users->orderBy('username')->find();
        return view('\Track\Views\admin\users\users', [
            'users'=>$users,
        ]);
    }


    public function user($id){
        $user = $this->model_users->firstOrFail($id);
        $timelogs = $this->model_checking->orderBy('id', 'DESC')
            ->where('users_id', $user['id'])
            ->limit(5)->find();

        return view('\Track\Views\admin\users\user', [
            'user'=>$user,
            'timelogs'=>$timelogs,
        ]);
    }

    public function editRecord($id){ //user.id
        $user = $this->model_users->firstOrFail($id);
        $level_choices = ['user', 'admin'];

        if($user['superadmin']){
            if(current_user()->superadmin == false){
                session()->setFlashdata('fmsg', alert('danger', 'Action is not allowed'));
                return redirect()->to("admin/user/id/{$id}");
            }
        }

        $pdata = [
            'username'  =>$user['username'],
            'eid'       =>$this->request->getPost('eid') ?? $user['eid'],
            'first_name'=>$this->request->getPost('first_name') ?? $user['first_name'],
            'last_name' =>$this->request->getPost('last_name') ?? $user['last_name'],
            'account'   =>$this->request->getPost('account') ?? $user['account'],
            'level'     =>$this->request->getPost('level') ?? $user['level'],
            'email'     =>$this->request->getPost('email') ?? $user['email'],
        ];

        if($this->request->is('post')){
            $v = $this->validation;
            $v->setRule('eid', 'Employee ID', 'required');
            $v->setRule('first_name', 'First name', 'required');
            $v->setRule('last_name', 'Last name', 'required');
            $v->setRule('account', 'Account', 'required');
            $v->setRule('level', 'Level', 'required|in_list[user,admin]');
            $v->setRule('email', 'Email', 'valid_email|permit_empty');

            if($v->withRequest($this->request)->run()){
                $eid_exist = $this->model_users->where('eid', $pdata['eid'])->where('id !=', $id)->countAllResults();
                if($eid_exist > 0){
                    $msg = alert('danger', 'Employee ID is taken');
                    session()->setFlashdata('fmsg', $msg);
                }else{
                    try{
                        $this->model_users->update($id, $pdata);
                        $msg = alert('success', 'Changes was saved');
                        session()->setFlashdata('fmsg', $msg);
                        return redirect()->to('admin/user/id/'.$id);
                    }catch(Exception $e){
                        $msg = alert('danger', "Something went wrong! [{$e}]");
                        session()->setFlashdata('fmsg', $msg);
                    }
                }
            }else{
                $errors = $v->getErrors();
            }
        }

        return view('\Track\Views\admin\users\edit_record', [
            'user'=>$user,
            'pdata'=>$pdata,
            'errors'=>$errors ?? [],
            'level_choices'=>$level_choices,
        ]);        
    }


    public function changePassword($id){ //users.id
        /** only superadmin can change password for admin users */
        $user = $this->model_users->firstOrFail($id);

        if($user['level'] == 'admin'){
            if(current_user()->superadmin == false){
                $msg = alert('danger', 'Action not allowed!');
                session()->setFlashdata('fmsg', $msg);
                return redirect()->to("admin/user/id/{$id}");
            }
        }

        if($this->request->is('post')){
            $v = $this->validation;
            $v->setRule('new_password', 'New password', 'required|min_length[5]');
            $v->setRule('current_password', 'Current password', 'required');

            if($v->withRequest($this->request)->run()){
                $new_password_data = $this->request->getPost('new_password');
                $current_password_data = $this->request->getPost('current_password');
                $new_password = gen_hash($new_password_data);
                
                if(gen_hash($current_password_data) == current_user()->password){
                    try{
                        $this->model_users->update($id, [
                            'password' => $new_password,
                        ]);
                        $msg = alert('success','Password was updated');
                        session()->setFlashdata('fmsg', $msg);
                        return redirect()->to("admin/user/id/{$id}");
                    }catch(Exception $e){
                        $msg = alert('danger', 'Failed to process request. '.$e);
                        session()->setFlashdata('fmsg', $msg);
                    }
                }else{
                    $msg = alert('danger', 'Current password is invalid');
                    session()->setFlashdata('fmsg', $msg);
                }

            }else{
                $errors = $v->getErrors();
            }
        }
        
        return view('\Track\Views\admin\users\change_password', [
            'user'=>$user,
            'errors'=>$errors ?? [],
            ]);
    }


    public function addRecord(){
        $level_choices = ['user', 'admin'];
        $continue_add = true;

        $pdata = [
                'username'  =>$this->request->getPost('username') ?? null,
                'eid'       =>$this->request->getPost('eid') ?? null,
                'first_name'=>$this->request->getPost('first_name') ?? null,
                'last_name' =>$this->request->getPost('last_name') ?? null,
                'account'   =>$this->request->getPost('account') ?? null,
                'level'     =>$this->request->getPost('level') ?? null,
                'email'     =>$this->request->getPost('email') ?? null,
                'password'  =>$this->request->getPost('password') ?? null,
            ];

        if($this->request->is('post')){
            $v = $this->validation;
            $v->setRule('eid', 'Employee ID', 'required');
            $v->setRule('username', 'Username', 'required');
            $v->setRule('first_name', 'First name', 'required');
            $v->setRule('last_name', 'Last name', 'required');
            $v->setRule('account', 'Account', 'required');
            $v->setRule('level', 'Level', 'required|in_list[user,admin]');
            $v->setRule('email', 'Email', 'valid_email|permit_empty');
            $v->setRule('password', 'Password', 'required|min_length[5]');

            if($v->withRequest($this->request)->run()){
                $eid_exist = $this->model_users->where('eid', $pdata['eid'])->countAllResults();
                $username_exist = $this->model_users->where('username', $pdata['username'])->countAllResults();

                if($eid_exist > 0){
                    $continue_add = false;
                    $msg = alert('danger', 'Employee ID is taken');
                    session()->setFlashdata('fmsg', $msg);
                }

                if($username_exist > 0){
                    $continue_add = false;
                    $msg = alert('danger', 'Username was already taken');
                    session()->setFlashdata('fmsg', $msg);
                }

                
                if($continue_add){
                    $pdata['status'] = true;
                    //$pdata['password'] = password_hash(strval($pdata['password']), PASSWORD_DEFAULT);
                    $pdata['password'] = gen_hash($pdata['password']);
                    try{
                        $this->model_users->insert($pdata);
                        $msg = alert('success', 'New user was added');
                        session()->setFlashdata('fmsg', $msg);
                        return redirect()->to('admin/user-add');
                    }catch(Exception $e){
                        $msg = alert('danger', "Something went wrong! [{$e}]");
                        session()->setFlashdata('fmsg', $msg);
                    }
                }
            }else{
                $errors = $v->getErrors();
            }
        }

        return view('\Track\Views\admin\users\add_record', [
            'pdata'=>$pdata ?? [],
            'errors'=>$errors ?? [],
            'level_choices'=>$level_choices,
        ]);        
    }


    public function deleteRecord($id){
        $user = $this->model_users->firstOrFail($id);
        
        if($user['level'] == 'admin'){
            if(current_user()->superadmin == false){
                $msg = alert('danger', 'Action not allowed');
                session()->setFlashdata('fmsg', $msg);
                return redirect()->to('admin/user/id/'.$id);
            }
        }

        if($this->request->is('post')){
            $v = $this->validation;
            $v->setRule('password', 'Password', 'required');

            if($v->withRequest($this->request)->run()){
                $password = $this->request->getPost('password');
                $verify_password = password_verify(strval($password), current_user()->password);
                if($verify_password){
                    //delete record from database and all relations
                    $delete_user = $this->model_users->delete($id);
                    if($delete_user){
                        $msg = alert('success', 'User was deleted');
                        $this->model_checking->where('users_id', $id)->delete();
                        $this->model_breaks->where('users_id', $id)->delete();
                        session()->setFlashdata('fmsg', $msg);
                        return redirect()->to('admin/users');
                    }
                }else{
                    session()->setFlashdata('fmsg', alert('danger', 'Password invalid'));
                    return redirect()->to('admin/user-delete/id/'.$id);
                }
            }else{
                $errors = $v->getErrors();
            }
        }

        return view('\Track\Views\admin\users\delete_record', [
            'user'=>$user,
            'errors'=>$errors ?? [],
        ]);
    }


    public function activateUser($id){
        $user = $this->model_users->find($id);
        if($user){
            try{
                $this->model_users->update($id, ['status'=>true]);
                $msg = alert('success', 'User was ACTIVATED');
                session()->setFlashdata('fmsg', $msg);
            }catch(Exception){
                $msg = alert('danger', 'Failed to process request.');
                session()->setFlashdata('fmsg', $msg);
            }
        }

        return redirect()->to('admin/user/id/'.$id);
    }


    public function deactivateUser($id){
        $user = $this->model_users->find($id);
        
        if($user){
            $msg = alert('danger', 'Action not allowed');

            if($user['superadmin']){
                session()->setFlashdata('fmsg', $msg);
                return redirect()->to('admin/user/id/'.$id);
            }

            if($user['level'] == 'admin'){
                if(current_user()->superadmin == false){
                    session()->setFlashdata('fmsg', $msg);
                    return redirect()->to('admin/user/id/'.$id);
                }
            }
        
            try{
                $this->model_users->update($id, ['status'=>false]);
                session()->setFlashdata('fmsg', alert('success', 'User was deactivated'));
            }catch(Exception){
                session()->setFlashdata('fmsg', alert('danger', 'Something went wrong. contact admin'));
            }
         
        }
        return redirect()->to('admin/user/id/'.$id);
    }
}

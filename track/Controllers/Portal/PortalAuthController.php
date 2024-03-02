<?php

namespace Track\Controllers\Portal;

use Track\Controllers\MainController;

class PortalAuthController extends MainController{
    
    public function login(){

        $v = $this->validation;

        $v->setRule('username', 'Username', 'required');
        $v->setRule('password', 'Password', 'required');

        if($this->request->getMethod() == 'post'){

            if($v->withRequest($this->request)->run()){
            
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $password_hash = gen_hash($password);

                $user = $this->model_users->where('username', $username)->where('password', $password_hash)->first();

                if($user){
                    /*
                    $password_hash = $user['password'];
                    if(password_verify(strval($password), $password_hash)){
                        session()->set('uid', $user['id']);
                        return redirect()->to('/');
                    }else{
                        $msg = alert('danger','Username / Password is invalid');
                    }
                    */
                    session()->set('uid', $user['id']);
                    return redirect()->to('/');

                }else{
                    $msg = alert('danger', 'Username / Password is Invalid.');
                }

            }else{
                $errors = $v->getErrors();
            }
        }
        return view('\Track\Views\portal\auth\login', [
            'msg'=>$msg ?? null, 
            'errors'=>$errors ?? []
        ]);
    }


    public function logout(){
        session()->destroy();
        return redirect()->to('auth/login');
    }
}

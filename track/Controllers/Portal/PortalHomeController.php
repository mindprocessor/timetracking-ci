<?php

namespace Track\Controllers\Portal;

use Track\Controllers\MainController;
use CodeIgniter\I18n\Time;

class PortalHomeController extends MainController {

    public function index(){
        $uid = $this->currentUID();
        $break_choices = $this->breakChoices();
        $checking_status = 'out';
        $checking = $this->model_checking->where('users_id', $uid)->where('status', 'in')->first();

        if($checking){
            $checking_status = 'in';
            $breaks = $this->model_breaks->where('users_id', $uid)
                ->where('checking_id', $checking['id'])->findAll();
        }
        
        return view('\Track\Views\portal\home\index', [
            'checking'        =>$checking, 
            'breaks'          =>$breaks ?? null,
            'checking_status' =>$checking_status,
            'break_choices'   =>$break_choices,
        ]);
    }


    public function checkIn(){
        $status = 'out';
        $checking_in = $this->model_checking
            ->where('status', 'in')
            ->where('users_id', $this->currentUID())
            ->countAllResults();

        if($checking_in > 0){
            $status = 'in';
        }

        if($status == 'out'){
            $timelog = Time::now();
            $data = [
                'checkin'    => $timelog,
                'checkout'   => $timelog,
                'users_id'   => $this->currentUID(),
                'total_hours'=> 0,
                'status'     => 'in',
            ];
            try{
                $this->model_checking->insert($data);
                session()->setFlashdata('fmsg', alert('success', "You have checked IN at {$timelog}"));
            }catch(\Exception $e){
                session()->setFlashdata('fmsg', alert('danger', "Error! - {$e}"));
            }
        }

        return redirect()->to('/');
    }


    public function checkOut($id){ //$id = checking.id
        $checking = $this->model_checking->firstOrFail($id);
        $uid = $this->currentUID();

        if($checking['status']=='out'){
            $msg = alert('info', 'You have already checked-out this timelog');
            session()->setFlashdata('fmsg', $msg);
            return redirect()->to('/');
        }

        if($checking['users_id'] !== $uid){
            $msg = alert('danger', 'Action not permitted');
            session()->setFlashdata('fmsg', $msg);
            return redirect()->to('/');
        }

        //check if there are active breaks
        $breaks = $this->model_breaks
            ->where('status', 'start')
            ->where('checking_id', $id)
            ->where('users_id', $uid)
            ->countAllResults();
        
        if($breaks > 0){
            session()->setFlashdata('fmsg', alert('danger', "Please end active breaks to continue check-OUT"));
            return redirect()->to('/');
        }

        $pdata = [
            'details' => $this->request->getPost('details') ?? '',
        ];

        if($this->request->is('post')){
            $v = $this->validation;

            $v->setRule('details', 'Details', 'required');

            if($v->withRequest($this->request)->run()){
                $timein = Time::parse($checking['checkin']);
                $timeout = Time::now();

                $total_hours = $timeout->difference($timein);
                
                $data = [
                    'checkout'    => $timeout,
                    'total_hours' => $total_hours->getHours(true),
                    'eod'         => trim(strip_tags($pdata['details'])),
                    'status'      => 'out',
                ];
                try{
                    $this->model_checking->update($id, $data);
                    session()->setFlashdata('fmsg', alert('success', "You have checked OUT at {$timeout}"));
                    return redirect()->to('/');
                }catch(\Exception $e){
                    $msg = alert('danger', "Error - {$e->getMessage()}");
                }
            }else{
                $errors = $v->getErrors();
            }
        }

        return view('\Track\Views\portal\home\checkout', [
            'msg' => $msg ?? null,
            'errors' => $errors ?? [],
            'pdata' => $pdata ?? [],
        ]);
    }


    public function breakIn($cid, $mode){
        $checking = $this->model_checking->firstOrFail($cid);
        $break_choices = $this->breakChoices();
        $break_add = true;

        //has active_breaks
        $active_breaks = $this->model_breaks
            ->where('status', 'start')
            ->where('checking_id', $cid)
            ->where('users_id', $this->currentUID())
            ->countAllResults();

        if($active_breaks > 0){
            session()->setFlashdata('fmsg', alert('danger', 'Error! - You have active breaks'));
            $break_add = false;
        }

        if(!in_array($mode, $break_choices)){
            session()->setFlashdata('fmsg', alert('danger', 'Error! - Mode not in choices'));
            $break_add = false;
        }

        $data = [
            'checking_id' => $checking['id'],
            'users_id'    => $this->currentUID(),
            'start'       => Time::now(),
            'end'         => Time::now(),
            'status'      => 'start',
            'mode'        => $mode,
            'total_hours' => 0,
        ];

        if($break_add){
            try{
                $this->model_breaks->insert($data);
                session()->setFlashdata('fmsg', alert('success', "You are now on {$mode} break"));
            }catch(\Exception $e){
                session()->setFlashdata('fmsg', alert('danger', "Error - {$e->getMessage()}"));
            }
        }

        return redirect()->to('/');
    }


    public function breakOut($id){
        $break = $this->model_breaks->firstOrFail($id);
        $uid = $this->currentUID(); //current user.id of logged-in user

        if($break['status'] == 'stop'){
            $msg = alert('info', 'You have already stopped this break log');
            session()->setFlashdata('fmsg', $msg);
            return redirect()->to('/');
        }

        if($break['users_id'] !== $uid){
            $msg = alert('danger', 'Action not permitted');
            session()->setFlashdata('fmsg', $msg);
            return redirect()->to('/');
        }

        $timeout = Time::now();
        $timein = Time::parse($break['start']);
        $total_hours = $timeout->difference($timein);

        $data = [
            'end'         => $timeout,
            'total_hours' => $total_hours->getHours(true),
            'status'      => 'stop'
        ];

        try{
            $this->model_breaks->update($id, $data);
            session()->setFlashdata('fmsg', alert('success', 'You have ended your break'));
        }catch(\Exception $e){
            session()->setFlashdata('fmsg', alert('danger', "Error - {$e->getMessage()}"));
        }

        return redirect()->to('/');
    }

}


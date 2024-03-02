<?php

namespace Track\Controllers\Admin;
use Track\Controllers\MainController; 


class AdminHomeController extends MainController{
    
    public function checkinUsers(){
        $checkedin = $this->model_checking->where('status', 'in')->find();

        if($checkedin){
            //user id reference
            $user_ids = array_column($checkedin, 'users_id', 'users_id');

            //checking id reference
            $checking_ids = array_column($checkedin, 'id', 'id');

            $users = $this->model_users->whereIn('id', $user_ids)->find();
            $username = array_column($users, 'username', 'id');
            $breaks = $this->model_breaks->where('status','start')
                    ->whereIn('checking_id', $checking_ids)
                    ->find();
            $break_mode = array_column($breaks, 'mode', 'checking_id');
        }
        
        
        return view('\Track\Views\admin\home\checkin_users', [
            'checkedin'=>$checkedin,
            'username'=>$username ?? [],
            'break_mode'=>$break_mode ?? [],
        ]);
        
    }

}

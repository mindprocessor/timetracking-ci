<?php

namespace Track\Controllers\Admin;
use Track\Controllers\MainController; 


class AdminTimelogController extends MainController{

    public function timelogs(){
        $timelogs = $this->model_checking->where('status', 'out')->orderBy('id', 'desc')->limit(20)->find();
        $timelogs_user_id = array_column($timelogs, 'users_id', 'users_id');
        
        $users = $this->model_users->whereIn('id', $timelogs_user_id)->find();
        $username = array_column($users, 'username', 'id');
        $employee_id = array_column($users, 'eid', 'id');

        return view('\Track\Views\admin\timelog\timelogs', [
            'timelogs'=>$timelogs,
            'username'=>$username,
            'employee_id'=>$employee_id,
            ]);
    }  
}

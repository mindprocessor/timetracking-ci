<?php

namespace Track\Controllers\Admin;
use Track\Controllers\MainController; 


class AdminReportsController extends MainController{
    
    public function reports(){
        $isResolved = $this->request->getVar('resolved') ?? 'no';
        $resolved = ($isResolved == 'yes') ? true : false;
        $reports = $this->model_reports->where('resolved', $resolved)->orderBy('created', 'desc')->find();

        $user_ids = array_column($reports, 'users_id', 'users_id');
        $users = $this->model_users->whereIn('id', $user_ids)->find();
        $usernames = array_column($users, 'username', 'id');

        return view('\Track\Views\admin\reports\reports', [
            'reports'=>$reports, 
            'usernames'=>$usernames
            ]);
    }
}

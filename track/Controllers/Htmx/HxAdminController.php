<?php

namespace Track\Controllers\Htmx;

use Track\Controllers\MainController;

class HxAdminController extends MainController{

    public function timesheet($id){
        $timesheet = $this->model_checking->firstOrFail($id);
        $breaks = $this->model_breaks->where('checking_id', $id)->find();
        $total_break_hours = 0;

        // tally break hours
        foreach($breaks as $break){
            $total_break_hours += $break['total_hours'];
        }

        //get user details
        $user = $this->model_users->where('id', $timesheet['users_id'])->first();

        return view('\Track\Views\htmx\admin\timesheet', [
            'timesheet'=>$timesheet,
            'total_break_hours'=>$total_break_hours,
            'breaks'   =>$breaks,
            'user'     =>$user,
            ]);
    }


    public function filterTimelog(){
        $user_id = $this->request->getPost('user_id');
        $month = $this->request->getPost('month') ?? date('Y-m');
        $timelogs =$this->model_checking->where('users_id', $user_id)
            ->like('checkin', $month, 'after')->orderBy('id', 'DESC')->find();
        return view('\Track\Views\htmx\admin\filter_timelog', [
            'timelogs' => $timelogs,
        ]);
    }

    public function test(){
        echo ' this is a test page';
    }
    
}

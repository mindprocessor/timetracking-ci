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


    public function getRecord($id){
        $report = $this->model_reports->firstOrFail($id);

        $user = $this->model_users->where('id', $report['users_id'])->first();

        $pdata = [
            'title'    => $report['title'],
            'severity' => $report['severity'],
            'details'  => $report['details'],
            'remarks'  => $this->request->getPost('remarks') ?? $report['remarks'],
            'resolved' => $report['resolved'],
        ];

        if($this->request->is('post')){
            try{
                $this->model_reports->update($id, [
                    'remarks'=>$pdata['remarks'],
                    'resolved'=>intval($this->request->getPost('resolved') ?? 0),
                ]);
                $pdata['resolved'] = $this->request->getPost('resolved');
                $msg = alert('success', 'Changes was saved');
            }catch(\Exception $e){
                $msg = alert('danger', 'Something went wrong '.$e);
            }
        }

        return view('\Track\Views\admin\reports\report_edit', [
            'report'=>$report,
            'pdata'=>$pdata,
            'msg'=>$msg ?? null,
            'user'=>$user,
        ]);
    }
}

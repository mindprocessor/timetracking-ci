<?php

namespace Track\Controllers\Htmx;

use Exception;
use Track\Controllers\MainController;

class HxHomeController extends MainController
{
    public function filterByMonth()
    {
        $uid = $this->currentUID();
        $month = $this->request->getPost('month') ?? date('Y-m');
        $timelogs = $this->model_checking->where('users_id', $uid)->like('created', $month)->find();

        return view('Track\Views\htmx\home\filter_month', [
            'timelogs'=>$timelogs,
        ]);
    }


    public function incidentReportForm(){
        $severity_choices = severity_choices();

        $v = $this->validation;
        $v->setRule('title', 'Title', 'required');
        $v->setRule('severity', 'Severity', 'required');
        $v->setRule('details', 'Details', 'required');

        $pdata = [
            'title' => $this->request->getPost('title'),
            'severity' => $this->request->getPost('severity'),
            'details' => $this->request->getPost('details'),
            'resolved' => false,
            'users_id' => $this->currentUID(),
        ];

        if($v->withRequest($this->request)->run()){
            try{
                $this->model_reports->insert($pdata);
                $msg = alert('success', 'Report was submitted');
            }catch(Exception $e){
                $msg = alert('danger', "Something went wrong. error[{$e}]");
            }
        }else{
            $errors = $v->getErrors();
        }

        return view('\Track\Views\htmx\home\incident-report-form', [
            'severity_choices'=>$severity_choices,
            'errors'=>$errors ?? [],
            'msg'=>$msg ?? null,
            'pdata'=>$pdata ?? [],
        ]);
    }
}

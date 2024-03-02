<?php

namespace Track\Controllers\Portal;
use Track\Controllers\MainController;
use Exception;

class PortalReportController extends MainController {

    public function incidentReport(){
        
        $severity_choices = severity_choices();

        if($this->request->getMethod()=='post'){
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
                    session()->setFlashdata('fmsg', alert('success', 'Report was submitted'));
                    return redirect()->to('incident-report');
                }catch(Exception $e){
                    $msg = alert('danger', "Something went wrong. error[{$e}]");
                }
            }else{
                $errors = $v->getErrors();
            }
        }

        return view('\Track\Views\portal\report\incident_report', [
            'msg' => $msg ?? null,
            'severity_choices'=>$severity_choices,
            'errors'=>$errors ?? [],
            'pdata'=>$pdata ?? [],
        ]);
    }

}
<?php

namespace Track\Controllers\Portal;
use Track\Controllers\MainController;


class PortalTimelogController extends MainController {

    public function timelogs(){
        $uid = $this->currentUID();
        $month = $this->request->getPost('month') ?? date('Y-m');

        $timelogs = $this->model_checking
            ->where('users_id', $uid)
            ->where('status', 'out')
            ->like('created', $month)
            ->orderBy('id', 'DESC')
            ->find();

        return view('\Track\Views\portal\timelog\timelogs',[
            'timelogs'=>$timelogs,
            'month'=>$month,
        ]);
    }

    public function recordDetails($id){ //$id == checking.id
        $checking = $this->model_checking->firstOrFail($id);
        $uid = $this->currentUID();

        if($uid !== $checking['users_id']){
            die('NOT ALLOWED');
        }

        $breaks = $this->model_breaks->where('checking_id', $checking['id'])->findAll();
        $breaks_total_hours = 0;

        foreach($breaks as $item){
            $breaks_total_hours += $item['total_hours'];
        }

        return view('\Track\Views\portal\timelog\record_details', [
            'checking'=>$checking,
            'breaks'=>$breaks,
            'breaks_total_hours'=>$breaks_total_hours,
        ]);
    }

}
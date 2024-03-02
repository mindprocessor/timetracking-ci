<?php

namespace Track\Controllers;

use App\Controllers\BaseController;

class MainController extends BaseController
{

    protected $model_checking;
    protected $model_breaks;
    protected $model_users;
    protected $model_reports;

    protected $validation;

    function __construct()   {

        date_default_timezone_set('Asia/Manila');

        $this->helpers = ['url', 'form', 'session', 'custom'];

        $this->validation = \Config\Services::validation();

        $this->model_checking = new \Track\Models\Checking();
        $this->model_breaks = new \Track\Models\Breaks();
        $this->model_users = new \Track\Models\Users();
        $this->model_reports = new \Track\Models\Reports();

        //helper('custom');
    }


    public function breakChoices(){
        return ['short', 'bio', 'lunch', 'coaching', 'meeting'];
    }


    public function currentUID(){
        return session()->get('uid');
    }

}

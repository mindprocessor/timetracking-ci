<?php


namespace Track\Controllers\Admin;

use Exception;
use Track\Controllers\MainController; 

class AdminDBController extends MainController{

    private function createUsers(){

        $forge = \Config\Database::forge();
        
        /**user table
        'id, int auto increment
        'eid',
        'username', //string
        'password', //string
        'first_name', //string
        'last_name', //string
        'email',     //string
        'level',     //string
        'account',    //string
        'superadmin', //boolean int
        'status',     //boolean int
        */

        $fields = [
            'id'       => ['type'=> 'INT', 'auto_increment' => true],
            'eid'      => ['type'=>'INT'],
            'username' => ['type'=>'VARCHAR', 'constraint'=>'300', 'unique'=>true],
            'password' => ['type'=>'VARCHAR', 'constraint'=>'1000'],
            'first_name'=> ['type'=>'VARCHAR', 'constraint'=>'500'],
            'last_name' => ['type'=>'VARCHAR', 'constraint'=>'500'],
            'email'     => ['type'=>'VARCHAR', 'constraint'=>'500'],
            'level'     => ['type'=>'VARCHAR', 'constraint'=>'50'],
            'account'   => ['type'=>'VARCHAR', 'constraint'=>'50'],
            'superadmin'=> ['type'=>'TINYINT'],
            'status'    => ['type'=>'TINYINT'],
            'created'   => ['type'=>'TIMESTAMP'],
            'updated'   => ['type'=>'TIMESTAMP'],
        ];
        $forge->addKey('id', true);
        $forge->addField($fields);
        $forge->createTable('users');
    
    }


    private function createChecking(){
        $forge = \Config\Database::forge();

        /*//id
        'users_id', //int 
        'checkin',  //datetime
        'checkout', //datetime
        'status',   //string
        'total_hours', //float
        'eod',      //string
        //created
        //updated    
        */

        $fields = [
            'id'       => ['type'=>'INT', 'auto_increment'=>true],
            'users_id' => ['type'=>'INT'],
            'checkin'  => ['type'=>'DATETIME'],
            'checkout' => ['type'=>'DATETIME'],
            'status'   => ['type'=>'VARCHAR', 'constraint'=>'50'],
            'total_hours' => ['type'=>'FLOAT'],
            'eod'      => ['type'=>'LONGTEXT'],
            'created'  => ['type'=>'TIMESTAMP'],
            'updated'  => ['type'=>'TIMESTAMP'],
        ];    

        $forge->addKey('id', true);
        $forge->addField($fields);
        $forge->createTable('checking');
    }


    private function createBreaks(){
        $forge = \Config\Database::forge();

        /*
        id
        'users_id',    //int
        'checking_id', //int
        'start',       //datetime
        'end',         //datetime
        'status',      //boolean - tinyint
        'total_hours', //float
        'mode',        //string
        //created
        //updated
        */

        $fields = [
            'id'       => ['type'=>'INT', 'auto_increment'=>true],
            'users_id' => ['type'=>'INT'],
            'checking_id' => ['type'=>'INT'],
            'start'    => ['type'=>'DATETIME'],
            'end'      => ['type'=>'DATETIME'],
            'status'   => ['type'=>'INT', 'constraint'=>'1'],
            'total_hours' => ['type'=>'FLOAT'],
            'mode'     => ['type'=>'VARCHAR', 'constraint'=>'50'],
            'created'  => ['type'=>'TIMESTAMP'],
            'updated'  => ['type'=>'TIMESTAMP'],
        ];

        $forge->addField($fields);
        $forge->addKey('id', true);
        $forge->createTable('breaks');
    }


    private function createReports(){
        //['users_id', 'title', 'severity', 'details', 'resolved', 'remarks'];
        $forge = \Config\Database::forge();
        $fields = [
            'id'=>['type'=>'INT', 'auto_increament'=>true],
            'users_id'=>['type'=>'INT'],
            'title'=>['type'=>'VARCHAR', 'constraint'=>'1000'],
            'severity' =>['type'=>'VARCHAR', 'constraint'=>'100'],
            'details'=>['type'=>'LONGTEXT'],
            'resolved'=>['type'=>'BOOLEAN'],
            'remarks'=>['type'=>'LONGTEXT'],
            'created'=>['type'=>'TIMESTAMP'],
            'updated'=>['type'=>'TIMESTAMP'],
        ];
        $forge->addField($fields);
        $forge->addKey('id', true);
        $forge->createTable('reports');
    }


    public function createTables(){

        try{
            $this->createUsers();
            $this->createChecking();
            $this->createBreaks();
            $this->createReports();
        }catch(Exception $e){
            echo 'error <br>';
            print_r($e);
        }

    }

}
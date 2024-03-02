<?php

namespace Track\Models;

use CodeIgniter\Model;
use Track\Entities\CheckingEntity;

class Checking extends Model
{
    protected $table            = 'checking';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        //id
        'users_id', //int 
        'checkin',  //datetime
        'checkout', //datetime
        'status',   //string
        'total_hours', //float
        'eod',      //string
        //created
        //updated
        ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created';
    protected $updatedField  = 'updated';
    //protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function firstOrFail($id){
        $find_record = $this->find($id);
        if($find_record){
            return $find_record;
        }else{
            die('No records found!');
        }
    }

}

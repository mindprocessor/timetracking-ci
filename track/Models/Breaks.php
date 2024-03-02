<?php

namespace Track\Models;

use CodeIgniter\Model;
use Track\Entities\BreaksEntity;

class Breaks extends Model
{
    protected $table            = 'breaks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'users_id',    //int
        'checking_id', //int
        'start',       //datetime
        'end',         //datetime
        'status',      //boolean - tinyint
        'total_hours', //float
        'mode',        //string
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
        $record = $this->where('id', $id)->first();
        if($record){
            return $record;
        }else{
            die('No records found!');
        }
    }

}

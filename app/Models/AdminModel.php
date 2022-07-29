<?php

namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model {
    /**
     * @var $tbl string name of the table used for this model
     */
     protected $tbl = "admin_tbl";

    /**
     * @param $clauses array the various parameters to authenticate the admin (e.g. email & password)
     * @return false|mixed returns an object when the admin is authenticated else returns false
     */
    public function authenticateLogin(array $clauses){
        $builder = $this->db->table($this->tbl);
        $builder->select();
        $builder->where($clauses);
        $result = $builder->get();

        if ($result->resultID->num_rows == 1) {
            return $result->getRowObject();
        } else {
            return false;
        }
    }
}
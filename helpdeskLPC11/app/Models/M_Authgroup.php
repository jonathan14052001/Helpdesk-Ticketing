<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_Authgroup extends Model{

    protected $table = 'auth_groups';

    // public function __construct()
    // {
    //     $this->db = db_connect();
    //     $this->dbuilder = $this->db->table($this->table);
    // }

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('auth_groups')->get()->getResultArray();
        } else{
            $this->db->table('auth_groups')->where('id', $id);
            return $this->db->table('auth_groups')->get()->getRowArray();
        }
    }
}
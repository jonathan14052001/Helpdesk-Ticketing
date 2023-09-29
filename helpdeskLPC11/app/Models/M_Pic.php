<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_Pic extends Model{

    protected $table = 'pic';

    // public function __construct()
    // {
    //     $this->db = db_connect();
    //     $this->dbuilder = $this->db->table($this->table);
    // }

    public function getAllData($id_user = false)
    {
        if ($id_user == false) {
            return $this->db->table('pic')->get()->getResultArray();
        } else{
            $this->db->table('pic')->where('id_user', $id_user);
            return $this->db->table('pic')->get()->getRowArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table('pic')->insert($data);
    }

    public function hapus($id_user){
        return $this->db->table('pic')->delete(['id_user' => $id_user]);
    }

    public function ubah($data, $id_user)
    {
        return $this->db->table('pic')->update($data, ['id_user' => $id_user]);
    }

    public function search($keyword)
    {
        return $this->table('pic')->like('id_user', $keyword)->orLike('name_pic', $keyword);
    }
}
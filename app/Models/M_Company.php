<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_Company extends Model{

    protected $table = 'company';

    // public function __construct()
    // {
    //     $this->db = db_connect();
    //     $this->dbuilder = $this->db->table($this->table);
    // }

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('company')->get()->getResultArray();
        } else{
            $this->db->table('company')->where('id', $id);
            return $this->db->table('company')->get()->getRowArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table('company')->insert($data);
    }

    public function hapus($id){
        return $this->db->table('company')->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->db->table('company')->update($data, ['id' => $id]);
    }

    public function search($keyword)
    {
        return $this->table('company')->like('id', $keyword)->orLike('name_company', $keyword);
    }
}
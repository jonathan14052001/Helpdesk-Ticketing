<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_Progress extends Model{

    protected $table = 'progress';

    // public function __construct()
    // {
    //     $this->db = db_connect();
    //     $this->dbuilder = $this->db->table($this->table);
    // }

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('progress')->get()->getResultArray();
        } else{
            $this->db->table('progress')->where('id', $id);
            return $this->db->table('progress')->get()->getRowArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table('progress')->insert($data);
    }

    public function hapus($id){
        return $this->db->table('progress')->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->db->table('progress')->update($data, ['id' => $id]);
    }

    public function search($keyword)
    {
        return $this->table('progress')->like('id_ticket', $keyword)->orLike('persen_progress', $keyword)->orLike('solution', $keyword)->orLike('status_ticket', $keyword);
    }
}
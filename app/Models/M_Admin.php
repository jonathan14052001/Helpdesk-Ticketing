<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_Admin extends Model{

    protected $table = 'users';

    public function __construct()
    {
        $this->db = db_connect();
        $this->dbuilder = $this->db->table($this->table);
    }

    public function getAllData($userid = false)
    {
        if ($userid == false) {
            return $this->db->table('users')->get()->getResultArray();
        } else{
            $this->db->table('users')->where('id', $userid);
            return $this->db->table('users')->get()->getRowArray();
        }
    }

    //Model Add
    public function tambah($data)
    {
        return $this->db->table('users')->insert($data);
    }

    //Model Delete
    public function hapus($userid){
        return $this->db->table('users')->delete(['id' => $userid]);
    }

    //Model Edit
    public function ubah($data, $userid)
    {
        return $this->db->table('users')->update($data, ['userid' => $userid]);
    }

    //Model Edit
    // public function ubah($data, $id)
    // {
    //     return $this->db->table('admin')->update($data, ['id' => $id]);
    // }

    //Model Search
    public function search($keyword)
    {
        return $this->table('users')->like('username', $keyword)->orLike('email', $keyword)->orLike('name', $keyword);
    }
}
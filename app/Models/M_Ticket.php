<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_Ticket extends Model{

    protected $table = 'ticket';

    // public function __construct()
    // {
    //     $this->db = db_connect();
    //     $this->builder = $this->db->table($this->table);
    // }

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('ticket')->get()->getResultArray();
        } else{
            $this->db->table('ticket')->where('id', $id);
            return $this->db->table('ticket')->get()->getRowArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table('ticket')->insert($data);
    }

    public function hapus($id){
        return $this->db->table('ticket')->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->db->table('ticket')->update($data, ['id' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('ticket');
        // $builder->like('name_company', $keyword);
        // return $builder;
        return $this->table('ticket')->like('no_ticket', $keyword)->orLike('name_company', $keyword)->orLike('name_pic', $keyword)->orLike('position_pic', $keyword)->orLike('urgency', $keyword)->orLike('status_ticket', $keyword);

    }

    // public function get_company()
    //     {
    //         $query = $this->db->query('SELECT name_company FROM company');
    //         return $this->db->query($query)->getResultArray();
    //     }
}
<?php

class Users_Model extends CI_Model {
    
    protected $table = 'users';

    protected $primaryKey = 'id';

    public function user()
    {
        $this->db->select('id, nomor, id_jabatan, access_token, status');
        $this->db->from($this->table);
        return $this->db->get();
    }

    public function get()
    {
        $this->db->select('users.id, users.nomor, jabatan.nama as jabatan, users.status');
        $this->db->from($this->table);
        $this->db->join('jabatan', 'users.id_jabatan = jabatan.id');
        $this->db->where(['users.status' => 1]);
        return $this->db->get();
    }

    public function findOne($id)
    {
        return $this->db->get_where($this->table, [$this->primaryKey => $id]);
    }

    public function search($search) 
    {
        $this->db->select()
        ->from($this->table)
        ->like('nomor',$search);

        return $this->db->get();   
    }

    public function findByNim($nim)
    {
        return $this->db->get_where($this->table, ['nomor' => $nim]);
    }

    public function filter($filter) 
    {
        $this->db->select()
        ->from('users')
        ->where($filter);

        return $this->db->get();
    }

    public function findByToken($token) 
    {
        return $this->db->get_where($this->table, ['access_token' => $token]);
    }

}

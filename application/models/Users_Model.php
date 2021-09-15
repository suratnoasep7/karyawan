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

    public function findByUsername($username)
    {
        $this->db->select('users.id, users.username, users.password, users.status');
        $this->db->from($this->table);
        $this->db->where(['users.username' => $username]);
        return $this->db->get();
    }

    public function filter($filter) 
    {
        $this->db->select('users.id, users.nomor, pegawai.nama, pegawai.id as pegawai_id, users.status');
        $this->db->from($this->table);
        $this->db->join('pegawai', 'pegawai.nomor = users.nomor');
        $this->db->where($filter);

        return $this->db->get();
    }

    public function findByToken($token) 
    {
        return $this->db->get_where($this->table, ['access_token' => $token]);
    }

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $update)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $update);
    }

    public function delete($id, $update)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $update);
    }

}

<?php

class Siswa_Model extends CI_Model {
    
    protected $table = 'siswa';

    protected $primaryKey = 'id';

    public function siswa()
    {
        $this->db->select('id, nomor, nama, tempat_lahir, tanggal_lahir, alamat, nomor_telepon, jenis_kelamin, status');
        $this->db->from($this->table);
        $this->db->where(['status' => 1]);
        return $this->db->get();
    }


    public function filter($filter) 
    {
        $this->db->select()
        ->from($this->table)
        ->where($filter);

        return $this->db->get();
    }

    public function search($search) 
    {
        $this->db->select()
        ->from($this->table)
        ->like('nomor',$search)
        ->or_like('nama', $search);

        return $this->db->get();   
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

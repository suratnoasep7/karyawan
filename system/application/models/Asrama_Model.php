<?php

class Asrama_Model extends CI_Model {
    
    protected $table = 'asrama';

    protected $primaryKey = 'id';

    public function asrama()
    {
        $this->db->select('id, kode_kategori_asrama, kode_asrama, hall, nomor_kamar, lantai, status');
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
        ->like(['kode_kategori_asrama' => 'MPUTRA'])
        ->or_like(['kode_kategori_asrama' => 'MPUTRI'])
        ->or_like('kode_asrama',$search);

        return $this->db->get();   
    }

    public function searchAsrama($search) 
    {
        $this->db->select()
        ->from($this->table)
        ->or_like('kode_asrama',$search);

        return $this->db->get();   
    }

    public function searchAsramaSiswa($search) 
    {
        $this->db->select()
        ->from($this->table)
        ->like(['kode_kategori_asrama' => 'SPUTRA'])
        ->or_like(['kode_kategori_asrama' => 'SPUTRI'])
        ->or_like('kode_asrama',$search);

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

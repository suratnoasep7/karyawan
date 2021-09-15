<?php

class Karyawan_Model extends CI_Model {
    
    protected $table = 'karyawan';

    protected $primaryKey = 'id';

    public function karyawan()
    {
        $this->db->select('id, nik, nama, status');
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

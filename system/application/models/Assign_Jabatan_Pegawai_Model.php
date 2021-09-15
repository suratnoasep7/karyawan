<?php

class Assign_Jabatan_Pegawai_Model extends CI_Model {
    
    protected $table = 'assign_jabatan_pegawai';

    protected $primaryKey = 'id';

    public function assign_jabatan_pegawai()
    {
        $this->db->select('assign_jabatan_pegawai.id, jabatan.nama as jabatan, assign_jabatan_pegawai.nomor, assign_jabatan_pegawai.status');
        $this->db->from($this->table);
        $this->db->join('jabatan', 'assign_jabatan_pegawai.id_jabatan = jabatan.id');
        $this->db->where(['assign_jabatan_pegawai.status' => 1]);
        return $this->db->get();
    }


    public function filter($filter) 
    {
        $this->db->select()
        ->from($this->table)
        ->where($filter);

        return $this->db->get();
    }

    public function searchKepalaAsrama($search) 
    {
        $this->db->select()
        ->from($this->table)
        ->where_in('id_jabatan', [4,5,6,7])
        ->like('nomor', $search);

        return $this->db->get();
    }

    public function search($search) 
    {
        $this->db->select()
        ->from($this->table)
        ->like('nomor', $search);

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

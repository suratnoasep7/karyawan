<?php

class Dashboard_Model extends CI_Model {
    
    protected $table = 'menu';

    protected $primaryKey = 'id';

    public function getMenu($idJabatan)
    {
        $this->db->select('menu.id, menu.nama_menu, menu.icon_menu, menu.is_sub_menu, menu.link_menu, menu.id_sub_menu, menu.status');
        $this->db->from($this->table);
        $this->db->join('assign_menu_jabatan', 'assign_menu_jabatan.id_menu = menu.id');
        $this->db->where(['assign_menu_jabatan.id_jabatan' => $idJabatan, 'menu.status' => 1, 'menu.is_sub_menu' => 0]);
        return $this->db->get();
    }

    public function getSubMenu($idSubMenu)
    {
        $this->db->select('menu.id, menu.nama_menu, menu.icon_menu, menu.is_sub_menu, menu.link_menu, menu.id_sub_menu, menu.status');
        $this->db->from($this->table);
        $this->db->where(['menu.status' => 1, 'menu.id_sub_menu' => $idSubMenu]);
        return $this->db->get();
    }

}

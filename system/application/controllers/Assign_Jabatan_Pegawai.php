<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_Jabatan_Pegawai extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Assign Jabatan Pegawai';
		$data['content'] = 'assign_jabatan_pegawai/index';
		$data['javascript'] = 'assign_jabatan_pegawai.js';
		$this->load->view('layout/index', $data);
	}
}

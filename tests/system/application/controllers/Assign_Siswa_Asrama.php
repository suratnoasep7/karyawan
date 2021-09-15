<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_Siswa_Asrama extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Assign Siswa Asrama';
		$data['content'] = 'assign_siswa_asrama/index';
		$data['javascript'] = 'assign_siswa_asrama.js';
		$this->load->view('layout/index', $data);
	}
}

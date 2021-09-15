<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_Mahasiswa_Asrama extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Assign Mahasiswa Asrama';
		$data['content'] = 'assign_mahasiswa_asrama/index';
		$data['javascript'] = 'assign_mahasiswa_asrama.js';
		$this->load->view('layout/index', $data);
	}
}

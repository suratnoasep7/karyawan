<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Karyawan';
		$data['content'] = 'karyawan/index';
		$data['javascript'] = 'karyawan.js';
		$this->load->view('layout/index', $data);
	}
}

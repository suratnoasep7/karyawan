<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Pegawai';
		$data['content'] = 'pegawai/index';
		$data['javascript'] = 'pegawai.js';
		$this->load->view('layout/index', $data);
	}
}

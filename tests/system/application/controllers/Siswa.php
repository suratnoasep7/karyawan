<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Siswa';
		$data['content'] = 'siswa/index';
		$data['javascript'] = 'siswa.js';
		$this->load->view('layout/index', $data);
	}
}

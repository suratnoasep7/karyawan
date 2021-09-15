<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Mahasiswa';
		$data['content'] = 'mahasiswa/index';
		$data['javascript'] = 'mahasiswa.js';
		$this->load->view('layout/index', $data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Jabatan';
		$data['content'] = 'jabatan/index';
		$data['javascript'] = 'jabatan.js';
		$this->load->view('layout/index', $data);
	}
}

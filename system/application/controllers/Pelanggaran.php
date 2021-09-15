<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggaran extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Pelanggaran';
		$data['content'] = 'pelanggaran/index';
		$data['javascript'] = 'pelanggaran.js';
		$this->load->view('layout/index', $data);
	}
}

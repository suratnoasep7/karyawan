<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_Asrama extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Kategori Asrama';
		$data['content'] = 'kategori_asrama/index';
		$data['javascript'] = 'kategori_asrama.js';
		$this->load->view('layout/index', $data);
	}
}

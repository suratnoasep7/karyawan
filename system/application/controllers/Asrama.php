<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asrama extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Asrama';
		$data['content'] = 'asrama/index';
		$data['javascript'] = 'asrama.js';
		$this->load->view('layout/index', $data);
	}
}

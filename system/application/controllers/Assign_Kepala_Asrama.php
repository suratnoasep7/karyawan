<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_Kepala_Asrama extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Assign Kepala Asrama';
		$data['content'] = 'assign_kepala_asrama/index';
		$data['javascript'] = 'assign_kepala_asrama.js';
		$this->load->view('layout/index', $data);
	}
}

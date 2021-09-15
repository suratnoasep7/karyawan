<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Master Users';
		$data['content'] = 'users/index';
		$data['javascript'] = 'users.js';
		$this->load->view('layout/index', $data);
	}
}

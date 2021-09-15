<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Auth extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Users_Model']);
    }
    
    public function login_post() 
    {
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() == false) {
            $this->messageError();
        }

        $dataUsers = $this->Users_Model->findByUsername($this->input->post('username'));

        if($dataUsers->num_rows() > 1) {
            $this->messageDataNotFound();
        }
        if(password_verify($this->input->post('password'), $dataUsers->row()->password)) {
            $this->messageSuccess();
            $tokenData = array();
            $tokenData['id'] = $dataUsers->row()->id;
            $token = AUTHORIZATION::generateToken($tokenData);
            $data = [
                'access_token' => $token
            ];
            $this->Users_Model->update($dataUsers->row()->id, $data);
            $data = [
                'id' => $dataUsers->row()->id,
                'username' => $dataUsers->row()->username,
                'access_token' => $token,
                'logged_in' => true
            ];
            $this->session->set_userdata($data);
        } else {
            $this->messagePasswordError();    
        }
    }


    private function messageError() 
    {
        $data = array();
        $data['message'] = 'ISI Data Dengan Baik Dan Benar';
        $data['status'] = false;
        $this->set_response($data, REST_Controller::HTTP_BAD_REQUEST);
    }

    private function messageDataNotFound() 
    {
        $data = array();
        $data['message'] = 'Data Tidak Ditemukan';
        $data['status'] = false;
        $this->set_response($data, REST_Controller::HTTP_BAD_REQUEST);
    }

    private function messagePasswordError() 
    {
        $data = array();
        $data['message'] = 'Password Anda Salah';
        $data['status'] = false;
        $this->set_response($data, REST_Controller::HTTP_BAD_REQUEST);
    }
    private function messageSuccess() 
    {
        $data = array();
        $data['message'] = 'Login Berhasil';
        $data['data'] = 'dashboard';
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }
}
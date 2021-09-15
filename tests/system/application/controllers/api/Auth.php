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
        $this->form_validation->set_rules('nomor','NIP / NIM','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() == false) {
            $this->messageError();
        }

        $dataUsers = $this->Users_Model->findByNim($this->input->post('nomor'));

        if($dataUsers->num_rows() > 1) {
            $this->messageDataNotFound();
        }
        if(password_verify($this->input->post('password'), $dataUsers->row()->password)) {
            $this->messageSuccess();
            $data = [
                'id' => $dataUsers->row()->id,
                'nomor' => $dataUsers->row()->nomor,
                'access_token' => $dataUsers->row()->access_token,
                'id_jabatan' => $dataUsers->row()->id_jabatan,
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
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Users extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Users_Model']);
    }

    public function index_get() 
    {
        $headers = $this->input->request_headers();


        if(!array_key_exists('Authorization', $headers)) {
            return $this->messageUnAthorized();
        }

        if(empty($headers['Authorization'])) {
            return $this->messageUnAthorized();
        }

        $decodedToken = AUTHORIZATION::checkToken($headers['Authorization'])->num_rows();

        if($decodedToken == 0) {
            return $this->messageError();
        }

        $dataUsers = $this->Users_Model->get()->result_array();
        $response = array('status' => true, 'data' => $dataUsers);
        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function index_post() 
    {

        $this->form_validation->set_rules('nomor','NOMOR','required');
        $this->form_validation->set_rules('password','PASSWORD','required');

        $headers = $this->input->request_headers();

        if(empty($headers['Authorization'])) {
            $this->messageUnAthorized();
        }

        $decodedToken = AUTHORIZATION::checkToken($headers['Authorization'])->num_rows();

        if($decodedToken == 0) {
            $this->messageError();
        }

        if($this->form_validation->run() == false) {
            $this->messageError();
        }

        if($this->insertDataUsers()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }
    }

    public function get_data_users_post() 
    {

        $this->form_validation->set_rules('id','ID','required');

        $headers = $this->input->request_headers();

        if(empty($headers['Authorization'])) {
            $this->messageUnAthorized();
        }

        $decodedToken = AUTHORIZATION::checkToken($headers['Authorization'])->num_rows();

        if($decodedToken == 0) {
            $this->messageError();
        }

        if($this->form_validation->run() == false) {
            $this->messageError();
        }

        if(count($this->getDataUsers()) == 0) {
            $this->messageError();
        } 

        $this->messageDataUsers($this->getDataUsers());
    }

    public function index_put() 
    {

        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('nomor','NIM / NISN','required');
        $this->form_validation->set_rules('nama','NAMA','required');

        $headers = $this->input->request_headers();

        if(empty($headers['Authorization'])) {
            $this->messageUnAthorized();
        }

        $decodedToken = AUTHORIZATION::checkToken($headers['Authorization'])->num_rows();

        if($decodedToken == 0) {
            $this->messageUnAthorized();   
        }

        if($this->form_validation->run() == false) {
            $this->messageError();
        }

        if($this->updateDataUsers()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }

    }

    public function search_users_get() 
    {

        $headers = $this->input->request_headers();

        if(empty($headers['Authorization'])) {
            $this->messageUnAthorized();
        }

        $decodedToken = AUTHORIZATION::checkToken($headers['Authorization'])->num_rows();

        if($decodedToken == 0) {
            $this->messageError();
        }

        if($this->form_validation->run() == false) {
            $this->messageError();
        }

        if(count($this->getDataSearchUsers($this->input->get('q'))) == 0) {
            $this->messageError();
        } 


        $this->messageDataUsers($this->getDataSearchUsers($this->input->get('q')));
    }

    private function getDataSearchUsers($search) 
    {
        $data = $this->Users_Model->search($search)->result_array();
        return $data;
    }

    public function index_delete() 
    {
        $this->form_validation->set_data($this->delete());

        $this->form_validation->set_rules('id','ID','required');

        $headers = $this->input->request_headers();

        if(empty($headers['Authorization'])) {
            $this->messageUnAthorized();   
        }

        $decodedToken = AUTHORIZATION::checkToken($headers['Authorization'])->num_rows();

        if($decodedToken == 0) {
            $this->messageUnAthorized();
        }

        if($this->form_validation->run() == false) {
            $this->messageError();   
        }

        if($this->deleteDataUsers()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }
    }

    private function messageUnAthorized() 
    {
        $data = array();
        $data['message'] = 'Data Tidak Ditemukan';
        $data['data'] = [];
        $data['status'] = false;
        $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
    }

    private function messageError() 
    {
        $data = array();
        $data['message'] = 'ISI Data Dengan Baik Dan Benar';
        $data['data'] = [];
        $data['status'] = false;
        $this->set_response($data, REST_Controller::HTTP_BAD_REQUEST);
    }

    private function messageSuccess() 
    {
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    private function messageDataUsers($users) 
    {
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['data'] = $users;
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    private function insertDataUsers() 
    {
        $options = ['cost' => 10];
        $password = "";
        if(empty($this->input->post('password'))) {
            $password = password_hash("admin", PASSWORD_DEFAULT, $options);
        } else {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT, $options);
        }
        $data = [
            'nomor' => $this->input->post('nomor'),
            'id_jabatan' => $this->input->post('id_jabatan'),
            'password' => $password,
            'status' => 1,
            'created_by' => 1
        ];
        $response = $this->Users_Model->save($data);
        return $response;
    }

    private function getDataUsers() 
    {
        $data = $this->Users_Model->filter(['id' => $this->input->post('id')])->result_array();
        return $data;
    }

    private function updateDataUsers() 
    {
        $id = $this->put('id');
        if(empty($this->input->post('password'))) {
            $data = [
                'nomor' => $this->put('nomor'),
                'id_jabatan' => $this->put('id_jabatan'),
                'status' => $this->put('status'),
                'updated_by' => 1,
                'updated_date' => date("Y-m-d H:i:s")
            ];
        } else {
            $options = ['cost' => 10];
            $data = [
                'nomor' => $this->put('nomor'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT, $options),
                'id_jabatan' => $this->put('id_jabatan'),
                'status' => $this->put('status'),
                'updated_by' => 1,
                'updated_date' => date("Y-m-d H:i:s")
            ];    
        }
        
        $response = $this->Users_Model->update($id, $data);
        return $response;
    }

    private function deleteDataUsers() 
    {
        $id = $this->delete('id');
        $data = [
            'status' => 0,
            'deleted_by' => 1,
            'deleted_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Users_Model->delete($id, $data);
        return $response;
    }
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Jabatan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Jabatan_Model']);
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

        $dataJabatan = $this->Jabatan_Model->jabatan()->result_array();
        $response = array('status' => true, 'data' => $dataJabatan);
        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function index_post() 
    {

        $this->form_validation->set_rules('nama','NAMA','required');

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

        if($this->insertDataJabatan()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }
    }

    public function get_data_jabatan_post() 
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

        if(count($this->getDataJabatan()) == 0) {
            $this->messageError();
        } 

        $this->messageDataJabatan($this->getDataJabatan());
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

        if($this->updateDataJabatan()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }

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

        if($this->deleteDataJabatan()) {
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

    private function messageDataJabatan($jabatan) 
    {
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['data'] = $jabatan;
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    private function insertDataJabatan() 
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'status' => 1,
            'created_by' => 1
        ];
        $response = $this->Jabatan_Model->save($data);
        return $response;
    }

    private function getDataJabatan() 
    {
        $data = $this->Jabatan_Model->filter(['id' => $this->input->post('id')])->result_array();
        return $data;
    }

    private function updateDataJabatan() 
    {
        $id = $this->put('id');

        $data = [
            'nama' => $this->put('nama'),
            'status' => $this->put('status'),
            'updated_by' => 1,
            'updated_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Jabatan_Model->update($id, $data);
        return $response;
    }

    private function deleteDataJabatan() 
    {
        $id = $this->delete('id');
        $data = [
            'deleted_by' => 1,
            'deleted_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Jabatan_Model->delete($id, $data);
        return $response;
    }
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Assign_Mahasiswa_Asrama extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Assign_Mahasiswa_Asrama_Model']);
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

        $dataAssignMahasiswaAsrama = $this->Assign_Mahasiswa_Asrama_Model->assign_mahasiswa_asrama()->result_array();
        $response = array('status' => true, 'data' => $dataAssignMahasiswaAsrama);
        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function index_post() 
    {

        $this->form_validation->set_rules('nim','NIM','required');
        $this->form_validation->set_rules('kode_asrama','kode_asrama','required');

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

        if($this->insertDataAssignMahasiswaAsrama()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }
    }

    public function get_data_assign_mahasiswa_asrama_post() 
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

        if(count($this->getDataAssignMahasiswaAsrama()) == 0) {
            $this->messageError();
        } 

        $this->messageDataAssignMahasiswaAsrama($this->getDataAssignMahasiswaAsrama());
    }

    public function index_put() 
    {

        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('nim','NIM','required');
        $this->form_validation->set_rules('kode_asrama','Kode Asrama','required');

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

        if($this->updateDataAssignMahasiswaAsrama()) {
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

        if($this->deleteDataAssignMahasiswaAsrama()) {
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

    private function messageDataAssignMahasiswaAsrama($assignMahasiswaAsrama) 
    {
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['data'] = $assignMahasiswaAsrama;
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    private function insertDataAssignMahasiswaAsrama() 
    {
        $data = [
            'nim' => $this->input->post('nim'),
            'kode_asrama' => $this->input->post('kode_asrama'),
            'status' => 1,
            'created_by' => 1
        ];
        $response = $this->Assign_Mahasiswa_Asrama_Model->save($data);
        return $response;
    }

    private function getDataAssignMahasiswaAsrama() 
    {
        $data = $this->Assign_Mahasiswa_Asrama_Model->filter(['id' => $this->input->post('id')])->result_array();
        return $data;
    }

    private function updateDataAssignMahasiswaAsrama() 
    {
        $id = $this->put('id');

        $data = [
            'nim' => $this->put('nim'),
            'kode_asrama' => $this->put('kode_asrama'),
            'status' => $this->put('status'),
            'updated_by' => 1,
            'updated_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Assign_Mahasiswa_Asrama_Model->update($id, $data);
        return $response;
    }

    private function deleteDataAssignMahasiswaAsrama() 
    {
        $id = $this->delete('id');
        $data = [
            'status' => 0,
            'deleted_by' => 1,
            'deleted_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Assign_Mahasiswa_Asrama_Model->delete($id, $data);
        return $response;
    }
}
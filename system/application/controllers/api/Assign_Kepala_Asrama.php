<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Assign_Kepala_Asrama extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Assign_Kepala_Asrama_Model']);
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

        $dataAssignKepalaAsrama = $this->Assign_Kepala_Asrama_Model->assign_kepala_asrama()->result_array();
        $response = array('status' => true, 'data' => $dataAssignKepalaAsrama);
        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function index_post() 
    {

        $this->form_validation->set_rules('nomor','NIM','required');
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

        if($this->insertDataAssignKepalaAsrama()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }
    }

    public function get_data_assign_kepala_asrama_post() 
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

        if(count($this->getDataAssignKepalaAsrama()) == 0) {
            $this->messageError();
        } 

        $this->messageDataAssignKepalaAsrama($this->getDataAssignKepalaAsrama());
    }

    public function index_put() 
    {

        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('id_asrama','NIM','required');
        $this->form_validation->set_rules('nomor','Kode Asrama','required');

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

        if($this->updateDataAssignKepalaAsrama()) {
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

        if($this->deleteDataAssignKepalaAsrama()) {
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

    private function messageDataAssignKepalaAsrama($assignKepalaAsrama) 
    {
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['data'] = $assignKepalaAsrama;
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    private function insertDataAssignKepalaAsrama() 
    {
        $data = [
            'nomor' => $this->input->post('nomor'),
            'kode_asrama' => $this->input->post('kode_asrama'),
            'status' => 1,
            'created_by' => 1
        ];
        $response = $this->Assign_Kepala_Asrama_Model->save($data);
        return $response;
    }

    private function getDataAssignKepalaAsrama() 
    {
        $data = $this->Assign_Kepala_Asrama_Model->filter(['id' => $this->input->post('id')])->result_array();
        return $data;
    }

    private function updateDataAssignKepalaAsrama() 
    {
        $id = $this->put('id');

        $data = [
            'id_jabatan' => $this->put('id_jabatan'),
            'nomor' => $this->put('nomor'),
            'status' => $this->put('status'),
            'updated_by' => 1,
            'updated_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Assign_Kepala_Asrama_Model->update($id, $data);
        return $response;
    }

    private function deleteDataAssignKepalaAsrama() 
    {
        $id = $this->delete('id');
        $data = [
            'status' => 0,
            'deleted_by' => 1,
            'deleted_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Assign_Kepala_Asrama_Model->delete($id, $data);
        return $response;
    }
}
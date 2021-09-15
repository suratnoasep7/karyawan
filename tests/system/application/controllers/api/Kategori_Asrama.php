<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Kategori_Asrama extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Kategori_Asrama_Model']);
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

        $dataKategoriAsrama = $this->Kategori_Asrama_Model->kategori_asrama()->result_array();
        $response = array('status' => true, 'data' => $dataKategoriAsrama);
        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function index_post() 
    {

        $this->form_validation->set_rules('kode_kategori_asrama','NIM / NISN','required');
        $this->form_validation->set_rules('nama_kategori_asrama','NAMA','required');

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

        if($this->insertDataKategoriAsrama()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }
    }

    public function get_data_kategori_asrama_post() 
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

        if(count($this->getDataKategoriAsrama()) == 0) {
            $this->messageError();
        } 

        $this->messageDataKategoriAsrama($this->getDataKategoriAsrama());
    }

    public function index_put() 
    {

        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('kode_kategori_asrama','NIM / NISN','required');
        $this->form_validation->set_rules('nama_kategori_asrama','NAMA','required');

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

        if($this->updateDataKategoriAsrama()) {
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

        if($this->deleteDataKategoriAsrama()) {
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

    private function messageDataKategoriAsrama($kategoriAsrama) 
    {
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['data'] = $kategoriAsrama;
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    private function insertDataKategoriAsrama() 
    {
        $data = [
            'kode_kategori_asrama' => $this->input->post('kode_asrama'),
            'nama_kategori_asrama' => $this->input->post('nama_asrama'),
            'status' => 1,
            'created_by' => 1
        ];
        $response = $this->Kategori_Asrama_Model->save($data);
        return $response;
    }

    private function getDataKategoriAsrama() 
    {
        $data = $this->Kategori_Asrama_Model->filter(['id' => $this->input->post('id')])->result_array();
        return $data;
    }

    private function updateDataKategoriAsrama() 
    {
        $id = $this->put('id');

        $data = [
            'kode_kategori_asrama' => $this->put('kode_asrama'),
            'nama_kategori_asrama' => $this->put('nama_asrama'),
            'status' => $this->put('status'),
            'updated_by' => 1,
            'updated_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Kategori_Asrama_Model->update($id, $data);
        return $response;
    }

    private function deleteDataKategoriAsrama() 
    {
        $id = $this->delete('id');
        $data = [
            'status' => 0,
            'deleted_by' => 1,
            'deleted_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Kategori_Asrama_Model->delete($id, $data);
        return $response;
    }
}
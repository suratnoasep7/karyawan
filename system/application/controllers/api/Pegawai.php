<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Pegawai extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Pegawai_Model']);
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

        $dataPegawai = $this->Pegawai_Model->pegawai()->result_array();
        $response = array('status' => true, 'data' => $dataPegawai);
        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function index_post() 
    {

        $this->form_validation->set_rules('nip','NIM / NISN','required');
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

        if($this->insertDataPegawai()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }
    }

    public function get_data_pegawai_post() 
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

        if(count($this->getDataPegawai()) == 0) {
            $this->messageError();
        } 

        $this->messageDataPegawai($this->getDataPegawai());
    }

    public function get_pegawai_get() 
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

        if(count($this->getSearchDataPegawai($this->input->get('q'))) == 0) {
            $this->messageError();
        } 

        $this->messageDataPegawai($this->getSearchDataPegawai($this->input->get('q')));
    }

    public function index_put() 
    {

        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('nip','NIM / NISN','required');
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

        if($this->updateDataPegawai()) {
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

        if($this->deleteDataPegawai()) {
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

    private function messageDataPegawai($pegawai) 
    {
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['data'] = $pegawai;
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    private function insertDataPegawai() 
    {
        $data = [
            'nomor' => $this->input->post('nip'),
            'nama' => $this->input->post('nama'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'status' => 1,
            'created_by' => 1
        ];
        $response = $this->Pegawai_Model->save($data);
        return $response;
    }

    private function getDataPegawai() 
    {
        $data = $this->Pegawai_Model->filter(['id' => $this->input->post('id')])->result_array();
        return $data;
    }

    private function getSearchDataPegawai($search) 
    {
        $data = $this->Pegawai_Model->search($search)->result_array();
        return $data;
    }

    private function updateDataPegawai() 
    {
        $id = $this->put('id');

        $data = [
            'nomor' => $this->put('nip'),
            'nama' => $this->put('nama'),
            'tempat_lahir' => $this->put('tempat_lahir'),
            'tanggal_lahir' => $this->put('tanggal_lahir'),
            'alamat' => $this->put('alamat'),
            'nomor_telepon' => $this->put('nomor_telepon'),
            'jenis_kelamin' => $this->put('jenis_kelamin'),
            'status' => $this->put('status'),
            'updated_by' => 1,
            'updated_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Pegawai_Model->update($id, $data);
        return $response;
    }

    private function deleteDataPegawai() 
    {
        $id = $this->delete('id');
        $data = [
            'status' => 0,
            'deleted_by' => 1,
            'deleted_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Pegawai_Model->delete($id);
        return $response;
    }
}
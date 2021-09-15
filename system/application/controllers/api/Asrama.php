<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Asrama extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Asrama_Model']);
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

        $dataAsrama = $this->Asrama_Model->asrama()->result_array();
        $response = array('status' => true, 'data' => $dataAsrama);
        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function index_post() 
    {

        $this->form_validation->set_rules('kode_kategori_asrama','NIM / NISN','required');

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

        if($this->insertDataAsrama()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }
    }

    public function get_data_asrama_post() 
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

        if(count($this->getDataAsrama()) == 0) {
            $this->messageError();
        } 

        $this->messageDataAsrama($this->getDataAsrama());
    }

    public function get_asrama_get() 
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

        if(count($this->getAsrama($this->input->get('q'))) == 0) {
            $this->messageError();
        } 

        $this->messageDataAsrama($this->getAsrama($this->input->get('q')));
    }

    public function get_data_asrama_mahasiswa_get() 
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

        if(count($this->getDataAsramaMahasiswa($this->input->get('q'))) == 0) {
            $this->messageError();
        } 
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['data'] = $this->getDataAsramaMahasiswa($this->input->get('q'));
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    public function get_data_asrama_siswa_get() 
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

        if(count($this->getDataAsramaSiswa($this->input->get('q'))) == 0) {
            $this->messageError();
        } 
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['data'] = $this->getDataAsramaSiswa($this->input->get('q'));
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    public function index_put() 
    {

        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('kode_kategori_asrama','NIM / NISN','required');

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

        if($this->updateDataAsrama()) {
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

        if($this->deleteDataAsrama()) {
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

    private function messageDataAsrama($asrama) 
    {
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['data'] = $asrama;
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    private function insertDataAsrama() 
    {
        $kode_asrama = $this->input->post('kode_kategori_asrama').$this->input->post('hall').$this->input->post('nomor_kamar').$this->input->post('lantai');
        $data = [
            'kode_kategori_asrama' => $this->input->post('kode_kategori_asrama'),
            'kode_asrama' => $kode_asrama,
            'hall' => $this->input->post('hall'),
            'nomor_kamar' => $this->input->post('nomor_kamar'),
            'lantai' => $this->input->post('lantai'),
            'status' => 1,
            'created_by' => 1
        ];
        $response = $this->Asrama_Model->save($data);
        return $response;
    }

    private function getDataAsrama() 
    {
        $data = $this->Asrama_Model->filter(['id' => $this->input->post('id')])->result_array();
        return $data;
    }

    private function getAsrama($search) 
    {
        $data = $this->Asrama_Model->searchAsrama($search)->result_array();
        return $data;
    }

    private function getDataAsramaMahasiswa($search) 
    {
        $data = $this->Asrama_Model->search($search)->result_array();
        return $data;
    }

    private function getDataAsramaSiswa($search) 
    {
        $data = $this->Asrama_Model->searchAsramaSiswa($search)->result_array();
        return $data;
    }

    private function updateDataAsrama() 
    {
        $id = $this->put('id');
        $kode_asrama = $this->input->post('kode_kategori_asrama').$this->input->post('hall').$this->input->post('nomor_kamar').$this->input->post('lantai');
        $data = [
            'kode_kategori_asrama' => $this->put('kode_kategori_asrama'),
            'kode_asrama' => $kode_asrama,
            'hall' => $this->put('hall'),
            'nomor_kamar' => $this->put('nomor_kamar'),
            'lantai' => $this->put('lantai'),
            'status' => $this->put('status'),
            'updated_by' => 1,
            'updated_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Asrama_Model->update($id, $data);
        return $response;
    }

    private function deleteDataAsrama() 
    {
        $id = $this->delete('id');
        $data = [
            'status' => 0,
            'deleted_by' => 1,
            'deleted_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Asrama_Model->delete($id, $data);
        return $response;
    }
}
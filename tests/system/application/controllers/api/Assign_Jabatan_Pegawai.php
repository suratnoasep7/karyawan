<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Assign_Jabatan_Pegawai extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Assign_Jabatan_Pegawai_Model']);
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

        $dataAssignMahasiswaAsrama = $this->Assign_Jabatan_Pegawai_Model->assign_jabatan_pegawai()->result_array();
        $response = array('status' => true, 'data' => $dataAssignMahasiswaAsrama);
        return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function index_post() 
    {

        $this->form_validation->set_rules('id_jabatan','NIM','required');
        $this->form_validation->set_rules('nomor','kode_asrama','required');

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

        if($this->insertDataAssignJabatanPegawai()) {
            $this->messageSuccess();
        } else {
            $this->messageError();
        }
    }

    public function get_data_assign_jabatan_pegawai_post() 
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

        if(count($this->getDataAssignJabatanPegawai()) == 0) {
            $this->messageError();
        } 

        $this->messageDataAssignJabatanPegawai($this->getDataAssignJabatanPegawai());
    }

    public function get_data_assign_jabatan_pegawai_nomor_post() 
    {
        $this->form_validation->set_rules('nomor','NOMOR','required');

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

        if(count($this->getDataAssignJabatanPegawaiNomor()) == 0) {
            $this->messageError();
        } 

        $this->messageDataAssignJabatanPegawai($this->getDataAssignJabatanPegawaiNomor());   
    }

    public function get_data_kepala_asrama_get() 
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

        if(count($this->getDataAssignKepalaAsrama($this->input->get('q'))) == 0) {
            $this->messageError();
        } 

        $this->messageDataAssignJabatanPegawai($this->getDataAssignKepalaAsrama($this->input->get('q')));
    }

    public function get_assign_jabatan_get() 
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

        if(count($this->getDataAssignJabatan($this->input->get('q'))) == 0) {
            $this->messageError();
        } 

        $this->messageDataAssignJabatanPegawai($this->getDataAssignJabatan($this->input->get('q')));
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

        if($this->updateDataAssignJabatanPegawai()) {
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

        if($this->deleteDataAssignJabatanPegawai()) {
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

    private function messageDataAssignJabatanPegawai($assignJabatanPegawai) 
    {
        $data = array();
        $data['message'] = 'SUCCESS';
        $data['data'] = $assignJabatanPegawai;
        $data['status'] = true;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    private function insertDataAssignJabatanPegawai() 
    {
        $data = [
            'id_jabatan' => $this->input->post('id_jabatan'),
            'nomor' => $this->input->post('nomor'),
            'status' => 1,
            'created_by' => 1
        ];
        $response = $this->Assign_Jabatan_Pegawai_Model->save($data);
        return $response;
    }

    private function getDataAssignKepalaAsrama($search) 
    {
        $data = $this->Assign_Jabatan_Pegawai_Model->searchKepalaAsrama($search)->result_array();
        return $data;   
    }

    private function getDataAssignJabatan($search) 
    {
        $data = $this->Assign_Jabatan_Pegawai_Model->search($search)->result_array();
        return $data;   
    }
 
    private function getDataAssignJabatanPegawai() 
    {
        $data = $this->Assign_Jabatan_Pegawai_Model->filter(['id' => $this->input->post('id')])->result_array();
        return $data;
    }

    private function getDataAssignJabatanPegawaiNomor() 
    {
        $data = $this->Assign_Jabatan_Pegawai_Model->filter(['nomor' => $this->input->post('nomor')])->result_array();
        return $data;
    }



    private function updateDataAssignJabatanPegawai() 
    {
        $id = $this->put('id');

        $data = [
            'id_jabatan' => $this->put('id_jabatan'),
            'nomor' => $this->put('nomor'),
            'status' => $this->put('status'),
            'updated_by' => 1,
            'updated_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Assign_Jabatan_Pegawai_Model->update($id, $data);
        return $response;
    }

    private function deleteDataAssignJabatanPegawai() 
    {
        $id = $this->delete('id');
        $data = [
            'status' => 0,
            'deleted_by' => 1,
            'deleted_date' => date("Y-m-d H:i:s")
        ];
        $response = $this->Assign_Jabatan_Pegawai_Model->delete($id, $data);
        return $response;
    }
}
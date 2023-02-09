<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPelamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Datapelamar_model');
    }

    public function index()
    {
        $data['title'] = "Data Pemalar";
        $data['datapelamar'] = $this->Datapelamar_model->getAllDatapelamar();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('recruitment/datapelamar', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        if ($this->Datapelamar_model->hapus($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('recruitment/datapelamar');
    }
}

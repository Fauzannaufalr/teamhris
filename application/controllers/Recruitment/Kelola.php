<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kelola_model');
    }

    public function index()
    {
        $data['title'] = "Kelola Pekerjaan";
        $data['kelolapekerjaan'] = $this->Kelola_model->getAllKelolapekerjaan();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('recruitment/kelola', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        if ($this->Kelola_model->hapus($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('recruitment/kelola');
    }
}

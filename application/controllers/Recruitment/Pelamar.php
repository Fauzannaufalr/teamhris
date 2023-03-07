<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/Pelamar_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');
        $this->load->helper(array('url', 'download'));

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Data Pelamar";
        $data['pelamar'] = $this->Pelamar_model->getAllPelamar();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('recruitment/pelamar', $data);
        $this->load->view('templates/footer');
    }





    public function hapus($id_pelamar)
    {
        if ($this->Pelamar_model->hapus($id_pelamar)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('recruitment/pelamar');
    }
}

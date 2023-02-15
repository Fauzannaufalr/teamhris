<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SoalPelamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SoalPelamar_model');
    }

    public function index()
    {
        $data['title'] = "Soal Tes Pelamar";
        $data['soalpelamar'] = $this->SoalPelamar_model->getAllSoalPelamar();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/soalpelamar', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Soal Tes Pelamar";
        $data['soalpelamar'] = $this->SoalPelamar_model->getAllSoalPelamar();

        $this->form_validation->set_rules('soalpelamar', 'soal_pelamar', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/soalpelamar', $data);
            $this->load->view('templates/footer');
        } else {
            $this->SoalPelamar_model->tambahSoalPelamar();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('master/soalpelamar');
        }
    }

    public function hapus($id_soal_pelamar)
    {
        if ($this->DataMitra_model->hapus($id_soal_pelamar)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data gagal dihapus!</div>');
        }
        redirect('master/soalpelamar');
    }
}

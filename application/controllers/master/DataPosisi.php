<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPosisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataPosisi_model');
    }

    public function index()
    {
        $data['title'] = "Data Posisi";
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/dataposisi', $data);
        $this->load->view('templates/footer');
    }
    public function tambah()
    {
        $data['title'] = "Data Posisi";
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $this->form_validation->set_rules('posisi', 'Posisi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/dataposisi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataPosisi_model->tambahDataPosisi();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('master/dataposisi');
        }
    }

    public function ubah()
    {
        $data['title'] = "Data Posisi";
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $this->form_validation->set_rules('posisi', 'Nama Posisi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/dataposisi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataPosisi_model->ubahDataPosisi();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diedit!</div>');
            redirect('master/dataposisi');
        }
    }



    public function hapus($id_posisi)
    {
        if ($this->DataPosisi_model->hapus($id_posisi)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data gagal dihapus!</div>');
        }
        redirect('master/dataposisi');
    }
}

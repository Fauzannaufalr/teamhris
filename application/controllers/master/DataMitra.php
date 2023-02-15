<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMitra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataMitra_model');
    }

    public function index()
    {
        $data['title'] = "Data Mitra";
        $data['datamitra'] = $this->DataMitra_model->getAllDataMitra();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/datamitra', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Data Mitra";
        $data['datamitra'] = $this->DataMitra_model->getAllDataMitra();

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required');
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('id_posisi', 'Posisi', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal_masuk', 'required');
        $this->form_validation->set_rules('tanggal_keluar', 'tanggal_keluar', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/datamitra', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataMitra_model->tambahDataMitra();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('master/datamitra');
        }
    }

    public function hapus($id_mitra)
    {
        if ($this->DataMitra_model->hapus($id_mitra)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data gagal dihapus!</div>');
        }
        redirect('master/datamitra');
    }
}

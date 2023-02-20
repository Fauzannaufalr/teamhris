<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenilaianKinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PenilaianKinerja_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('DataPosisi_model');
    }

    public function index()
    {
        $data['title'] = "PenilaiKinerja";
        $data['penilaiankinerja'] = $this->PenilaianKinerja_model->getAllPenilaianKinerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawans();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('performances/penilaiankinerja', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = "Penilaian Kinerja";
        $data['PenilaianKinerja'] = $this->PenilaianKinerja_model->getAllPenilaianKinerja();

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('posisi', 'Posisi', 'required');
        $this->form_validation->set_rules('total_kerja', 'Total Kerja', 'required');
        $this->form_validation->set_rules('done_kerja', 'Done Kerja', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('performances/penilaiankinerja', $data);
            $this->load->view('templates/footer');
        } else {
            $this->PenilaianKinerja_model->tambahpenilaiankinerja();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('performances/penilaiankinerja');
        }
    }

    public function edit()
    {
        $data['title'] = "Data Karyawan";
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/datakaryawan', $data);
        $this->load->view('templates/footer');
    }

   
    public function hapus($id_karyawan)
    {
        if ($this->DataKaryawan_model->hapus($id_karyawan)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('master/datakaryawan');
    }
}

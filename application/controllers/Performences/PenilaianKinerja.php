<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenilaianKinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PenilaianKinerja_model');
    }

    public function index()
    {
        $data['title'] = "Penilaian Kinerja";
        $data['penilaiankinerja'] = $this->PenilaianKinerja_model->getAllPenilaianKinerja();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('performences/penilaiankinerja', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = "Penilaian Kinerja";
        $data['penilaiankinerja'] = $this->PenilaianKinerja_model->getAllDataKaryawan();

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('posisi', 'Posisi', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('gajipokok', 'Gaji pokok', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('foto', 'Foto', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/datakaryawan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataKaryawan_model->tambahDataKaryawan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('master/datakaryawan');
        }
    }
    public function hapus($id_penilaian_kinerja)
    {
        if ($this->PenilaianKinerja_model->hapus($id_penilaian_kinerja)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('performences/penilaiankinerja'); //ke view performences
    }

  
}

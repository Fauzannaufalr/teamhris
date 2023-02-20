<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMitra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataMitra_model');
        $this->load->model('DataPosisi_model');
    }

    public function index()
    {
        $data['title'] = "Data Mitra";
        $data['datamitra'] = $this->DataMitra_model->getAllDataMitra();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
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

        $this->form_validation->set_rules('nik', 'NIK', 'required', [
            'required' => 'NIK harus diisi !'
        ]);
        $this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required', [
            'required' => 'Nama Perusahaan harus diisi !'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required', [
            'required' => 'Nama Karyawan harus diisi !'
        ]);
        $this->form_validation->set_rules('posisi', 'Posisi', 'required', [
            'required' => 'Posisi harus diisi !'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required', [
            'required' => 'Email harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal_masuk', 'required', [
            'required' => 'Tanggal masuk harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal_keluar', 'tanggal_keluar', 'required', [
            'required' => 'Tanggal keluar harus diisi !'
        ]);

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

    public function ubah($id)
    {
        $data['title'] = "Data Mitra";
        $data['datamitra'] = $this->DataMitra_model->getAllDataMitra();
        $data['mitra'] = $this->DataMitra_model->ambilDataById($id);

        $this->form_validation->set_rules('nik', 'NIK', 'required', [
            'required' => 'NIK harus diisi !'
        ]);
        $this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required', [
            'required' => 'Nama Perusahaan harus diisi !'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required', [
            'required' => 'Nama Karyawan harus diisi !'
        ]);
        $this->form_validation->set_rules('posisi', 'Posisi', 'required', [
            'required' => 'Posisi harus diisi !'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required', [
            'required' => 'Email harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal_masuk', 'required', [
            'required' => 'Tanggal masuk harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal_keluar', 'tanggal_keluar', 'required', [
            'required' => 'Tanggal keluar harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/datamitra', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataMitra_model->ubahDataMitra();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diubah!</div>');
            redirect('master/datamitra');
        }
    }

    public function hapus($id_mitra)
    {
        $data['mitra'] = $this->DataMitra_model->ambilDataById($id_mitra);
        if ($this->DataMitra_model->hapus($id_mitra)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data gagal dihapus!</div>');
        }
        redirect('master/datamitra');
    }
}

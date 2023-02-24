<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/Pekerjaan_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Admin_model');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Pekerjaan";
        $data['pekerjaan'] = $this->Pekerjaan_model->getAllPekerjaan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Admin_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('recruitment/pekerjaan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = "Pekerjaan";
        $data['pekerjaan'] = $this->Pekerjaan_model->getAllPekerjaan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Admin_model->ambilUser();

        $this->form_validation->set_rules('posisi', 'Posisi Pekerjaan', 'required', [
            'required' => 'Nama harus diisi !'
        ]);
        $this->form_validation->set_rules('deskripsi_pekerjaan', 'Deskripsi', 'required', [
            'required' => 'Deskripsi harus diisi !'
        ]);
        $this->form_validation->set_rules('kualifikasi', 'Kualifikasi', 'required', [
            'required' => 'Kualifikasi harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal_berakhir', 'Tanggal Berakhir', 'required', [
            'required' => 'Tanggal Berakhir harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('recruitment/pekerjaan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pekerjaan_model->tambahPekerjaan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('recruitment/pekerjaan');
        }
    }

    public function ubah()
    {
        $data['title'] = "Pekerjaan";
        $data['pekerjaan'] = $this->Pekerjaan_model->getAllPekerjaan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Admin_model->ambilUser();

        $this->form_validation->set_rules('posisi', 'Posisi Pekerjaan', 'required', [
            'required' => 'Nama harus diisi !'
        ]);
        $this->form_validation->set_rules('deskripsi_pekerjaan', 'Deskripsi', 'required', [
            'required' => 'Deskripsi harus diisi !'
        ]);
        $this->form_validation->set_rules('kualifikasi', 'Kualifikasi', 'required', [
            'required' => 'Kualifikasi harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal_berakhir', 'Tanggal Berakhir', 'required', [
            'required' => 'Tanggal Berakhir harus diisi !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('recruitment/pekerjaan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pekerjaan_model->ubahPekerjaan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diedit!</div>');
            redirect('recruitment/pekerjaan');
        }
    }


    public function hapus($id_pekerjaan)
    {
        if ($this->Pekerjaan_model->hapus($id_pekerjaan)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('recruitment/pekerjaan');
    }
}

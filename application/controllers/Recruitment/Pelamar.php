<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/Pelamar_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Admin_model');
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
        $data['user'] = $this->Admin_model->ambilUser();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('recruitment/pelamar', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = "Data Pelamar";
        $data['pelamar'] = $this->Pekerjaan_model->getAllPelamar();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Admin_model->ambilUser();

        $this->form_validation->set_rules('posisi', 'Posisi Pekerjaan', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email harus diisi !',
            'valid_email' => 'Yang anda masukan bukan email !'
        ]);
        $this->form_validation->set_rules('file_cv', 'File CV', 'required', [
            'required' => 'Upload CV !'
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('recruitment/pelamar', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pekerjaan_model->tambahPelamar();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('recruitment/pelamar');
        }
    }

    public function ubah()
    {
        $data['title'] = "Data Pelamar";
        $data['pelamar'] = $this->Pekerjaan_model->getAllPelamar();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Admin_model->ambilUser();

        $this->form_validation->set_rules('posisi', 'Posisi Pekerjaan', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email harus diisi !',
            'valid_email' => 'Yang anda masukan bukan email !'
        ]);
        $this->form_validation->set_rules('file_cv', 'File CV', 'required', [
            'required' => 'Upload CV !'
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('recruitment/pelamar', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pekerjaan_model->ubahPelamar();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diedit!</div>');
            redirect('recruitment/pelamar');
        }
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

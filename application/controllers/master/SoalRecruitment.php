<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SoalRecruitment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SoalRecruitment_model');
        $this->load->model('DataPosisi_model');
    }

    public function index()
    {
        $data['title'] = "Soal Tes Pelamar";
        $data['soalrecruitment'] = $this->SoalRecruitment_model->getAllSoalRecruitment();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/soalrecruitment', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Soal Tes Pelamar";
        $data['soalrecruitment'] = $this->SoalRecruitment_model->getAllSoalRecruitment();

        $this->form_validation->set_rules('posisi', 'Posisi', 'required');
        $this->form_validation->set_rules('link_soal', 'Link Soal', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/soalrecruitment', $data);
            $this->load->view('templates/footer');
        } else {
            $this->SoalRecruitment_model->tambahSoalRecruitment();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('master/soalrecruitment');
        }
    }

    public function ubah()
    {
        $data['title'] = "Soal Recruitment";
        $data['soalrecruitment'] = $this->SoalRecruitment_model->getAllSoalRecruitment();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();

        $this->form_validation->set_rules('link_soal', 'Link Soal', 'required', [
            'required' => 'NIK harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/soalrecruitment', $data);
            $this->load->view('templates/footer');
        } else {
            $this->SoalRecruitment_model->ubahSoalRecruitment();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diubah!</div>');
            redirect('master/soalrecruitment');
        }
    }
    public function hapus($id)
    {
        // Menghapus data pada tabel 'produk' dengan ID yang sesuai
        $this->db->where('id_soal_recruitment', $id);
        $this->db->delete('soal_recruitment');

        // Redirect ke halaman daftar produk setelah berhasil menghapus data
        redirect('master/soalrecruitment');
    }

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SoalPelamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SoalPelamar_model');
        $this->load->model('DataPosisi_model');
    }

    public function index()
    {
        $data['title'] = "Soal Tes Pelamar";
        $data['soalpelamar'] = $this->SoalPelamar_model->getAllSoalPelamar();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
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

        $this->form_validation->set_rules('posisi', 'Posisi', 'required');
        $this->form_validation->set_rules('link_soal', 'Link Soal', 'required');

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
        if ($this->SoalPelamar_model->hapus($id_soal_pelamar)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data gagal dihapus!</div>');
        }
        redirect('master/soalpelamar');
    }

    public function edit($id)
    {

        $data['soal'] = $this->soal_model->get_soal_by_id($id);
        $this->load->view('soal/edit', $data);
    }

    public function update()
    {

        $id = $this->input->post('id_soal_recruitment');
        $nama_posisi = $this->input->post('id_posisi');
        $link_soal = $this->input->post('link_soal');
        $this->soal_model->update_soal($id, $nama_posisi, $link_soal);
        echo json_encode(array("status" => TRUE));
    }
}

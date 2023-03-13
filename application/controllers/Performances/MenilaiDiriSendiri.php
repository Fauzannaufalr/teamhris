<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenilaiDiriSendiri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('performances/MenilaiDiriSendiri_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('SoalKuesioner_model');
        $this->load->model('Hris_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Menilai Diri Sendiri";
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/menilaidirisendiri', $data);
        $this->load->view('templates/footer');
    }

    public function simpan_jawaban()
    {
        // Memeriksa apakah metode HTTP yang digunakan adalah POST
        if ($this->input->method() != 'post') {
            redirect('kuesioner');
        }

        // Mendapatkan data dari formulir jawaban kuesioner
        $data_jawaban = array(
            'id' => $this->input->post('nama'),
            'id_karyawan' => $this->input->post('umur'),
            'jawaban_pertanyaan_1' => $this->input->post('jawaban_pertanyaan_1'),
            'jawaban_pertanyaan_2' => $this->input->post('jawaban_pertanyaan_2'),
            'jawaban_pertanyaan_3' => $this->input->post('jawaban_pertanyaan_3'),
            'jawaban_pertanyaan_4' => $this->input->post('jawaban_pertanyaan_4')
        );

        // Memasukkan data jawaban kuesioner ke dalam database
        $this->load->model('performances/MenilaiDiriSendiri_model');
        $result = $this->MenilaiDiriSendiri_model->insert_jawaban($data_jawaban);

        // Menampilkan pesan berhasil atau gagal
        if ($result) {
            $this->session->set_flashdata('success_message', 'Jawaban kuesioner berhasil disimpan');
        } else {
            $this->session->set_flashdata('error_message', 'Jawaban kuesioner gagal disimpan');
        }

        redirect('performances/menilaidirisendiri');
    }

}
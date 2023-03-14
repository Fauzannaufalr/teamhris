<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenilaiRekan2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('performances/MenilaiRekan2_model');
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
        $nik = $this->session->userdata("nik"); // berdasarkan nik.
        $data['title'] = "Menilai Rekan2";
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['datakaryawan'] = $this->DataKaryawan_model->getDataKaryawanExcept($nik); // nik menampilkan data karyawan yang nik nya bukan dari login
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/menilairekan2', $data);
        $this->load->view('templates/footer');
    }

    public function kirim()
    {
        // Ambil data dari form menilai rekan2 
        $nik_penilai = $this->input->post('nik_penilai');
        $menilai = $this->input->post('menilai');
        $tanggal_dibuat = $this->input->post('tanggal_dibuat');
        $total_soal = $this->input->post('total_soal');
        $total_nilai = $this->input->post('total_nilai');


        // Simpan data ke database penilaian kusioner
        $this->load->model('MenilaiRekan2_model');
        $data = array(
            'nik_penilai' => $nik_penilai,
            'menilai' => $menilai,
            'tanggal_dibuat' => $tanggal_dibuat,
            'total_soal' => $total_soal,
            'total_nilai' => $total_nilai,
        );
        $this->MenilaiRekan2_model->simpan_data($data);

        // Tampilkan pesan sukses atau redirect ke halaman lain
        $this->session->set_flashdata('success', 'Terima kasih atas partisipasi Anda.');
        redirect('performances/menilairekan2');
    }
}
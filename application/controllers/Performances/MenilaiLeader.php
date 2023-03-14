<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenilaiLeader extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('performances/MenilaiLeader_model');
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
        $data['title'] = "Menilai Leader";
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/menilaileader', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {

        $data['title'] = "Data Karyawan";
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        // Ambil data dari form menilai leader
        $id_penilaian_kuesioner = $this->input->post('id_penilaian_kuesioner');
        $nik_penilai = $this->input->post('nik_penilai');
        $menilai = $this->input->post('menilai');
        $tanggal = $this->input->post('tanggal');
        $total_soal = $this->input->post('total_soal');
        $total_nilai = $this->input->post('total_nilai');
        $data = [
            "id_penilaian_kuesioner" => $id_penilaian_kuesioner,
            "nik_penilai" => $nik_penilai,
            "menilai" => $nik_penilai,
            "tanggal" => $tanggal,
            "total_nilai" => $total_nilai,
            "total_soal" => $total_soal,
            // masukin table dari penilaian kuesioner
        ];

        // insert detail penilaian kuesioner
        foreach ($nilai as $id_kuesioner => $val):
            $data = [
                "ïd_kuesioner" => $id_kuesioner,
                "ïd_detail_penilaian" => $id_detail_penilaian,
                "id_penilaian_kuesioner" => $id_penilaian_kuesioner,
                "nik_penilai" => $nik_penilai,
                "nik_menilai" => $nik_menilai,
                "tanggal" => $tanggal,
                "nilai" => $val,
            ];
            $this->db->insert("performances___detail_penilaian_kuesioner", $data);
        endforeach;

        // Simpan data ke database penilaian kusioner
        $this->load->model('MenilaiLeader_model');
        $data = array(
            'nik_penilai' => $nik_penilai,
            'menilai' => $menilai,
            'tanggal_dibuat' => $tanggal_dibuat,
            'total_soal' => $total_soal,
            'total_nilai' => $total_nilai,
        );
        $this->MenilaiLeader_model->simpan_data($data);

        // Tampilkan pesan sukses atau redirect ke halaman lain
        $this->session->set_flashdata('success', 'Terima kasih atas partisipasi Anda.');
        redirect('performances/menilaileader');
    }

}
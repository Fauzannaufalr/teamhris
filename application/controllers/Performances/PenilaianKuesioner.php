<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenilaianKuesioner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('performances/PenilaianKuesioner_model');
        $this->load->model('SoalKuesioner_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Penilaian kuesioner";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }

        $data['penilaiankuesioner'] = $this->db->query("SELECT performances___penilaian_kuesioner.*,
            data_karyawan.nama_karyawan, data_karyawan.id_posisi
            FROM performances___penilaian_kuesioner
            INNER JOIN data_karyawan ON performances___penilaian_kuesioner.nik_penilai=data_karyawan.nik
            WHERE performances___penilaian_kuesioner.tanggal='$bulantahun'
            ORDER BY data_karyawan.nama_karyawan ASC")->result_array();

        $data['penilaiankuesioner'] = $this->PenilaianKuesioner_model->tampilPenilaianKuesioner();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        // printr($bulantahun);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/penilaiankuesioner', $data);
        $this->load->view('templates/footer');
    }
    public function detail($id)
    {
        $data['title'] = 'Detail Kuesioner';
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();
        $data['penilaiankuesioner'] = $this->PenilaianKuesioner_model->ambilUserById($id);
        $data['detailkuesioner'] = $this->PenilaianKuesioner_model->ambilUserById($id);
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/detailkuesioner', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        if ($this->PenilaianKuesioner_model->hapus($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('performances/penilaiankuesioner');
    }

    public function cetakKuesioner()
    {
        $data['title'] = "Penilaian Kuesioner";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }

        $data['cetak_kuesioner'] = $this->PenilaianKuesioner_model->cetakKuesioner($bulantahun);
        // printr($data['cetak_kinerja']);
        $this->load->view('templates/header', $data);
        $this->load->view('performances/cetak_kuesioner', $data);
    }


}
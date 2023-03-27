<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akumulasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('performances/Akumulasi_model');
        $this->load->model('performances/PenilaianKuesioner_model');
        $this->load->model('performances/PenilaianKinerja_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {

        $data['title'] = 'Detail Akumulasi';
        $data['user'] = $this->Hris_model->ambilUser();

        $data['title'] = "Akumulasi Penilaian";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['akumulasi'] = $this->db->query("SELECT DISTINCT *
        FROM performances___penilaian_kuesioner 
        JOIN data_karyawan ON  performances___penilaian_kuesioner.nik_menilai = data_karyawan.nik
        JOIN performances___penilaian_kinerja ON  performances___penilaian_kinerja.nik = data_karyawan.nik
        WHERE performances___penilaian_kuesioner.tanggal AND performances___penilaian_kinerja.tgl='$bulantahun'")->result_array();
        // printr($data['akumulasi']);
        // $nik_session = $this->session->userdata('nik');
        // $data['akumulasi'] = $this->db->query("SELECT 
        // ak.id_akumulasi_penilaian,
        // ak.id_penilaian_kinerja,
        // ak.id_penilaian_kuesioner,
        // dk_a.nama_karyawan,
        // ak.nilai,
        // ak.kategorisasi,
        // FROM performances___akumulasi_penilaian ak
        // INNER JOIN data_karyawan dk_a ON ak.nik= dk_a.nik 
        // INNER JOIN penilaian_kinerja dk_a ON ak.nilai = dk_a.nik 
        // INNER JOIN penilaian_kuesioner dk_a ON ak.total_nilai = dk_a.nik 
        // ")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/akumulasi_admin', $data);
        $this->load->view('templates/footer');
    }



    public function cetakAkumulasi()
    {
        $data['title'] = "Akumulasi Karyawan";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }

        $data['cetak_akumulasi_admin'] = $this->Akumulasi_model->cetakAkumulasi($bulantahun);
        // printr($data['cetak_akumulasi']);
        $this->load->view('templates/header', $data);
        $this->load->view('performances/cetak_akumulasi_admin', $data);
    }


    public function detail($id)
    {
        $data['title'] = 'Detail Akumulasi';
        $data['detail'] = $this->Akumulasi_model->tampilAkumulasi($id);
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/detailakumulasi', $data);
        $this->load->view('templates/footer');
    }

    public function karyawanAkumulasi()
    {
        $data['title'] = 'Detail Akumulasi';
        $data['detail'] = $this->Akumulasi_model->tampilAkumulasi();
        $data['user'] = $this->Hris_model->ambilUser();

        $data['title'] = "Akumulasi Penilaian";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;



        }
        $data['akumulasi'] = $this->db->query("SELECT *
        FROM performances___penilaian_kuesioner 
        JOIN data_karyawan ON  performances___penilaian_kuesioner.nik_menilai = data_karyawan.nik
        JOIN data_karyawan ON  performances___penilaian_kinerja.nik = data_karyawan.nik
        WHERE performances___penilaian_kuesioner.tanggal AND performances___penilaian_kinerja.tanggal='$bulantahun'")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/detailakumulasi', $data);
        $this->load->view('templates/footer');
    }

}
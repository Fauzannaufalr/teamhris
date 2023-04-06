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
        $data['title'] = "Akumulasi Penilaian";
        $data['user'] = $this->Hris_model->ambilUser();


        // $data['penilaiankuesioner'] = $this->PenilaianKuesioner_model->tampilPenilaianKeusioner();
        // $data['penilaiankinerja'] = $this->Akumulasi_model->tampilPenilaianKinejra();

        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['akumulasi'] = $this->db->query("
            SELECT 
                dk.nik,
                dk.nama_karyawan,
                pkerja.tanggal, 
                (
                    SELECT SUM(pk.total_nilai) / 4
                    FROM performances___penilaian_kuesioner pk 
                    WHERE pk.nik_menilai = dk.nik AND pk.tanggal LIKE '%$bulantahun'
                ) AS total_nilai,
                (
                    SELECT (pkerja.nilai)
                    FROM performances___penilaian_kinerja pkerja
                    WHERE pkerja.nik = dk.nik AND pkerja.tanggal LIKE '%$bulantahun'
                ) AS nilai
            FROM data_karyawan dk
            INNER JOIN performances___penilaian_kinerja pkerja ON pkerja.nik = dk.nik
            WHERE pkerja.tanggal LIKE '%$bulantahun'
        ")->result_array();


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
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_akumulasi_admin'] = $this->Akumulasi_model->cetakAkumulasi($bulantahun);
        // printr($data['cetak_akumulasi']);
        $this->load->view('templates/header', $data);
        $this->load->view('performances/cetak_pdf_akumulasi', $data);
    }

    public function cetakExcel()
    {
        $data['title'] = "Akumulasi Karyawan";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_akumulasi_admin'] = $this->Akumulasi_model->cetakAkumulasi($bulantahun);
        // printr($data['cetak_akumulasi']);
        $this->load->view('performances/cetak_excel_akumulasi', $data);
    }




}
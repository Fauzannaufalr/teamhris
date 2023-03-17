<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanKinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('performances/LaporanKinerja_model', 'LaporanKinerja');
        $this->load->model('performances/PenilaianKinerja_model', 'Penilaian');
        $this->load->model('DataKaryawan_model', 'DataKaryawan');
        $this->load->model('Hris_model', 'Hris');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }
    public function cetakKinerja()
    {
        $data['title'] = "Penilaian Kinerja";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $tahun . $bulan;
        } else {
            $bulan = date('m', strtotime('+1 month'));
            $tahun = date('Y');
            $bulantahun = $tahun . $bulan;
        }
        $data['cetak_gaji'] = $this->LaporanGaji->cetakGaji($bulantahun);
        $this->load->view('templates/header', $data);
        $this->load->view('payroll/cetak_kinerja', $data);
    }

}
?>
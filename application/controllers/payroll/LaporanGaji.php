<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanGaji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/laporangaji_model', 'LaporanGaji');
        $this->load->model('payroll/perhitungan_model', 'Perhitungan');
        $this->load->model('DataKaryawan_model', 'DataKaryawan');
        $this->load->model('Hris_model', 'Hris');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Laporan Gaji Karyawan";
        $data['laporan'] = $this->LaporanGaji->tampilLaporan();
        $data['datakaryawan'] = $this->DataKaryawan->getAllDataKaryawan();
        $data['perhitungan'] = $this->Perhitungan->tampilPerhitungan();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/laporangaji', $data);
        $this->load->view('templates/footer');
    }

    public function generate()
    {
        $data['title'] = "Laporan Gaji Karyawan";
        $data['generate'] = $this->LaporanGaji->generate();
        $data['laporan'] = $this->LaporanGaji->tampilLaporan();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/laporangaji', $data);
        $this->load->view('templates/footer');
    }
}

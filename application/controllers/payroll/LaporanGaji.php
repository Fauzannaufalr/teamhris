<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanGaji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/laporangaji_model', 'Laporangaji');
        $this->load->model('payroll/perhitungan_model', 'Perhitungan');
        $this->load->model('DataKaryawan_model', 'Datakaryawan');
        $this->load->model('Admin_model', 'Admin');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Laporan Gaji Karyawan";
        $data['laporan'] = $this->Laporangaji->tampilLaporan();
        $data['datakaryawan'] = $this->Datakaryawan->getAllDataKaryawan();
        $data['perhitungan'] = $this->Perhitungan->tampilPerhitungan();
        $data['user'] = $this->Admin->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/laporangaji', $data);
        $this->load->view('templates/footer');
    }
}

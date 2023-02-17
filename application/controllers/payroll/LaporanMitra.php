<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanMitra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Pajak_model');
    }

    public function index()
    {
        $data['title'] = "Laporan Gaji Karyawan";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('payroll/laporanmitra', $data);
        $this->load->view('templates/footer');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanMitra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Pajak_model');
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['title'] = "Laporan Mitra";
        $data['user'] = $this->Admin_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/laporanmitra', $data);
        $this->load->view('templates/footer');
    }
}

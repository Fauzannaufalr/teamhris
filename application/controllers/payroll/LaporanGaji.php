<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanGaji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Pajak_model');
        $this->load->model('Admin_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Laporan Gaji Karyawan";
        $data['user'] = $this->Admin_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/laporangaji', $data);
        $this->load->view('templates/footer');
    }
}

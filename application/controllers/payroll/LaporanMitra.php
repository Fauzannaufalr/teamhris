<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanMitra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Pajak_model', 'Pajak');
        $this->load->model('Hris_model', 'Hris');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Laporan Mitra";
        $data['user'] = $this->Hris_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/laporanmitra', $data);
        $this->load->view('templates/footer');
    }
}

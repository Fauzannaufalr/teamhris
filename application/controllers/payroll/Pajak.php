<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pajak extends CI_Controller
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
        $data['title'] = "Pajak Karyawan";
        $data['pajakkaryawan'] = $this->Pajak_model->getAllDataPajakKaryawan();
        $data['user'] = $this->Admin_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/pajakkaryawan', $data);
        $this->load->view('templates/footer');
    }
}

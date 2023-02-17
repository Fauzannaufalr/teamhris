<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pajak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Pajak_model');
    }

    public function index()
    {
        $data['title'] = "Pajak Karyawan";
        $data['pajakkaryawan'] = $this->Pajak_model->getAllDataPajakKaryawan();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('payroll/pajakkaryawan', $data);
        $this->load->view('templates/footer');
    }
}

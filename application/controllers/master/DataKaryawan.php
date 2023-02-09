<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataKaryawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataKaryawan_model');
    }

    public function index()
    {
        $data['title'] = "Data Karyawan";
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/datakaryawan', $data);
        $this->load->view('templates/footer');
    }
}

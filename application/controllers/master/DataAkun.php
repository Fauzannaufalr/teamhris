<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataAkun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataAkun_model');
    }

    public function index()
    {
        $data['title'] = "Data Akun";
        $data['dataakun'] = $this->DataAkun_model->getAllDataAkun();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/dataakun', $data);
        $this->load->view('templates/footer');
    }
}

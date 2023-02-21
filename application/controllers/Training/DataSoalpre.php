<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSoalpre extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('soal_prettest_model');
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['title'] = "Data Soal";
        $data['pre_test'] = $this->soal_pretest_model->getAllSoal();
        $data['user'] = $this->Admin_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/pre_test', $data);
        $this->load->view('templates/footer');
    }
}

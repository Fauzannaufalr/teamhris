<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSoalpre extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('soal_prettest_model');
    }

    public function index()
    {
        $data['title'] = "Data Soal";
        $data['pre_test'] = $this->soal_pretest_model->getAllSoal();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('training/pre_test', $data);
        $this->load->view('templates/footer');
    }
}
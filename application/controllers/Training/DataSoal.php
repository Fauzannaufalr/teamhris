<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSoal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('soal_posttest_model');
    }

    public function index()
    {
        $data['title'] = "Data Soal";
        $data['post_test'] = $this->soal_posttest_model->getAllSoal();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('training/post_test', $data);
        $this->load->view('templates/footer');
    }
}
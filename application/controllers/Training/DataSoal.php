<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSoal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('soal_posttest_model');
        $this->load->model('Admin_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Soal";
        $data['post_test'] = $this->soal_posttest_model->getAllSoal();
        $data['user'] = $this->Admin_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/post_test', $data);
        $this->load->view('templates/footer');
    }
}

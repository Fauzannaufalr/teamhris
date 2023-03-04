<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akumulasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('performances/Akumulasi_model');
        $this->load->model('Hris_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Akumulasi Keseluruhan";
        $data['user'] = $this->Hris_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/akumulasi', $data);
        $this->load->view('templates/footer');
    }
}
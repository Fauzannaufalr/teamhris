<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bpjs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Performances/Akumulasi_model');
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['title'] = "Akumulasi Keseluruhan";
        $data['user'] = $this->Admin_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/akumulasi', $data);
        $this->load->view('templates/footer');
    }
}

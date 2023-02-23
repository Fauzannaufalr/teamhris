<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bpjs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('performances/MenilaiRekan2_model');
        $this->load->model('Admin_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Menilai Rekan 2";
        $data['user'] = $this->Admin_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/meniai_rekan2', $data);
        $this->load->view('templates/footer');
    }
}

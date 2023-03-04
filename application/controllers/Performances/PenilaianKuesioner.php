<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenilaianKuesioner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('performances/PenilaianKuesioner_model');
        $this->load->model('Hris_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Penilai Kuesioner";
        $data['penilaiankuesioner'] = $this->PenilaianKuesioner_model->tampilPenilaianKuesioner();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/penilaiankuesioner', $data);
        $this->load->view('templates/footer');
    }



}
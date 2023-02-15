<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SoalKuesioner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SoalKuesioner_model');

    }

    public function index()
    {
        $data['title'] = "Soal Kuesioner";
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/soalkuesioner',$data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Soal Kuesioner";
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();

        $this->form_validation->set_rules('kuesioner', 'Pertanyaan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/soalkuesioner', $data);
            $this->load->view('templates/footer');
        } else {
            $this->SoalKuesioner_model->tambahSoalKuesioner();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('master/soalkuesioner');
        }
    }

}
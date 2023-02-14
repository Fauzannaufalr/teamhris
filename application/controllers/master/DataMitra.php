<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMitra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataMitra_model');
    }

    public function index()
    {
        $data['title'] = "Data Mitra";
        $data['datamitra'] = $this->DataMitra_model->getAllDataMitra();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/datamitra', $data);
        $this->load->view('templates/footer');
    }
}

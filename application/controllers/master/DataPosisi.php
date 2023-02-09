<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPosisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataPosisi_model');

    }

    public function index()
    {
        $data['title'] = "Data Posisi";
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/dataposisi',$data);
        $this->load->view('templates/footer');
    }

}
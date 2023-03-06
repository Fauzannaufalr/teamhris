<?php
defined('BASEPATH') or exit('No direct script access allowed');



class DetailPekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('recruitment/Pekerjaan_model');
        $this->load->model('DataPosisi_model', 'posisi');


        if ($this->session->userdata('nik')) {
            redirect('admin');
        }
    }
    public function index($id)
    {
        $data['title'] = 'Detail Pekerjaan';
        $data['pekerjaan'] = $this->Pekerjaan_model->ambilUserById($id);
        $this->load->view('detailpekerjaan', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Pekerjaan';
        $data['pekerjaan'] = $this->Pekerjaan_model->ambilUserById($id);
        $data['posisi'] = $this->posisi->getAllDataPosisi();
        $this->load->view('detailpekerjaan', $data);
    }
}

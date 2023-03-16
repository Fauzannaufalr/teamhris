<?php
defined('BASEPATH') or exit('No direct script access allowed');



class DetailPekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('recruitment/Pekerjaan_model');
        $this->load->model('DataPosisi_model', 'posisi');
    }
    public function index($id)
    {
        $data['title'] = 'Detail Pekerjaan';
        $data['pekerjaan'] = $this->Pekerjaan_model->ambilUserById($id);
        $deskripsi_pekerjaan = $this->input->post('deskripsi_pekerjaan');
        $array_deskripsi = [];
        if (!is_null($deskripsi_pekerjaan)) {
            $array_deskripsi = explode("\n", $deskripsi_pekerjaan);
        }
        $data['array_deskripsi'] = $array_deskripsi;
        $this->load->view('detailpekerjaan', $data);
    }
}

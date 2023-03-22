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
        $deskripsi_pekerjaan = $this->Pekerjaan_model->deskripsi($id);
        $deskripsi_pekerjaan = $this->Pekerjaan_model->kualifikasi($id);
        $data['posisi'] = $this->posisi->getAllDataPosisi();


        $array_deskripsi = [];
        if (!is_null($deskripsi_pekerjaan)) {
            foreach ($deskripsi_pekerjaan as $dp) {
                $array_deskripsi = explode("\n", $dp);
            }
        }
        $data['array_deskripsi'] = $array_deskripsi;

        $deskripsi_pekerjaan = $this->Pekerjaan_model->kualifikasi($id);

        $array_kualifikasi = [];
        if (!is_null($deskripsi_pekerjaan)) {
            foreach ($deskripsi_pekerjaan as $dp) {
                $array_kualifikasi = explode("\n", $dp);
            }
        }
        $data['array_kualifikasi'] = $array_kualifikasi;
        $this->load->view('detailpekerjaan', $data);
    }
}

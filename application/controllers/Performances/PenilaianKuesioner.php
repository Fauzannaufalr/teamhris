<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenilaianKuesioner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PenilaianKuesioner_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Admin_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Penilai Kuesioner";
        $data['penilaiankuesioner'] = $this->PenilaianKuesioner_model->tampilPenilaianKuesioner();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawans();
        $data['user'] = $this->Admin_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/penilaiankuesioner', $data);
        $this->load->view('templates/footer');
    }

    
    public function hapus($id_penilaian_kuesioner)
    {
        if ($this->PenilaianKuesioner_model->hapus($id_penilaian_kuesioner)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('performances/penilaiankuesioner');
    }
}

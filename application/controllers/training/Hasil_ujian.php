<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil_ujian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/hasil_model');
        $this->load->model('Hris_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('training/Soal_model');
        $this->load->model('training/m_data');
        // $this->load->library('mypdf');
    }

    public function index()
    {
        $data['title'] = ' ';
        $data['user'] = $this->Hris_model->ambilUser();
        if (isset($_GET['id'])) {
            $id = $this->input->get('id');
            $data['hasil'] = $this->hasil_model->get_peserta2($id);
            $data['kelas'] = $this->m_data->get_data('Data_Posisi')->result();
        } else {
            $data['hasil'] = $this->hasil_model->get_peserta3();
            $data['kelas'] = $this->m_data->get_data('Data_Posisi')->result();
        }


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/hasil', $data);
        $this->load->view('templates/footer');
    }

    public function print_all()
    {
        $data['title'] = 'Tambah Peserta';
        $data['user'] = $this->Hris_model->ambilUser();
        if (isset($_GET['id'])) {
            $id = $this->input->get('id');
            $data['cetak'] = $this->hasil_model->get_peserta2($id);
        } else {
            $data['cetak'] = $this->hasil_model->get_peserta3();
        }
        $this->mypdf->generate('admin/v_cetak', $data, 'Cetak Hasil Ujian ujian', 'A4', 'Landscape');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/hasil', $data);
        $this->load->view('templates/footer');
    }


    public function cetak($id)
    {
        $data['title'] = 'Tambah Peserta';
        $data['user'] = $this->Hris_model->ambilUser();
        $where = array('id_peserta' => $id);
        $id = $where['id_peserta'];
        $data['cetak'] = $this->hasil_model->cetak($id);
        $this->mypdf->generate('admin/v_cetak', $data, 'Cetak Hasil Ujian ujian', 'A4', 'Landscape');
        $this->mypdf->generate('admin/v_cetak', $data, 'Cetak Hasil Ujian ujian', 'A4', 'Landscape');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/hasil', $data);
        $this->load->view('templates/footer');
    }
}

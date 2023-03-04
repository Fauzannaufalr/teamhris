<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenilaianKinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('performances/PenilaianKinerja_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Penilaian Kinerja";
        $data['penilaiankinerja'] = $this->PenilaianKinerja_model->tampilPenilaianKinerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        // printr($data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/penilaiankinerja', $data);
        $this->load->view('templates/footer');
    }

    public function import()
    {
        $this->load->view('performances/pernilaiankinerja');
    }


    public function upload()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
    }

    public function tambah()
    {

        $data['title'] = "Data Karyawan";
        $data['penilaiankinerja'] = $this->PenilaianKinerja_model->tampilPenilaianKinerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'NIK', 'required', [
            'required' => 'NIK harus diisi !',
        ]);

        $this->form_validation->set_rules('total_kerja', 'Total Kerja', 'required', [
            'required' => 'Total Kerja harus diisi !'
        ]);
        $this->form_validation->set_rules('done_kerja', 'Done Kerja', 'required', [
            'required' => 'Done Kerja harus diisi !'
        ]);



        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('performances/penilaiankinerja', $data);
            $this->load->view('templates/footer');
        } else {
            $this->PenilaianKinerja_model->tambahPenilaianKinerja();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('performances/penilaiankinerja');
        }
    }
    public function ubah()
    {

        $data['title'] = "Data Karyawan";
        $data['penilaiankinerja'] = $this->PenilaianKinerja_model->tampilPenilaianKinerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'NIK', 'required', [
            'required' => 'NIK harus diisi !',
        ]);

        $this->form_validation->set_rules('total_kerja', 'Total Kerja', 'required', [
            'required' => 'Total Kerja harus diisi !'
        ]);
        $this->form_validation->set_rules('done_kerja', 'Done Kerja', 'required', [
            'required' => 'Done Kerja harus diisi !'
        ]);


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('performances/penilaiankinerja', $data);
            $this->load->view('templates/footer');
        } else {
            $this->PenilaianKinerja_model->ubahPenilaianKinerja();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('performances/penilaiankinerja');
        }
    }


    public function hapus($id)
    {
        if ($this->PenilaianKinerja_model->hapus($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('performances/penilaiankinerja');
    }

    public function ajax_category()
    {
        $nik = $_GET["nik"];
        if (!$nik)
            return json_encode([]);
        $category = $this->db->query("SELECT
            data_posisi.nama_posisi
            FROM data_karyawan 
                INNER JOIN data_posisi ON data_posisi.id_posisi = data_karyawan.id_posisi 
                    WHERE data_karyawan.nik = '$nik'");
        print_r(json_encode($category->row()));
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class file_soal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/filesoal_model');
        $this->load->model('Hris_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('training/m_data');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Soal";
        $data['filesoal'] = $this->filesoal_model->getAllfilesoal();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['jenis_ujian'] = $this->m_data->get_data('tb_jenis_ujian');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/file_soal', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = "Data Soal";
        $data['filesoal'] = $this->filesoal_model->getAllfilesoal();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();


        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama harus diisi !',
        ]);
        $this->form_validation->set_rules('posisi', 'Posisi', 'required', [
            'required' => 'Posisi harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', [
            'required' => 'Tanggal harus diisi !'
        ]);
        $this->form_validation->set_rules('jam', ' Jam', 'required', [
            'required' => 'jam harus diisi !'
        ]);
        $this->form_validation->set_rules('jenis_ujian', 'jenis ujian', 'required', [
            'required' => 'jenis ujian harus diisi !'
        ]);
        $this->form_validation->set_rules('durasi_ujian', 'Durasi ujian', 'required', [
            'required' => 'Tanggal harus diisi !'
        ]);
        $this->form_validation->set_rules('dokumen jawaban', 'soal', 'required', [
            'required' => 'dokumen harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('training/file_soal', $data);
            $this->load->view('templates/footer');
        } else {
            $data = $this->upload_berkas();
            $dokumen = $data['file_name'];
            $this->filesoal_model->tambahfilesoal($dokumen);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('training/soal_file');
        }
    }

    public function ubah()
    {
        $data['title'] = "Data Soal";
        $data['filesoal'] = $this->filesoal_model->getAllfilesoal();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama harus diisi !',
        ]);
        $this->form_validation->set_rules('posisi', 'Posisi', 'required', [
            'required' => 'Posisi harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', [
            'required' => 'Tanggal harus diisi !'
        ]);
        $this->form_validation->set_rules('jam', ' Jam', 'required', [
            'required' => 'jam harus diisi !'
        ]);
        $this->form_validation->set_rules('jenis_ujian', 'jenis ujian', 'required', [
            'required' => 'jenis ujian harus diisi !'
        ]);
        $this->form_validation->set_rules('durasi_ujian', 'Durasi ujian', 'required', [
            'required' => 'Tanggal harus diisi !'
        ]);
        $this->form_validation->set_rules('dokumen jawaban', 'soal', 'required', [
            'required' => 'dokumen harus diisi !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('training/file_soal', $data);
            $this->load->view('templates/footer');
        } else {
            $this->filesoal_model->ubahfilesoal();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diedit!</div>');
            redirect('training/file_soal');
        }
    }
    public function download_hasil($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/uplod/' . $filename;
        if (!file_exists($file_path)) {
            redirect('training/file_soal');
        };
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        readfile($file_path);
    }
    public function upload_berkas()
    {
        $config['upload_path'] = './dist/record';
        $config['max_size'] = '4024';
        $config['allowed_types'] = 'doc|docx|pdf';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('dokumen soal')) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }
    public function hapus($id_pes)
    {
        if ($this->filesoal_model->hapus($id_pes)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('training/file_soal');
    }
}
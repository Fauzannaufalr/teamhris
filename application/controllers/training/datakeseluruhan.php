<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class datakeseluruhan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('training/datakeseluruhan_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Keseluruhan";
        $data['datakeseluruhan'] = $this->datakeseluruhan_model->getAlldatakeseluruhan();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('training/data_keseluruhan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = "Data Keseluruhan";
        $data['datakeseluruhan'] = $this->datakeseluruhan_model->getAlldatakeseluruhan();
        $data['user'] = $this->Hris_model->ambilUser();


        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama harus diisi !',
        ]);
        $this->form_validation->set_rules('kategori', 'kategori', 'required', [
            'required' => 'Nama harus diisi !'
        ]);
        $this->form_validation->set_rules('ulasan', 'Ulasan', 'required', [
            'required' => 'Ulasan harus diisi !'
        ]);
        $this->form_validation->set_rules('dokumen', 'Dokumen', 'required', [
            'required' => 'Dokumen harus diisi !'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('training/data_keseluruhan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->datakeseluruhan_model->tambahdatakeseluruhan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('training/datakeseluruhan');
        }
    }

    public function ubah()
    {
        $data['title'] = "Data Keseluruhan";
        $data['datakeseluruhan'] = $this->datakeseluruhan_model->getAlldatakeseluruhan();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama harus diisi !'
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'kategori harus diisi !'
        ]);
        $this->form_validation->set_rules('ulasan', 'Ulasan', 'required', [
            'required' => 'Ulasan harus diisi !'
        ]);
        $this->form_validation->set_rules('file', 'Dokumen', 'required', [
            'required' => 'Dokumen harus diisi !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('training/data_keseluruhan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->datakeseluruhan_model->ubahdatakeseluruhan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diedit!</div>');
            redirect('training/datakeseluruhan');
        }
    }
    public function download_file($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/record/' . $filename;
        if (!file_exists($file_path)) {
            redirect('training/datakeseluruhan');
        };
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        readfile($file_path);
    }
    public function upload_hasiltes()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/record';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048; // dalam kilobita

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('uploadfile')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'id_keseluruhan' => $this->input->post('id'),
                'nama' => $this->input->post('nama'),
                'kategori' => $this->input->post('kategori'),
                'ulasan' => $this->input->post('ulasan'),
                'file' => $filename,
            ];

            // Tampilkan pesan berhasil
            $this->db->insert('data_keseluruhan', $data);
            $this->session->set_flashdata('success', 'Berhasil Upload Data.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('training/data_keseluruhan');
    }



    public function hapus($id_keseluruhan)
    {
        if ($this->datakeseluruhan_model->hapus($id_keseluruhan)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('training/data_keseluruhan');
    }
}

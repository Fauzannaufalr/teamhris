<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolahasilPre extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kelolapretest_model');
        $this->load->model('Admin_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Jawaban Pre_Test";
        $data['hasilpretest'] = $this->Kelolapretest_model->getAllHasilPretest();
        $data['user'] = $this->Admin_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('Training/Hasil_pretest', $data);
        $this->load->view('templates/footer');
    }
    public function hapus($id_hasilpre)
    {
        if ($this->kelolapretest_model->hapus($id_hasilpre)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('Training/Hasil_pretest'); //ke view training
    }

    public function tambah($id_hasilpretest)
    { {
            $this->db->insert("nama_tabel", $data);
        }
    }
}

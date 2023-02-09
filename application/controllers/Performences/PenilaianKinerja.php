<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenilaianKinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PenilaianKinerja_model');
    }

    public function index()
    {
        $data['title'] = "Penilaian Kinerja";
        $data['penilaiankinerja'] = $this->PenilaianKinerja_model->getAllPenilaianKinerja();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('performences/penilaiankinerja', $data);
        $this->load->view('templates/footer');
    }
    public function hapus($id_penilaian_kinerja)
    {
        if ($this->PenilaianKinerja_model->hapus($id_penilaian_kinerja)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('performences/penilaiankinerja'); //ke view performences
    }

    public function tambah($id_penilaian_kinerja)
    {
        {
         $this->db->insert("nama_tabel", $data);
        } 
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengajuanRateMitra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Pajak_model', 'Pajak');
        $this->load->model('payroll/PengajuanRateMitra_model', 'RateMitra');
        $this->load->model('Hris_model', 'Hris');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Pengajuan Rate Mitra";
        $data['ratemitra'] = $this->RateMitra->tampilRate();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/pengajuan_rate_mitra', $data);
        $this->load->view('templates/footer');
    }

    public function generate()
    {
        $data['title'] = "Pengajuan Rate Mitra";
        $data['generate'] = $this->RateMitra->generate();
        $data['ratemitra'] = $this->RateMitra->tampilRate();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/pengajuan_rate_mitra', $data);
        $this->load->view('templates/footer');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Generate data berhasil!</div>');
        redirect('payroll/pengajuanratemitra');
    }

    public function status($id)
    {
        $this->RateMitra->statusBayar($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Status bayar berhasil diubah!</div>');
        redirect('payroll/pengajuanratemitra');
    }
}

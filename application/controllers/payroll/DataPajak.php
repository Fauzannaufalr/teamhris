<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPajak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/DataPajak_model');
    }

    public function index()
    {
        $data['title'] = "Data Pajak";
        $data['datapajak'] = $this->DataPajak_model->getAllDataPajak();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('payroll/datapajak', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Data Mitra";
        $data['datamitra'] = $this->DataMitra_model->getAllDataMitra();

        $this->form_validation->set_rules('nik', 'NIK', 'required', [
            'required' => 'NIK harus diisi !'
        ]);
        $this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required', [
            'required' => 'Nama Perusahaan harus diisi !'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required', [
            'required' => 'Nama Karyawan harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/datapajak', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataMitra_model->tambahDataMitra();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('master/datamitra');
        }
    }
}

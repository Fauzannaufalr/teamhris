<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPajak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/DataPajak_model');
        $this->load->model('Admin_model');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Pajak";
        $data['datapajak'] = $this->DataPajak_model->tampilDataPajak();
        $data['user'] = $this->Admin_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/datapajak', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Data Pajak";
        $data['datapajak'] = $this->DataPajak_model->tampilDataPajak();
        $data['user'] = $this->Admin_model->ambilUser();

        $this->form_validation->set_rules('golongan', 'Golongan', 'required', [
            'required' => 'Golongan harus diisi !'
        ]);
        $this->form_validation->set_rules('kode', 'Kode', 'required', [
            'required' => 'Kode harus diisi !'
        ]);
        $this->form_validation->set_rules('tarif', 'Tarif', 'required', [
            'required' => 'Tarif harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/datapajak', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataPajak_model->tambahDataPajak();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('payroll/datapajak');
        }
    }
}

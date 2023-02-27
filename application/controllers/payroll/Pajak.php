<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pajak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Pajak_model');
        $this->load->model('Admin_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('payroll/DataPajak_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Pajak Karyawan";
        $data['pajakkaryawan'] = $this->Pajak_model->tampilPajakKaryawan();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['datapajak'] = $this->DataPajak_model->tampilDataPajak();
        $data['user'] = $this->Admin_model->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/pajakkaryawan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Pajak Karyawan";
        $data['pajakkaryawan'] = $this->Pajak_model->tampilPajakKaryawan();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['datapajak'] = $this->DataPajak_model->tampilDataPajak();
        $data['user'] = $this->Admin_model->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'nik_nama', 'required', [
            'required' => 'NIK & Nama Karyawan harus diisi !'
        ]);
        $this->form_validation->set_rules('golongan_kode', 'Golongan', 'required', [
            'required' => 'Golongan & Kode harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/pajakkaryawan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pajak_model->tambahPajakKaryawan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('payroll/pajak');
        }
    }

    public function ubah()
    {
        $data['title'] = "Pajak Karyawan";
        $data['pajakkaryawan'] = $this->Pajak_model->tampilPajakKaryawan();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['datapajak'] = $this->DataPajak_model->tampilDataPajak();
        $data['user'] = $this->Admin_model->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'nik_nama', 'required', [
            'required' => 'NIK & Nama Karyawan harus diisi !'
        ]);
        $this->form_validation->set_rules('golongan_kode', 'Golongan', 'required', [
            'required' => 'Golongan & Kode harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/pajakkaryawan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pajak_model->ubahPajakKaryawan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diubah!</div>');
            redirect('payroll/pajak');
        }
    }

    public function hapus($id)
    {
        if ($this->Pajak_model->hapus($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('payroll/pajak');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/Perhitungan_model', 'Perhitungan');
        $this->load->model('Admin_model', 'Admin');
        $this->load->model('DataKaryawan_model', 'Datakaryawan');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Perhitungan Gaji Karyawan";
        $data['perhitungan'] = $this->Perhitungan->tampilPerhitungan();
        $data['datakaryawan'] = $this->Datakaryawan->getAllDataKaryawan();
        $data['user'] = $this->Admin->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/perhitungangaji', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = "Perhitungan Gaji Karyawan";
        $data['perhitungan'] = $this->Perhitungan->tampilPerhitungan();
        $data['datakaryawan'] = $this->Datakaryawan->getAllDataKaryawan();
        $data['user'] = $this->Admin->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'nik_nama', 'required', [
            'required' => 'NIK & Nama Karyawan harus diisi !'
        ]);
        $this->form_validation->set_rules('tunjangan', 'tunjangan', 'required|numeric', [
            'required' => 'Tunjangan harus diisi !',
            'numeric' => 'Potongan harus angka'
        ]);
        $this->form_validation->set_rules('potongan', 'potongan', 'required|numeric', [
            'required' => 'Potongan harus diisi !',
            'numeric' => 'Potongan harus angka'
        ]);
        $this->form_validation->set_rules('bonus', 'bonus', 'numeric', [
            'numeric' => 'Bonus harus angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/perhitungangaji', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Perhitungan->tambahPerhitungan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('payroll/perhitungan');
        }
    }

    public function ubah()
    {
        $data['title'] = "Perhitungan Gaji Karyawan";
        $data['perhitungan'] = $this->Perhitungan->tampilPerhitungan();
        $data['datakaryawan'] = $this->Datakaryawan->getAllDataKaryawan();
        $data['user'] = $this->Admin->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'nik_nama', 'required', [
            'required' => 'NIK & Nama Karyawan harus diisi !'
        ]);
        $this->form_validation->set_rules('tunjangan', 'tunjangan', 'required|numeric', [
            'required' => 'Tunjangan harus diisi !',
            'numeric' => 'Potongan harus angka'
        ]);
        $this->form_validation->set_rules('potongan', 'potongan', 'required|numeric', [
            'required' => 'Potongan harus diisi !',
            'numeric' => 'Potongan harus angka'
        ]);
        $this->form_validation->set_rules('bonus', 'bonus', 'numeric', [
            'numeric' => 'Bonus harus angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('payroll/perhitungangaji', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Perhitungan->ubahPerhitungan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diubah!</div>');
            redirect('payroll/perhitungan');
        }
    }

    public function hapus($id)
    {
        if ($this->Perhitungan->hapus($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('payroll/perhitungan');
    }
}

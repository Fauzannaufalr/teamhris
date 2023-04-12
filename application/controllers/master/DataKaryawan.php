<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class DataKaryawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataKaryawan_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');
        $this->load->model('training/m_data');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Data Karyawan";
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['id_kelas'] = $this->m_data->get_data('tb_kelas')->result_array();
        $data['type'] = ['Office', 'Project Base'];
        $data['level'] = ['hc', 'biasa', 'leader', 'ceo'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/datakaryawan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = "Data Karyawan";
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['id_kelas'] = $this->m_data->get_data('tb_kelas')->result_array();
        $data['type'] = ['Office', 'Project Base'];
        $data['level'] = ['hc', 'biasa', 'leader', 'ceo'];

        $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[data_karyawan.nik]', [
            'required' => 'NIK harus diisi !',
            'is_unique' => 'NIK Sudah Terdaftar !'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required', [
            'required' => 'Nama harus diisi !'
        ]);
        $this->form_validation->set_rules('posisi', 'Posisi', 'required', [
            'required' => 'Posisi harus diisi !'
        ]);
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required', [
            'required' => 'Kelas harus diisi !'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email harus diisi !',
            'valid_email' => 'Yang Anda Masukan Bukan Email !'
        ]);
        $this->form_validation->set_rules('gajipokok', 'Gaji pokok', 'numeric', [
            'numeric' => 'Gaji Pokok harus diisi dengan angka !'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password harus diisi !'
        ]);
        $this->form_validation->set_rules('level', 'Level', 'required', [
            'required' => 'Level harus diisi !'
        ]);
        $this->form_validation->set_rules('telepon', 'Telepon', 'numeric', [
            'numeric' => 'Telepon harus diisi dengan angka !'
        ]);
        $this->form_validation->set_rules('type', 'type', 'required', [
            'required' => 'Type harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/datakaryawan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataKaryawan_model->tambahDataKaryawan();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
            redirect('master/datakaryawan');
        }
    }

    public function ubah()
    {
        $data['title'] = "Data Karyawan";
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();
        $data['id_kelas'] = $this->m_data->get_data('tb_kelas')->result_array();
        $data['type'] = ['Office', 'Project Base'];
        $data['level'] = ['hc', 'biasa', 'leader', 'ceo'];

        $this->form_validation->set_rules('nik', 'NIK', 'required', [
            'required' => 'NIK harus diisi !'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required', [
            'required' => 'Nama harus diisi !'
        ]);
        $this->form_validation->set_rules('posisi', 'Posisi', 'required', [
            'required' => 'Posisi harus diisi !'
        ]);
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required', [
            'required' => 'Kelas harus diisi !'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email harus diisi !',
            'valid_email' => 'Yang Anda Masukan Bukan Email !'
        ]);
        $this->form_validation->set_rules('gajipokok', 'Gaji pokok', 'numeric', [
            'numeric' => 'Gaji Pokok harus diisi dengan angka !'
        ]);
        $this->form_validation->set_rules('level', 'Level', 'required', [
            'required' => 'Level harus diisi !'
        ]);
        $this->form_validation->set_rules('telepon', 'Telepon', 'numeric', [
            'numeric' => 'Telepon harus diisi dengan angka !'
        ]);
        $this->form_validation->set_rules('type', 'type', 'required', [
            'required' => 'Type harus diisi !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/datakaryawan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataKaryawan_model->ubahDataKaryawan();
            $this->session->set_flashdata('message', 'Data berhasil diedit!');
            redirect('master/datakaryawan');
        }
    }


    public function hapus($id_karyawan)
    {
        if ($this->DataKaryawan_model->hapus($id_karyawan)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('master/datakaryawan');
    }


}
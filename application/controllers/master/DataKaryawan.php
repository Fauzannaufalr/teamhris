<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataKaryawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataKaryawan_model');
        $this->load->model('DataPosisi_model');
    }

    public function index()
    {
        $data['title'] = "Data Karyawan";
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/datakaryawan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = "Data Karyawan";
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('posisi', 'Posisi', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('gajipokok', 'Gaji pokok', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('foto', 'Foto', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('master/datakaryawan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->DataKaryawan_model->tambahDataKaryawan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('master/datakaryawan');
        }
    }

    public function edit()
    {
        $data['title'] = "Data Karyawan";
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('master/datakaryawan', $data);
        $this->load->view('templates/footer');
    }


    public function hapus($id_karyawan)
    {
        if ($this->DataKaryawan_model->hapus($id_karyawan)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('master/datakaryawan');
    }

    public function ubahpassword()
    {
        $data['title'] = "Ubah Password";
        $data['datakaryawan'] = $this->db->get_where('data_karyawan', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[3]matches[password_baru2]');
        $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password Baru', 'required|trim|min_length[3]|matches[password_baru1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/ubahpassword', $data);
            $this->load->view('templates/footer');
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru1');
            if (!password_verify($password_lama, $data['datakaryawan']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Password Lama Salah!</div>');
                redirect('admin/ubahpassword');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Password Baru Tidak Boleh Sama Dengan Password Sebelumnya!</div>');
                    redirect('admin/ubahpassword');
                } else
                    ///paswword ok
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);


                $this->db->set('password', $password_hash);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('datakaryawan');

                $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Berhasil Ubah Password!</div>');
                redirect('admin/ubahpassword');
            }
        }
    }
}

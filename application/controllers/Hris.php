<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hris extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hris_model');
        $this->load->model('DataPosisi_model', 'DataPosisi');
        $this->load->model('payroll/pengajuangaji_model', 'PengajuanGaji');
        $this->load->model('payroll/pengajuanratemitra_model', 'RateMitra');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $periode = isset($_GET["periode"]) ? $_GET["periode"] : 0;
        $tahun = isset($_GET["tahun"]) ? $_GET["tahun"] : 0;
        $bulantahun = date("Y") . date("m", strtotime('+1 month'));
        $data['title'] = "Dashboard";
        $data['user'] = $this->Hris_model->ambilUser();
        // $data['laporan_gk'] = $this->PengajuanGaji->laporan();
        // $data['laporan_rm'] = $this->RateMitra->laporan();
        $data['bariskaryawan'] = $this->db->get('data_karyawan')->num_rows();
        $data['barisposisi'] = $this->db->get('data_posisi')->num_rows();
        $data['barismitra'] = $this->db->get('data_mitra')->num_rows();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('hris/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['dataposisi'] = $this->DataPosisi->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('hris/profile', $data);
        $this->load->view('templates/footer');
    }

    public function ubahPassword()
    {
        $data['title'] = "Ubah Password";
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('password_lama', 'Password lama', 'required|trim', [
            'required' => 'Password lama harus diisi'
        ]);
        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[3]|matches[password_baru2]', [
            'required' => 'Password lama harus diisi',
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password', 'required|trim|matches[password_baru1]', [
            'required' => 'Password lama harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('hris/ubahpassword', $data);
            $this->load->view('templates/footer');
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru1');

            if (!password_verify($password_lama, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah!</div>');
                redirect('hris/ubahpassword');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password baru tidak boleh dengan password lama!</div>');
                    redirect('hris/ubahpassword');
                } else {
                    // jika password sudah ok
                    $this->Hris_model->ubahPassword($password_baru);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password berhasil diubah!</div>');
                    redirect('hris/ubahpassword');
                }
            }
        }
    }

    public function ubahProfile()
    {
        $data['title'] = 'Ubah Profile';
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('nama', 'Full name', 'required|trim');
        $this->form_validation->set_rules('email', 'Full name', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Full name', 'required|trim');
        $this->form_validation->set_rules('telepon', 'Full name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('hris/ubahprofile', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Hris_model->ubahProfile($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Profile anda berhasil diubah!</div>');
            redirect('hris/profile');
        }
    }
}

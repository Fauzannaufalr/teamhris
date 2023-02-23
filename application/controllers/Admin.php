<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $periode = isset($_GET["periode"]) ? $_GET["periode"] : 0;
        $tahun = isset($_GET["tahun"]) ? $_GET["tahun"] : 0;
        $data['title'] = "Dashboard";
        $data['user'] = $this->Admin_model->ambilUser();
        $data['bariskaryawan'] = $this->db->get('data_karyawan')->num_rows();
        $data['barisposisi'] = $this->db->get('data_posisi')->num_rows();
        $data['barismitra'] = $this->db->get('data_mitra')->num_rows();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->Admin_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/footer');
    }

    public function ubahPassword()
    {
        $data['title'] = "Ubah Password";
        $data['user'] = $this->Admin_model->ambilUser();

        $this->form_validation->set_rules('password_lama', 'Password lama', 'required|trim');
        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[3]|matches[password_baru2]', [
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password', 'required|trim|matches[password_baru1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/ubahpassword', $data);
            $this->load->view('templates/footer');
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru1');

            if (!password_verify($password_lama, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah!</div>');
                redirect('admin/ubahpassword');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password baru tidak boleh dengan password lama!</div>');
                    redirect('admin/ubahpassword');
                } else {
                    // jika password sudah ok
                    $this->Admin_model->ubahPassword($password_baru);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password berhasil diubah!</div>');
                    redirect('admin/ubahpassword');
                }
            }
        }
    }

    public function ubahProfile()
    {
        $data['title'] = 'Ubah Profile';
        $data['user'] = $this->Admin_model->ambilUser();

        $this->form_validation->set_rules('nama', 'Full name', 'required|trim');
        $this->form_validation->set_rules('email', 'Full name', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Full name', 'required|trim');
        $this->form_validation->set_rules('telepon', 'Full name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/ubahprofile', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->ubahProfile($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Profile anda berhasil diubah!</div>');
            redirect('admin/profile');
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }


    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username harus diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password harus diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->ambilUser($username);

        // jika usernya ada
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                unset($user['password']);
                $this->session->set_userdata($user); // ini disession agar data nya terambil global
                redirect('admin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="text-align: center;"> Salah Password! </div>');
                redirect('auth'); 
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="text-align: center;"> User tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="text-align: center;"> Anda berhasil logout!</div>');
        redirect('auth');
    }

    public function lupaPassword()
    {
        $data['title'] = 'Lupa Password';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/lupapassword');
        $this->load->view('templates/auth_footer');
    }
}

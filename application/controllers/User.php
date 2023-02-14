<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('user/dashboard');
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = "Profile";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('user/profile');
        $this->load->view('templates/footer');
    }

    public function ubahPassword()
    {
        $data['title'] = "Ubah Password";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('user/ubahpassword');
        $this->load->view('templates/footer');
    }
}

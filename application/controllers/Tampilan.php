<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Tampilan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('recruitment/Pekerjaan_model');


        if ($this->session->userdata('nik')) {
            redirect('dashboard');
        }
    }
    public function index()
    {
        $data['title'] = 'Tampilan';
        $data['pekerjaan'] = $this->Pekerjaan_model->tampilPekerjaan();
        $this->load->view('tampilan', $data);
    }
}

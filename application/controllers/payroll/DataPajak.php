<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPajak extends CI_Controller
{

    public function index()
    {
        $data['title'] = "Data Pajak";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('payroll/datapajak');
        $this->load->view('templates/footer');
    }
}

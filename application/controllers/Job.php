<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Job';

        $this->load->view('job');
    }
}

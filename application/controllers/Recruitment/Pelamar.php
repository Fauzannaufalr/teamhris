<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/Pelamar_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');
        $this->load->helper(array('url', 'download'));

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Data Pelamar";
        $data['pelamar'] = $this->Pelamar_model->getAllPelamar();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('recruitment/pelamar', $data);
        $this->load->view('templates/footer');
    }





    public function hapus($id_pelamar)
    {
        if ($this->Pelamar_model->hapus($id_pelamar)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('recruitment/pelamar');
    }


    private function _kirimEmail()
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'belajarcoding78@gmail.com',
            'smtp_pass' => 'jeudcmhfxmcuwllq',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'wordwrap'  => TRUE
        ];


        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('belajarcoding78@gmail.com', 'PT. Sahaware Teknologi Indonesia');
        $this->email->to($this->input->post('email'));
        $data = [
            'gmeet' => $this->input->post('gmeet'),
            'tanggal' => $this->input->post('tanggal'),
            'bertemu' => $this->input->post('bertemu'),

        ];
        $card = $this->load->view('email_card', $data, TRUE);

        $this->email->subject('Undangan Interview');
        $this->email->message($card);

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function interview()
    {
        $this->form_validation->set_rules('gmeet', 'Gmeet', 'required', [
            'required' => 'Link Gmeet harus diisi !',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Pelamar";
            $data['pelamar'] = $this->Pelamar_model->getAllPelamar();
            $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
            $data['user'] = $this->Hris_model->ambilUser();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('recruitment/pelamar', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email');
            $this->_kirimEmail();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diKirim!</div>');
            redirect('recruitment/pelamar');
        }
    }
}

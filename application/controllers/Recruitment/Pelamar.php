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
        $this->load->helper('url', 'download');


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
    private function _kirimSoal()
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
            'id_posisi' => $this->input->post('posisi'),
            'pg' => $this->input->post('pg'),
            'essay' => $this->input->post('essay'),
            'upload' => $this->input->post('upload'),
            'dataposisi' => $this->DataPosisi_model->getAllDataPosisi()

        ];
        $card = $this->load->view('email_soal', $data, TRUE);

        $this->email->subject('Soal Tes Recruitment');
        $this->email->message($card);

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function interview($id)
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
            $this->Pelamar_model->statuspelamar($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diKirim!</div>');
            redirect('recruitment/pelamar');
        }
    }
    public function soal($id)
    {
        $this->form_validation->set_rules('posisi', 'Posisi', 'required', [
            'required' => 'Posisi harus diisi !'
        ]);
        $this->form_validation->set_rules('pg', 'Link Soal PG', 'required', [
            'required' => 'Link Soal PG harus diisi !',
        ]);

        $this->form_validation->set_rules('upload', 'Link Upload Jawaban', 'required', [
            'required' => 'Link Upload Jawaban harus diisi !',
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
            $this->_kirimSoal();
            $this->Pelamar_model->statuspelamar($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil diKirim!</div>');
            redirect('recruitment/pelamar');
        }
    }
    public function upload_file()
    {
        $config['upload_path'] = './dist/uploads';
        $config['max_size'] = '4024';
        $config['allowed_types'] = 'doc|docx|pdf';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('essay')) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }

    public function download_file($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/cv/' . $filename;
        if (!file_exists($file_path)) {
            redirect('recruitment/pelamar');
        };
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        readfile($file_path);
    }
}

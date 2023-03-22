<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Tampilan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('recruitment/Pekerjaan_model');
    }
    public function index()
    {
        $data['title'] = 'Tampilan';
        $data['pekerjaan'] = $this->Pekerjaan_model->tampilPekerjaan();
        $this->load->view('tampilan', $data);
    }

    public function upload_cv()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/cv';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048; // dalam kilobita

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('cv')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'file_cv' => $filename,
                'email' => $this->input->post('email'),
                'status' => 'pelamar',
                'id_pekerjaan' => $this->input->post('id_posisi')
            ];

            $this->db->insert('recruitment___pelamar', $data);
            // Tampilkan pesan berhasil
            $this->session->set_flashdata('success', 'CV berhasil diupload.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('tampilan');
    }
    public function tambah()
    {

        $data['title'] = "Pelamar";
        $data['pekerjaan'] = $this->Pekerjaan_model->tampilPekerjaan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('posisi', 'Posisi Pekerjaan', 'required',);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email harus diisi !',
            'valid_email' => 'Yang Anda Masukan Bukan Email !'
        ]);
        $this->form_validation->set_rules('cv', 'File CV', 'required', [
            'required' => 'Upload CV !'
        ]);



        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('tampilan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pekerjaan_model->tambahPekerjaan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('tampilan');
        }
    }
}

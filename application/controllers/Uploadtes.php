<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Uploadtes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/uploadtes_model');
        $this->load->model('DataPosisi_model');
    }
    public function index()
    {
        $data['title'] = 'Upload Hasil Tes';
        $data['hasiltes'] = $this->uploadtes_model->getAllhasiltes();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $this->load->view('uploadtespelamar', $data);
    }

    public function upload_hasiltes()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/uploads';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048; // dalam kilobita

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('uploadfile')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'id_pekerjaan' => $this->input->post('posisi'),
                'email' => $this->input->post('email'),
                'hasil_link' => $this->input->post('uploadlink'),
                'hasil_file' => $filename,
            ];

            // Tampilkan pesan berhasil
            $this->db->insert('recruitment___hasiltes', $data);
            $this->session->set_flashdata('success', 'Jawaban berhasil diupload.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('uploadtes');
    }
    public function tambah()
    {

        $data['title'] = "Upload Hasil Tes";
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Admin_model->ambilUser();

        $this->form_validation->set_rules('posisi', 'Posisi Pekerjaan', 'required',);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email harus diisi !',
            'valid_email' => 'Yang Anda Masukan Bukan Email !'
        ]);
        $this->form_validation->set_rules('uploadtes', 'Upload Hasil Tes', 'required', [
            'required' => 'Upload Hasil Tes !'
        ]);



        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('uploadtespelamar', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pekerjaan_model->tambahuploadtes();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('tampilan');
        }
    }
}

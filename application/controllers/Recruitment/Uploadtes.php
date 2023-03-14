<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Uploadtes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('recruitment/Hasiltes_model');
    }
    public function index()
    {
        $data['title'] = 'Upload Hasil Tes';
        $data['hasiltes'] = $this->Hasiltes_model->getAllHasiltes();
        $this->load->view('recruitment/uploadtes', $data);
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
        if ($this->upload->do_upload('uploadtes')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data();
            $data = [
                'hasil_pengerjaan' => $filename['uploadtes'],
                'email' => $this->input->post('email'),
                'status' => 'beri nilai',
                'id_pekerjaan' => $this->input->post('id_posisi')
            ];

            // Tampilkan pesan berhasil
            $this->session->set_flashdata('success', 'Jawaban berhasil diupload.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        $this->db->insert('recruitment___hasiltes', $data);
        redirect('recruitment/uploads');
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
            $this->load->view('recruitment/uploadtes', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pekerjaan_model->tambahuploadtes();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan!</div>');
            redirect('tampilan');
        }
    }
}

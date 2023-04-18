<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('recruitment/Pekerjaan_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Pekerjaan";
        $data['pekerjaan'] = $this->Pekerjaan_model->tampilPekerjaan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('recruitment/Pekerjaan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $data['title'] = "Pekerjaan";
        $data['pekerjaan'] = $this->Pekerjaan_model->tampilPekerjaan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();
        $deskripsi_pekerjaan = $this->input->post('deskripsi_pekerjaan');
        $kualifikasi = $this->input->post('kualifikasi');
        $array_deskripsi = [];
        if (!is_null($deskripsi_pekerjaan)) {
            $array_deskripsi = explode("\n", $deskripsi_pekerjaan);
        }
        $data['array_deskripsi'] = $array_deskripsi;

        $array_kualifikasi = [];
        if (!is_null($kualifikasi)) {
            $array_kualifikasi = explode("\n", $kualifikasi);
        }
        $data['array_kualifikasi'] = $array_kualifikasi;
        $this->form_validation->set_rules('posisi', 'Posisi Pekerjaan', 'required', [
            'required' => 'Nama harus diisi !'
        ]);
        $this->form_validation->set_rules('deskripsi_pekerjaan', 'Deskripsi', 'required', [
            'required' => 'Deskripsi harus diisi !'
        ]);
        $this->form_validation->set_rules('kualifikasi', 'Kualifikasi', 'required', [
            'required' => 'Kualifikasi harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal_berakhir', 'Tanggal Berakhir', 'required', [
            'required' => 'Tanggal Berakhir harus diisi !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('recruitment/pekerjaan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pekerjaan_model->tambahPekerjaan();
            $this->session->set_flashdata('message', 'Data berhasil ditambahkan');
            redirect('recruitment/Pekerjaan');
        }
    }


    public function tambah_pekerjaan()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/img/lowongan/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $congig['max_size'] = '3000';
        $config['file_name'] = 'pro' . time();

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('foto')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'id_posisi' => htmlspecialchars($this->input->post('posisi')),
                'deskripsi_pekerjaan' => htmlspecialchars($this->input->post('deskripsi_pekerjaan')),
                'kualifikasi' => htmlspecialchars($this->input->post('kualifikasi')),
                'tanggal_berakhir' => htmlspecialchars($this->input->post('tanggal_berakhir')),
                'foto' => $filename,
            ];

            $this->db->insert('recruitment___pekerjaan', $data);
            // Tampilkan pesan berhasil
            $this->session->set_flashdata('message', 'Data Berhasil Ditambah.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('recruitment/Pekerjaan');
    }




    public function ubah_pekerjaan()
    {
        // Load library untuk upload file
        $this->load->library('upload');

        // Konfigurasi upload file
        $config['upload_path'] = './dist/img/lowongan/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $congig['max_size'] = '3000';
        $config['file_name'] = 'pro' . time();

        $this->upload->initialize($config);

        // Lakukan upload file
        if ($this->upload->do_upload('foto')) {
            // Jika upload berhasil, simpan nama file ke database
            $filename = $this->upload->data('file_name');
            $data = [
                'id_posisi' => htmlspecialchars($this->input->post('posisi')),
                'deskripsi_pekerjaan' => htmlspecialchars($this->input->post('deskripsi_pekerjaan')),
                'kualifikasi' => htmlspecialchars($this->input->post('kualifikasi')),
                'tanggal_berakhir' => htmlspecialchars($this->input->post('tanggal_berakhir')),
                'foto' => $filename,
            ];

            $this->db->where('id_pekerjaan', $this->input->post('id_pekerjaan'));
            $this->db->update('recruitment___pekerjaan', $data);
            // Tampilkan pesan berhasil
            $this->session->set_flashdata('message', 'Data Berhasil Ditambah.');
        } else {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect kembali ke halaman profil
        redirect('recruitment/Pekerjaan');
    }

    public function ubah()
    {
        $data['title'] = "Pekerjaan";
        $data['pekerjaan'] = $this->Pekerjaan_model->tampilPekerjaan();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('deskripsi_pekerjaan', 'Deskripsi', 'required', [
            'required' => 'Deskripsi harus diisi !'
        ]);
        $this->form_validation->set_rules('kualifikasi', 'Kualifikasi', 'required', [
            'required' => 'Kualifikasi harus diisi !'
        ]);
        $this->form_validation->set_rules('tanggal_berakhir', 'Tanggal Berakhir', 'required', [
            'required' => 'Tanggal Berakhir harus diisi !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('recruitment/Pekerjaan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pekerjaan_model->ubahPekerjaan();
            $this->session->set_flashdata('message', 'Data berhasil diubah');
            redirect('recruitment/Pekerjaan');
        }
    }

    public function hapus($id_pekerjaan)
    {
        if ($this->Pekerjaan_model->hapus($id_pekerjaan)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('recruitment/Pekerjaan');
    }
}

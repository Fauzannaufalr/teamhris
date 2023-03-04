<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenilaiRekan1 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('performances/MenilaiRekan1_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('SoalKuesioner_model');
        $this->load->model('Hris_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Menilai Rekan1";
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();

        // 2.menilai 
        // menampilkan data karyawan yang nik nya bukan dari login

        // 3.simpan kuesioner (diri sendiri, rekan1 , rekan 2)
        // dimasukan ke tabel 'performances___penilaian_kuesioner' & 'performances___detail_penilaian_kuesioner	' (pake perulangan)
        // * <input type='text'name='nilai_kue[]' />
        // $_POST['nilai_kue']
        // [
        //     'nilai_kue' => [
        //         0 => 5,
        //         1 => 3,
        //         2 => 2,
        //     ]
        // ]
        // $teamhris = [
        //     "application" => [
        //         "cache" => [
        //             0 => "ïndex.html"
        //         ],
        //         "config" => [
        //             0 => "autoload.php",
        //             1 => "config.php",
        //             2 => "constant.php",
        //             // ,..
        //         ]
        //     ]
        // ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/menilairekan1', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        // ambil data dari form
        $pertanyaan1 = $this->input->post('pertanyaan1');
        $jawaban1 = $this->input->post('jawaban1');
        $pertanyaan2 = $this->input->post('pertanyaan2');
        $jawaban2 = $this->input->post('jawaban2');
        $pertanyaan3 = $this->input->post('pertanyaan3');
        $jawaban3 = $this->input->post('jawaban3');
        $pertanyaan4 = $this->input->post('pertanyaan4');
        $jawaban4 = $this->input->post('jawaban4');
        $pertanyaan5 = $this->input->post('pertanyaan5');
        $jawaban5 = $this->input->post('jawaban5');
        $pertanyaan6 = $this->input->post('pertanyaan6');
        $jawaban6 = $this->input->post('jawaban6');
        $pertanyaan7 = $this->input->post('pertanyaan7');
        $jawaban7 = $this->input->post('jawaban7');
        $pertanyaan8 = $this->input->post('pertanyaan8');
        $jawaban8 = $this->input->post('jawaban8');
        $pertanyaan9 = $this->input->post('pertanyaan9');
        $jawaban9 = $this->input->post('jawaban9');
        $pertanyaan10 = $this->input->post('pertanyaan10');
        $jawaban9 = $this->input->post('jawaban10');

    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenilaiLeader extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('performances/MenilaiLeader_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('Admin_model');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Menilai Leader";
        $data['user'] = $this->Admin_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        // 1.combobox pilih penilai
        // printr($this->session->userdata('nama_karyawan'));

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
        $this->load->view('performances/menilaileader', $data);
        $this->load->view('templates/footer');
    }
}

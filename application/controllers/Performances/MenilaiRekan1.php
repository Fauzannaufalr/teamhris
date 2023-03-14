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
        $nik = $this->session->userdata("nik");
        $data['title'] = "Menilai Rekan1";
        $data['user'] = $this->Hris_model->ambilUser();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getDataKaryawanExcept($nik);
        $data['soalkuesioner'] = $this->SoalKuesioner_model->getAllSoalKuesioner();
        // printr($da   ta);
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
        $nilai = $this->input->post("nilai");
        $id_penilaian_keusioner = count($id_penilaian_keusioner);
        $nik_penilai = count($nik_penilai);
        $nik_menilai = array_sum($nik_menilai);
        $total_soal = count($nilai);
        $total_nilai = count($nilai);
        $tanggal = count($tanggal);
        $data = [
            "id_penilaian_kuesioner" => $id_penilaian_kuesioner,
            "nik_penilai" => $nik_penilai,
            "nik_menilai" => $nik_menilai,
            "tanggal" => $tanggal,
            "total_nilai" => $total_nilai,
            "total_soal" => $total_soal,
            // masukin table dari penilaian kuesioner
        ];

        // insert penilaian kuesioner
        $this->db->insert("performances___penilaian_kuesioner", $data);
        $id_penilaian_kuesioner = $this->db->insert_id();

        // insert detail penilaian kuesioner
        foreach ($nilai as $id_kuesioner => $val):
            $data = [
                "ïd_kuesioner" => $id_kuesioner,
                "ïd_detail_penilaian" => $id_detail_penilaian,
                "id_penilaian_kuesioner" => $id_penilaian_kuesioner,
                "nik_penilai" => $nik_penilai,
                "nik_menilai" => $nik_menilai,
                "nilai" => $val,
            ];
            $this->db->insert("performances___detail_penilaian_kuesioner", $data);
        endforeach;
        printr($_POST);
        // printr($total);
    }


}
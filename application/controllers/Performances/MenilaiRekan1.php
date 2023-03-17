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
        $id_penilaian_kuesioner = $this->insert_tabel_penilaian_kuesioner();
        $this->insert_tabel_detail_penilaian_kuesioner($id_penilaian_kuesioner);
        redirect("performances/menilairekan1");
    }

    private function insert_tabel_detail_penilaian_kuesioner($id_penilaian_kuesioner)
    {
        $post = $this->input->post();
        $nik_penilai = $this->session->userdata("nik");
        $nik_menilai = $post["nik_menilai"];

        foreach ($post["nilai"] as $id_kuesioner => $nilai):
            $data_insert_tabel_performances__detail_penilaian_kuesioner = [
                "id_kuesioner" => $id_kuesioner,
                "id_penilaian_kuesioner" => $id_penilaian_kuesioner,
                "nik_penilai" => $nik_penilai,
                "nik_menilai" => $nik_menilai,
                "tanggal" => date("d/m/Y"),
                "nilai" => $nilai
            ];
            $this->db->insert(
                "performances___detail_penilaian_kuesioner",
                $data_insert_tabel_performances__detail_penilaian_kuesioner
            );
            // echo "<pre>" . print_r($data_insert_tabel_performances__detail_penilaian_kuesioner, true) . "</pre>";
        endforeach;
    }

    private function insert_tabel_penilaian_kuesioner()
    {
        $post = $this->input->post();
        $nik_menilai = $post["nik_menilai"];
        $total_nilai = array_sum($post["nilai"]);
        $nik_penilai = $this->session->userdata("nik");
        $total_soal = count($post["nilai"]);

        $data_insert_tabel_performances___penilaian_kuesioner = [
            "nik_penilai" => $nik_penilai,
            "nik_menilai" => $nik_menilai,
            "tanggal" => date("d/m/Y"),
            "total_nilai" => $total_nilai,
            "total_soal" => $total_soal
        ];
        $this->db->insert("performances___penilaian_kuesioner", $data_insert_tabel_performances___penilaian_kuesioner);
        return $this->db->insert_id();
    }

}
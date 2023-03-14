<?php

class MenilaiDiriRekan1_model extends CI_Model
{
    public function tampilMenilaiRekan1()
    {
        return $this->db->get('performances___penilaian_kuesioner')->result_array();

    }
    public function hasil()
    {
        if (isset($_POST['simpan'])) {
            $data1 = $_POST['data1'];
            $data2 = $_POST['data2'];
            $data3 = $_POST['data3'];
            $data4 = $_POST['data4'];
            $data5 = $_POST['data5'];
            $data6 = $_POST['data6'];
            $data7 = $_POST['data7'];
            $data8 = $_POST['data8'];
            $data9 = $_POST['data9'];
            $data10 = $_POST['data10'];
          
          
            $n= ($data1+$data2+$data3+$data4+$data5+$data6+$data7+$data8+$data9+$data10) / 10;
            $nilai = floatval($n);


        if ($nilai >= 5) {
            $kategori = "Sangat Baik";
        } elseif ($nilai >= 4) {
            $kategori = "Baik";
        } elseif ($nilai >= 3) {
            $kategori = "Cukup";
        } elseif ($nilai >= 2) {
            $kategori = "Kurang";
        } elseif($nilai >= 1) {
            $kategori = "Sangat Kurang";
        }

        $data['nilai'] = $nilai;
        $data['kategori'] = $kategori;

        $this->load->view('hasil', $data);
    }

    public function simpan_jawaban()
    {
        // Memeriksa apakah metode HTTP yang digunakan adalah POST
        if ($this->input->method() != 'post') {
            redirect('performances/penilaiankuesioner');
        }

        // Mendapatkan data dari formulir jawaban kuesioner
        $data = array(
            'id_penilaian_kuesioner' => $this->input->post('id_penilaian_kuesioner'),
            'nik_penilai' => $this->input->post('nik_penilai'),
            'menilai' => $this->input->post('menilai'),
            'tanggal_dibuat' => $this->input->post('tanggal_dibuat'),
            'total_nilai' => $this->input->post('total_nilai'),
            'total_soal' => $this->input->post('total_soal')
        );

        // Memasukkan data jawaban kuesioner ke dalam database
        $this->load->model('MenilaiDiriSendiri_model');
        $result = $this->MenilaiDiriSendiri_model->insert($data);

        // Menampilkan pesan berhasil atau gagal
        if ($result) {
            $this->session->set_flashdata('success_message', 'Jawaban kuesioner berhasil disimpan');
        } else {
            $this->session->set_flashdata('error_message', 'Jawaban kuesioner gagal disimpan');
        }

        redirect('performances/penilaiankuesioner');
    }

}
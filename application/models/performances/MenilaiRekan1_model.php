<?php

class MenilaiDiriRekan1_model extends CI_Model
{
    public function tampilMenilaiRekan1()
    {
        return $this->db->get('performances___penilaian_kuesioner')->result_array();

    }
    public function simpan_jawaban()
    {
        // Memeriksa apakah metode HTTP yang digunakan adalah POST
        if ($this->input->method() != 'post') {
            redirect('performances/menilairekan1');
        }

        // Mendapatkan data dari formulir jawaban kuesioner
        $data = array(
            'id_penilaian_kuesioner' => $this->input->post('id_penilaian_kuesioner'),
            'nik_user_by' => $this->input->post('nik_user_by'),
            'nik_user_to' => $this->input->post('nik_user_to'),
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
// public function nilaiSiswa($id_kelas, $nis)
// {
//     $this->db->select('siswa.*, kelas.*');
//     $this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
//     $this->db->from('siswa');
//     $this->db->where('kelas.id_kelas', $id_kelas);
//     $this->db->where('siswa.nis', $nis);
//     $query = $this->db->get();
//     return $query->row();
// }

// public function detail($nis)
// {
//     $this->db->select('*');
//     $this->db->from('siswa');
//     $this->db->where('nis', $nis);
//     $query = $this->db->get();
//     return $query->row();
// }

}
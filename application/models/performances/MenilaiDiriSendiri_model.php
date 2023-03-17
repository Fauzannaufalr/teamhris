<?php

class MenilaiDiriSendiri_model extends CI_Model
{
    public function tampilMenilaiDiriSendiri()
    {
        $this->db->select('data_karyawan.*, 
            performances___penilaian_kinerja.id_penilaian_kuesioner ,
            performances___penilaian_kinerja.nik_penilai,
            performances___penilaian_kinerja.menilai,
            performances___penilaian_kinerja.tanggal,
            performances___penilaian_kinerja.total_nilai,
            performances___penilaian_kinerja.total_soal,
            (SELECT 
                data_posisi.nama_posisi 
                    FROM data_posisi
                        WHERE data_posisi.id_posisi = data_karyawan.id_posisi) AS nama_posisi
        ');
        $this->db->from('performances___penilaian_kuesioner');
        $this->db->join('data_karyawan', 'data_karyawan.nik = performances___penilaian_kuesioner.nik_penilai');
        return $this->db->get()->result_array();
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
            'nik_penilai' => $this->input->post('nik_penilai'),
            'menilai' => $this->input->post('menilai'),
            'tanggal' => $this->input->post('tanggal'),
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
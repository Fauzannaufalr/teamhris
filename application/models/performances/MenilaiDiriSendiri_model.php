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

 
}
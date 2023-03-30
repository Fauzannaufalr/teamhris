<?php

class Akumulasi_model extends CI_Model
{
    public function tampilAkumulasi($id)
    {
        // printr($this->session->userdata('nik'));
        return $this->db->query("SELECT performances___penilaian_kinerja.*, data_karyawan.*, SUM(performances___penilaian_kuesioner.total_nilai) / 4 as total FROM performances___penilaian_kuesioner JOIN data_karyawan on performances___penilaian_kuesioner.nik_menilai = data_karyawan.nik JOIN performances___penilaian_kinerja ON data_karyawan.nik = performances___penilaian_kinerja.nik WHERE performances___penilaian_kuesioner.nik_menilai = $id;
        ")->result_array();
    }

    public function karyawanAkumulasiKeseluruhan($bulantahun)
    {
        return $this->db->query("SELECT *
        FROM performances___penilaian_kuesioner 
        JOIN data_karyawan ON  performances___penilaian_kuesioner.nik_menilai = data_karyawan.nik
        JOIN data_karyawan ON  performances___penilaian_kinerja.nik = data_karyawan.nik
        WHERE performances___penilaian_kuesioner.tanggal AND performances___penilaian_kinerja.tanggal='$bulantahun'")->result_array();
    }
    // public function perkaryawanAkumulasi($bulantahun)
    // {
    //     return $this->db->query("SELECT *
    //     FROM performances___penilaian_kuesioner 
    //     JOIN data_karyawan ON  performances___penilaian_kuesioner.nik_menilai = data_karyawan.nik
    //     JOIN data_karyawan ON  performances___penilaian_kinerja.nik = data_karyawan.nik
    //     WHERE performances___penilaian_kuesioner.tanggal AND performances___penilaian_kinerja.tanggal='$bulantahun'")->result_array();
    // }
    public function cetakAkumulasi()
    {
        $query = $this->db->query("SELECT 
        dk.nik,
        pk.nik_menilai,
        dk.nama_karyawan,
        pr.nilai,
        pk.total_nilai,
        FROM data_karyawan dk
        INNER JOIN data_karyawan dk_a ON pk.nik_menilai = dk_a.nik 
        INNER JOIN performances___penilaian_kinerja pr ON pk.nik= dk_b.nik 
        ");
        return $query->result_array();
    }
}
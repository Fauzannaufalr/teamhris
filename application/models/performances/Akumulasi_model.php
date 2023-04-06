<?php

class Akumulasi_model extends CI_Model
{



    public function cetakAkumulasi($bulantahun)
    {
        $query = $this->db->query("
            SELECT 
                dk.nik,
                dk.nama_karyawan,
                pkerja.tanggal, 
                (
                    SELECT SUM(pk.total_nilai) / COUNT(pk.nik_menilai)
                    FROM performances___penilaian_kuesioner pk 
                    WHERE pk.nik_menilai = dk.nik AND pk.tanggal LIKE '%$bulantahun'
                ) AS total_nilai,
                (
                    SELECT (pkerja.nilai)
                    FROM performances___penilaian_kinerja pkerja
                    WHERE pkerja.nik = dk.nik AND pkerja.tanggal LIKE '%$bulantahun'
                ) AS nilai
            FROM data_karyawan dk
            INNER JOIN performances___penilaian_kinerja pkerja ON pkerja.nik = dk.nik
            WHERE pkerja.tanggal LIKE '%$bulantahun'
        ");
        return $query->result_array();

    }
}
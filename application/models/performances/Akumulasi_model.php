<?php

class Akumulasi_model extends CI_Model
{

    public function get_nilai()
    {
        $query = $this->db->get('nilai');
        return $query->result();
    }


    public function cetakAkumulasi($bulantahun)
    {
        $query = $this->db->query("
        SELECT 
        dk.nik,
        dk.nama_karyawan,
        pkerja.tanggal, 
        (
            SELECT 
                CASE 
                    WHEN SUM(pk.total_nilai) > 4 THEN SUM(pk.total_nilai) / 4
                    ELSE SUM(pk.total_nilai)
                END AS nilai_kuesioner
            FROM 
                performances___penilaian_kuesioner pk 
            WHERE 
                pk.nik_menilai = dk.nik AND pk.tanggal LIKE '%$bulantahun'
        ) AS nilai_kuesioner,
        (   
            SELECT 
                pkerja.nilai
            FROM 
                performances___penilaian_kinerja pkerja
            WHERE 
                pkerja.nik = dk.nik AND pkerja.tanggal LIKE '%$bulantahun'
        ) AS nilai_kinerja
    FROM 
        data_karyawan dk
        INNER JOIN performances___penilaian_kinerja pkerja ON pkerja.nik = dk.nik
    WHERE 
        pkerja.tanggal LIKE '%$bulantahun'
        ");
        return $query->result_array();

    }
}
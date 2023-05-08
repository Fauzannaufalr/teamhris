<?php

class Akumulasi_model extends CI_Model
{

    public function laporan($bulantahun)
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


    public function cetakAkumulasi($bulantahun)
    {
        $query = $this->db->query(" SELECT 
        jk.id_jamkerja,
        dk.nik,
        dk.nama_karyawan,
        jk.tanggal,
        (
            SELECT 
                CASE 
                    WHEN SUM(pk.total_nilai) > 4 THEN SUM(pk.total_nilai) / 4
                    ELSE SUM(pk.total_nilai)
                END AS nilai_kuesioner
            FROM 
                performances___penilaian_kuesioner pk 
            WHERE 
                pk.nik_menilai = dk.nik AND pk.tanggal LIKE '%$bulantahun%'
        ) AS total_nilai_kuesioner,
        (
            SELECT COUNT(jk2.nik)
            FROM performances___inputjamkerja jk2 
            WHERE jk2.nik = jk.nik AND jk2.tanggal = '$bulantahun'
            GROUP BY jk2.tanggal, jk2.nik
        ) AS total_kinerja,

        (
            SELECT COUNT(jamker.keterangan) 
            FROM performances___inputjamkerja jamker  
            WHERE jamker.keterangan = 'Tepat Waktu' AND jamker.nik = jk.nik
        ) AS waktu
    FROM 
        data_karyawan dk 
        INNER JOIN performances___inputjamkerja jk ON jk.nik = dk.nik
    WHERE 
        jk.tanggal LIKE '%$bulantahun%'
    GROUP BY 
        jk.tanggal, dk.nik
         ");
        return $query->result_array();


    }
}
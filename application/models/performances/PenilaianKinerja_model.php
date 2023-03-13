<?php

class PenilaianKinerja_model extends CI_Model
{
    public function tampilPenilaianKinerja()
    {
        $this->db->select('data_karyawan.*, 
            performances___penilaian_kinerja.id_penilaian_kinerja,
            performances___penilaian_kinerja.nik,
            performances___penilaian_kinerja.nilai,
            performances___penilaian_kinerja.tgl,
            performances___penilaian_kinerja.total_kerja,
            performances___penilaian_kinerja.done_kerja,
            performances___penilaian_kinerja.kategorisasi,
            (SELECT 
                data_posisi.nama_posisi 
                    FROM data_posisi
                        WHERE data_posisi.id_posisi = data_karyawan.id_posisi) AS nama_posisi
        ');
        $this->db->from('performances___penilaian_kinerja');
        $this->db->join('data_karyawan', 'data_karyawan.nik = performances___penilaian_kinerja.nik');
        return $this->db->get()->result_array();
    }

    public function tambahPenilaianKinerja()
    {
        $total_kerja = $this->input->post('total_kerja');
        $done_kerja = $this->input->post('done_kerja');
<<<<<<< Updated upstream
        $nilai = $total_kerja / $done_kerja * (100);
=======
        $nilai = ($total_kerja / $done_kerja) * 100;

>>>>>>> Stashed changes
        if ($nilai >= 80 && $nilai <= 100) {
            $kategorisasi = "Sangat Baik";
        } else if ($nilai >= 60 && $nilai <= 79) {
            $kategorisasi = "Baik";
        } else if ($nilai >= 40 && $nilai <= 69) {
            $kategorisasi = "Cukup";
        } else if ($nilai >= 20 && $nilai <= 39) {
            $kategorisasi = "Kurang";
        } else if ($nilai >= 0 && $nilai <= 19) {
            $kategorisasi = "Sangat Kurang";
        }
        echo "Kategorisasi: " . $kategorisasi;
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
        $data = [
            "nik" => $this->input->post("nik_nama"),
            'tgl' => date("mY"),
            'total_kerja' => $total_kerja,
            'done_kerja' => $done_kerja,
            "nilai" => $nilai,
            "kategorisasi" => $kategorisasi,
        ];
        $this->db->insert('performances___penilaian_kinerja', $data);
    }
    public function ubahPenilaianKinerja()
    {
        $total_kerja = $this->input->post('total_kerja');
        $done_kerja = $this->input->post('done_kerja');
<<<<<<< Updated upstream
        $nilai = $total_kerja / $done_kerja * (100);
=======
        $nilai = ($total_kerja / $done_kerja) * 100;
        if ($nilai >= 80 && $nilai <= 100) {
            $kategorisasi = "Sangat Baik";
        } else if ($nilai >= 60 && $nilai <= 79) {
            $kategorisasi = "Baik";
        } else if ($nilai >= 40 && $nilai <= 69) {
            $kategorisasi = "Cukup";
        } else if ($nilai >= 20 && $nilai <= 39) {
            $kategorisasi = "Kurang";
        } else if ($nilai >= 0 && $nilai <= 19) {
            $kategorisasi = "Sangat Kurang";
        }
        echo "Kategorisasi: " . $kategorisasi;
>>>>>>> Stashed changes
        $data = [
            "nik" => $this->input->post("nik_nama"),
            'tgl' => date("mY"),
            'total_kerja' => $total_kerja,
            'done_kerja' => $done_kerja,
            "nilai" => $nilai,
            "kategorisasi" => $kategorisasi,
        ];
        $this->db->where('id_penilaian_kinerja', $this->input->post('id_penilaian_kinerja'));
        $this->db->update('performances___penilaian_kinerja', $data);
    }

    public function hapus($id_penilaian_kinerja)
    {
        $this->db->where('id_penilaian_kinerja', $id_penilaian_kinerja);
        $this->db->delete('performances___penilaian_kinerja');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

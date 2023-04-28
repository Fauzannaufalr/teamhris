<?php

class PenilaianKinerja_model extends CI_Model
{
    public function tampilPenilaianKinerja()
    { //model ini akan di tampilkan pada penilaian kinerja
        $this->db->select('data_karyawan.*, 
            performances___penilaian_kinerja.id_penilaian_kinerja,
            performances___penilaian_kinerja.nik,
            performances___penilaian_kinerja.nilai,
            performances___penilaian_kinerja.tanggal,
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
        $done_kerja = $this->input->post('done_kerja');
        $total_kerja = $this->input->post('total_kerja');
        $nilai = ($done_kerja / $total_kerja) * 100;
        // pr rumus penilaian kinerja

        if ($nilai >= 80 && $nilai <= 100) {
            $kategorisasi = "Sangat Baik";
        } else if ($nilai >= 60 && $nilai <= 79) {
            $kategorisasi = "Baik";
        } else if ($nilai >= 40 && $nilai <= 59) {
            $kategorisasi = "Cukup";
        } else if ($nilai >= 20 && $nilai <= 39) {
            $kategorisasi = "Kurang";
        } else if ($nilai >= 0 && $nilai <= 19) {
            $kategorisasi = "Sangat Kurang";
        }
        echo "Kategorisasi: " . $kategorisasi;
        $data = [
            "nik" => $this->input->post("nik_nama"),
            'tanggal' => date("m/Y"),
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
        $nilai = ($done_kerja / $total_kerja) * "100%";

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
        $data = [
            "nik" => $this->input->post("nik_nama"),
            'tanggal' => date("m/Y"),
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
    public function cetakKinerja($bulantahun)
    {
        $this->db->select('pk.*, dk.nama_karyawan, dk.nik, dk.email');
        $this->db->from('performances___penilaian_kinerja pk');
        $this->db->join('data_karyawan dk', 'dk.nik = pk.nik');
        $this->db->where('tanggal', $bulantahun);
        return $this->db->get()->result_array();
    }
    public function import_data($data)
    {
        // Mengecek apakah data dengan nik tersebut sudah ada atau belum
        $this->db->where('nik', $data['nik']);
        $query = $this->db->get('
        performances___penilaian_kinerja');
        if ($query->num_rows() > 0) {
            // Jika data sudah ada, maka lakukan update data
            $this->db->where('nik', $data['nik']);
            $this->db->update('performances___penilaian_kinerja', $data);
        } else {
            // Jika data belum ada, maka lakukan insert data
            $this->db->insert('performances___penilaian_kinerja', $data);
        }
    }

    public function cekNikExist($nik)
    {
        $this->db->where('nik', $nik);
        $query = $this->db->get('performances___penilaian_kinerja');
        return $query->num_rows() > 0;
    }

    public function checkPenilaianKinerjaExists($nik, $bulan, $tahun)
    {
        $this->db->where('nik', $nik);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $query = $this->db->get('performances___penilaian_kinerja');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


}
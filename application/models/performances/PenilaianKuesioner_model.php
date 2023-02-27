<?php

class PenilaianKuesioner_model extends CI_Model
{
    public function tampilPenilaianKuesioner()
    {
        $this->db->select('data_karyawan.*, 
            performances___penilaian_kuesioner.id_detail_penilaian,
            performances___penilaian_kuesioner.nik,
            performances___penilaian_kuesioner.nilai,
            performances___penilaian_kuesioner.tanggal,
            performances___penilaian_kuesioner.total_kerja,
            performances___penilaian_kuesioner.done_kerja,
            (SELECT 
                data_posisi.nama_posisi 
                    FROM data_posisi
                        WHERE data_posisi.id_posisi = data_karyawan.id_posisi) AS nama_posisi
        ');
        $this->db->from('performances___penilaian_kuesioner');
        $this->db->join('data_karyawan', 'data_karyawan.nik = performances___penilaian_kuesioner.nik_penilai');
        return  $this->db->get()->result_array();
    }
   
    public function tambahPenilaianKinerja()
    {
        $total_kerja = $this->input->post('total_kerja');
        $done_kerja =  $this->input->post('done_kerja');
        $nilai = ($total_kerja + $done_kerja) / 2;
        $data = [
            "nik"           => $this->input->post("nik_nama"),
            'tanggal'       => date("Y-m-d"),
            'total_kerja'   => $total_kerja,
            'done_kerja'    => $done_kerja,
            "nilai"         => $nilai
        ];
        $this->db->insert('performances___penilaian_kinerja', $data);
    }
    public function ubahPenilaianKinerja()
    {
        $total_kerja = $this->input->post('total_kerja');
        $done_kerja =  $this->input->post('done_kerja');
        $nilai = ($total_kerja + $done_kerja) / 2;
        $data = [
            "nik"           => $this->input->post("nik_nama"),
            'tanggal'       => date("Y-m-d"),
            'total_kerja'   => $total_kerja,
            'done_kerja'    => $done_kerja,
            "nilai"         => $nilai
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

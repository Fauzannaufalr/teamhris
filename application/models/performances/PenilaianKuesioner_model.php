<?php

class PenilaianKuesioner_model extends CI_Model
{
    public function tampilPenilaianKuesioner()
    {
        $this->db->select('*');
        $this->db->join('data_karyawan', 'data_karyawan.nik = performances___penilaian_kuesioner.nik_penilai');
        // $this->db->join('data_karyawan', 'data_karyawan.nik = performances___penilaian_kuesioner.nik_menilai');
        $this->db->from('performances___penilaian_kuesioner');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function ambilUserById($id)
    {
        return $this->db->get_where('performances___penilaian_kuesioner', ['id_penilaian_kuesioner' => $id])->result_array();
    }
    public function hapus($id_penilaian_kuesioner)
    {
        $this->db->where('id_penilaian_kuesioner', $id_penilaian_kuesioner);
        $this->db->delete('performances___penilaian_kuesioner');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function cetakKuesioner($bulantahun)
    {
        $this->db->select('pr.*, dk.nama_karyawan, dk.nik, dk.email,');
        $this->db->from('performances___penilaian_kuesioner pr');
        $this->db->join('data_karyawan dk', 'dk.nik = pr.nik_penilai', 'dk.nik = pr.nik_menilai');
        $this->db->where('tanggal', $bulantahun);
        return $this->db->get()->result_array();
    }
}
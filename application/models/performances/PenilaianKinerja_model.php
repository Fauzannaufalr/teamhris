<?php

class PenilaianKinerja_model extends CI_Model
{
    public function getAllPenilaianKinerja()
    {
        $this->db->select('*');
        $this->db->from('performances___penilaian_kinerja');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = performances___penilaian_kinerja.id_posisi');
        return  $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('performances___penilaian_kinerja');
        $this->db->join('data_karyawan', 'data_karyawan.id_karyawan = performances___penilaian_kinerja.id_karyawan');
        return  $this->db->get()->result_array();
   
    }
    public function tambahPenilaianKinerja()
    {
        $data = [
            'nik' => $this->input->post('nik'),
            'id_posisi' => $this->input->post('posisi'),
            'tanggal' => $this->input->post('tanggal'),
            'total_kerja' => $this->input->post('total_kerja'),
            'done_kerja' => $this->input->post('done_kerja'),
        ];
        $this->db->insert('performances___penilaian_kinerja', $data);
    }
    public function hapus($id_penilaian_kinerja)
    {
        $this->db->where('id_penilaian_kinerja', $id_penilaian_kinerja);
        $this->db->delete('performances___penilaian_kinerja');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

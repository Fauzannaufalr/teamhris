<?php

class PenilaianKinerja_model extends CI_Model
{
    public function getAllPenilaianKinerja()
    {
        return $this->db->get('penilaian_kinerja')->result_array();
    }
    public function tambahPenilaianKinerja()
    {
        $data = [
            'nik' => $this->input->post('nik'),
            'nama_karyawan' => $this->input->post('nama'),
            'posisi' => $this->input->post('posisi'),
            'email' => $this->input->post('email'),
            'status' => $this->input->post('status'),
            'gajipokok' => $this->input->post('gajipokok'),
            'password' => $this->input->post('password'),
            'level' => $this->input->post('level'),
            'foto' => $this->input->post('foto'),

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

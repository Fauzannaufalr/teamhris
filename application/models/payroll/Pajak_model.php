<?php

class Pajak_model extends CI_Model
{
    public function getAllDataPajakKaryawan()
    {
        return $this->db->get('payroll___pajak')->result_array();
    }

    public function tambahDataMitra()
    {
        $data = [
            'nik' => $this->input->post('nik'),
            'nama_perusahaan' => $this->input->post('perusahaan'),
            'nama_karyawan' => $this->input->post('nama'),
            'posisi' => $this->input->post('posisi'),
            'email' => $this->input->post('email'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal_keluar' => $this->input->post('tanggal_keluar')
        ];
        $this->db->insert('data_mitra', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('data_mitra');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

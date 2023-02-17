<?php

class DataKaryawan_model extends CI_Model
{
    public function getAllDataKaryawan()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_karyawan.posisi');
        return  $this->db->get()->result_array();
   
    }

    public function tambahDataKaryawan()
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
        $this->db->insert('data_karyawan', $data);
    }
    public function hapus($id_karyawan)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->delete('data_karyawan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

<?php

class DataKaryawan_model extends CI_Model
{
    public function getAllDataKaryawan()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_karyawan.id_posisi');
        return  $this->db->get()->result_array();
   
    }

    public function tambahDataKaryawan()
    {
        $data = [
            'nik' => $this->input->post('nik'),
            'nama_karyawan' => $this->input->post('nama'),
            'id_posisi' => $this->input->post('posisi'),
            'email' => $this->input->post('email'),
            'status' => $this->input->post('status'),
            'gajipokok' => $this->input->post('gajipokok'),
            'level' => $this->input->post('level'),
            'password' => $this->input->post('password'),
            'nik_leader' => $this->input->post('nikleader'),
            'foto' => $this->input->post('foto')

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

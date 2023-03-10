<?php

class DataMitra_model extends CI_Model
{
    public function getAllDataMitra()
    {
        $this->db->select('*');
        $this->db->from('data_mitra');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_mitra.id_posisi');
        return  $this->db->get()->result_array();
    }

    public function tambahDataMitra()
    {
        $data = [
            'nama_perusahaan' => $this->input->post('perusahaan'),
            'nama_karyawan' => $this->input->post('nama'),
            'id_posisi' => $this->input->post('posisi'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal_keluar' => $this->input->post('tanggal_keluar')
        ];
        $this->db->insert('data_mitra', $data);
    }

    public function ubahDataMitra()
    {
        $data = [
            'nama_perusahaan' => $this->input->post('perusahaan'),
            'nama_karyawan' => $this->input->post('nama'),
            'id_posisi' => $this->input->post('posisi'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal_keluar' => $this->input->post('tanggal_keluar')
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('data_mitra', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('data_mitra');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

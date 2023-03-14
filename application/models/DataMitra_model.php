<?php

class DataMitra_model extends CI_Model
{
    public function getAllDataMitra()
    {
        $this->db->select('*');
        $this->db->from('data_mitra');
        $this->db->order_by('data_mitra.nama_perusahaan', 'asc');
        return  $this->db->get()->result_array();
    }

    public function tambahDataMitra()
    {
        $data = [
            'nama_perusahaan' => $this->input->post('perusahaan'),
            'nama_karyawan' => $this->input->post('nama'),
            'keahlian' => $this->input->post('keahlian'),
            'tools' => $this->input->post('tools'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'rate_total' => $this->input->post('rate_total'),
            'dokumen_kerjasama' => $this->input->post('dokumen_kerjasama'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal_keluar' => $this->input->post('tanggal_keluar'),
            'status' => 'Aktif'
        ];
        $this->db->insert('data_mitra', $data);
    }

    public function ubahDataMitra()
    {
        $data = [
            'nama_perusahaan' => $this->input->post('perusahaan'),
            'nama_karyawan' => $this->input->post('nama'),
            'keahlian' => $this->input->post('keahlian'),
            'tools' => $this->input->post('tools'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'rate_total' => $this->input->post('rate_total'),
            'dokumen_kerjasama' => $this->input->post('dokumen_kerjasama'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal_keluar' => $this->input->post('tanggal_keluar'),
            'status' => $this->input->post('status')
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

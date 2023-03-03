<?php

class Perhitungan_model extends CI_Model
{
    public function tampilPerhitungan()
    {
        $this->db->select('dk.nik,dk.nama_karyawan,dk.id_karyawan,pp.*,pp.id as id_perhitungan');
        $this->db->from('payroll___perhitungan pp');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pp.id_datakaryawan');
        return  $this->db->get()->result_array();
    }

    public function tambahPerhitungan()
    {
        $data = [
            'id_datakaryawan' => $this->input->post('nik_nama'),
            'tunjangan' => $this->input->post('tunjangan'),
            'potongan' => $this->input->post('potongan'),
            'bonus' => $this->input->post('bonus')
        ];
        $this->db->insert('payroll___perhitungan', $data);
    }

    public function ubahPerhitungan()
    {
        $data = [
            'id_datakaryawan' => $this->input->post('nik_nama'),
            'tunjangan' => $this->input->post('tunjangan'),
            'potongan' => $this->input->post('potongan'),
            'bonus' => $this->input->post('bonus')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('payroll___perhitungan', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('payroll___perhitungan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

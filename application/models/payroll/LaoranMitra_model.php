<?php

class LaporanGaji_model extends CI_Model
{
    public function tampilLaporan()
    {
        $this->db->select('lg.*, dk.nama_karyawan, dk.nik, dk.email');
        $this->db->from('payroll___laporangaji lg');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = lg.id_datakaryawan');
        $this->db->order_by('lg.id_datakaryawan', 'asc');
        return  $this->db->get()->result_array();
    }
}

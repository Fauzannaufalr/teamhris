<?php

class LaporanGaji_model extends CI_Model
{
    public function tampilLaporan()
    {
        $this->db->select(
            'dk.id_karyawan,
            dk.nik,
            dk.nama_karyawan,
            dk.id_posisi,
            dk.gajipokok,
            pg.id,
            pg.tunjangan,
            pg.potongan,
            pg.bonus,
            lg.*,
            lg.id as id_laporan'
        );
        $this->db->from('payroll___laporangaji lg');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = lg.id_datakaryawan');
        $this->db->join('payroll___perhitungan pg', 'pg.id = lg.id_perhitungan');
        return  $this->db->get()->result_array();
    }
}

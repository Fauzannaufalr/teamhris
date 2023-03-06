<?php

class LaporanGaji_model extends CI_Model
{
    public function tampilLaporan()
    {
        $this->db->select('lg.*, dk.nama_karyawan');
        $this->db->from('payroll___laporangaji lg');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = lg.id_datakaryawan');
        return  $this->db->get()->result_array();
    }

    public function generate()
    {
        $date = date("Y") . date("m", strtotime('+1 month'));
        $this->db->where('status', 'Belum dibayar');
        $this->db->delete('payroll___laporangaji');
        $this->db->affected_rows();

        $this->db->select($date . ' as bulan_tahun, dp.nama_posisi,dk.nik, dk.gajipokok, pb.total, pp.id_datapajak as pajak, pg.tunjangan, pg.potongan, pg.bonus');
        $this->db->from('data_karyawan dk ');
        $this->db->join('payroll___bpjs', 'pb.id_datakaryawan = dk.id_karyawan', 'left');
        $this->db->join('payroll___pajak pp', 'pp.id_datakaryawan = dk.id_karyawan', 'left');
        $this->db->join('data_posisi dp', 'dp.id_posisi = dk.id_posisi', 'left');
        $this->db->join('payroll___perhitungan pg', 'pg.id_datakaryawan = dk.id_karyawan', 'left');
        $this->db->where('dk.status', 'Tidak Aktif');
    }
}

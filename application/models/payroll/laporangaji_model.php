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

    public function ambilKaryawanById($id)
    {
        return $this->db->get_where('payroll___laporangaji', ['id' => $id])->row_array();
    }

    public function generate()
    {
        $date = date("Y") . date("m", strtotime('+1 month'));
        $this->db->where('status', 'Belum dibayar');
        $this->db->delete('payroll___laporangaji');
        $this->db->affected_rows();

        $this->db->select($date . ' as bulan_tahun, dk.id_karyawan, dp.nama_posisi, dk.gajipokok, pb.total as bpjs, pp.id_datapajak as pajak, pg.t_kinerja, pg.t_fungsional, pg.t_jabatan, pg.potongan, pg.bonus');
        $this->db->from('data_karyawan dk ');
        $this->db->join('payroll___bpjs pb', 'pb.id_datakaryawan = dk.id_karyawan', 'left');
        $this->db->join('payroll___pajak pp', 'pp.id_datakaryawan = dk.id_karyawan', 'left');
        $this->db->join('data_posisi dp', 'dp.id_posisi = dk.id_posisi', 'left');
        $this->db->join('payroll___perhitungan pg', 'pg.id_datakaryawan = dk.id_karyawan', 'left');
        $this->db->where('dk.aktif !=', 'Tidak Aktif');
        $this->db->where('dk.id_karyawan NOT IN (SELECT id_datakaryawan FROM payroll___laporangaji WHERE bulan_tahun =' . $date . ' AND status = "Sudah dibayar")');
        $nextGaji = $this->db->get()->result_array();
        foreach ($nextGaji as $ng) {
            $data = [
                'bulan_tahun' => $ng['bulan_tahun'],
                'id_datakaryawan' => $ng['id_karyawan'],
                'nama_posisi' => $ng['nama_posisi'],
                'gajipokok' => $ng['gajipokok'],
                'bpjs' => $ng['bpjs'],
                'pajak' => $ng['pajak'],
                't_kinerja' => $ng['t_kinerja'],
                't_fungsional' => $ng['t_fungsional'],
                't_jabatan' => $ng['t_jabatan'],
                'potongan' => $ng['potongan'],
                'bonus' => $ng['bonus'],
                'total' => $ng['gajipokok'] + $ng['bpjs'] - $ng['pajak'] + $ng['t_kinerja'] + $ng['t_fungsional'] + $ng['t_jabatan'] - $ng['potongan'] + $ng['bonus'],
                'status' => 'Belum dibayar'
            ];
            $this->db->insert('payroll___laporangaji', $data);
        }
    }

    public function statusBayar($id)
    {
        $data = [
            'status' => 'Sudah dibayar'
        ];

        $this->db->where('id', $id);
        $this->db->update('payroll___laporangaji', $data);
    }

    public function cetakGaji($bulantahun)
    {
        $this->db->select('lg.*, dk.nama_karyawan, dk.nik, dk.email');
        $this->db->from('payroll___laporangaji lg');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = lg.id_datakaryawan');
        $this->db->where('bulan_tahun', $bulantahun);
        $this->db->order_by('lg.id_datakaryawan', 'asc');
        return  $this->db->get()->result_array();
    }
}

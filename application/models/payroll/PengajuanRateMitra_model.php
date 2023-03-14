<?php

class PengajuanRateMitra_model extends CI_Model
{
    public function tampilRate()
    {
        $this->db->select('pm.*, dm.nama_karyawan, dm.email, dm.nama_perusahaan, dm.keahlian, dm.tools');
        $this->db->from('payroll___pengajuanratemitra pm');
        $this->db->join('data_mitra dm', 'dm.id = pm.id_datamitra');
        return  $this->db->get()->result_array();
    }

    public function generate()
    {
        $date = date("Y") . date("m", strtotime('+1 month'));
        $this->db->where('status', 'Belum dibayar');
        $this->db->delete('payroll___pengajuanratemitra');
        $this->db->affected_rows();

        $this->db->select($date . ' as bulan_tahun, dm.id, dm.rate_total');
        $this->db->from('data_mitra dm ');
        $this->db->where('dm.status !=', 'Tidak Aktif');
        $this->db->where('dm.id NOT IN (SELECT id_datamitra FROM payroll___pengajuanratemitra WHERE bulan_tahun =' . $date . ' AND status = "Sudah dibayar")');
        $nextRate = $this->db->get()->result_array();
        foreach ($nextRate as $nr) {
            $data = [
                'bulan_tahun' => $nr['bulan_tahun'],
                'id_datamitra' => $nr['id'],
                'rate_total' => $nr['rate_total'],
                'status' => 'Belum dibayar'
            ];
            $this->db->insert('payroll___pengajuanratemitra', $data);
        }
    }

    public function statusBayar($id)
    {
        $data = [
            'status' => 'Sudah dibayar'
        ];

        $this->db->where('id', $id);
        $this->db->update('payroll___pengajuanratemitra', $data);
    }
}

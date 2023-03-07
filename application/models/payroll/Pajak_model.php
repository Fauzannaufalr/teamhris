<?php

class Pajak_model extends CI_Model
{
    public function tampilPajakKaryawan()
    {
        $this->db->select('*, pp.id as id_pajak');
        $this->db->from('payroll___pajak pp');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = pp.id_datakaryawan');
        $this->db->join('payroll___datapajak pd', 'pd.id = pp.id_datapajak');
        $this->db->order_by('pp.id_datakaryawan', 'asc');
        return  $this->db->get()->result_array();
    }

    public function tambahPajakKaryawan()
    {
        $data = [
            'id_datakaryawan' => $this->input->post('nik_nama'),
            'id_datapajak' => $this->input->post('golongan_kode'),
        ];
        $this->db->insert('payroll___pajak', $data);
    }

    public function ubahPajakKaryawan()
    {
        $data = [
            'id_datakaryawan' => $this->input->post('nik_nama'),
            'id_datapajak' => $this->input->post('golongan_kode'),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('payroll___pajak', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('payroll___pajak');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

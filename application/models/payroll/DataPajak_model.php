<?php

class DataPajak_model extends CI_Model
{
    public function tampilDataPajak()
    {
        return $this->db->get('payroll___datapajak')->result_array();
    }

    public function tambahDataPajak()
    {
        $data = [
            'golongan' => htmlspecialchars($this->input->post('golongan')),
            'kode' => htmlspecialchars($this->input->post('kode')),
            'tarif' => htmlspecialchars($this->input->post('tarif'))
        ];
        $this->db->insert('payroll___datapajak', $data);
    }

    public function ubahDataPajak()
    {
        $data = [
            'golongan' => htmlspecialchars($this->input->post('golongan')),
            'kode' => htmlspecialchars($this->input->post('kode')),
            'tarif' => htmlspecialchars($this->input->post('tarif'))

        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('payroll___datapajak', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('payroll___datapajak');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

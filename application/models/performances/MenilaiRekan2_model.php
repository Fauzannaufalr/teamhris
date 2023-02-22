<?php

class MenilaiDiriSendiri_model extends CI_Model
{
    public function tampilMenilaiDiriSenidri()
    {
        return $this->db->get('performances___penilaian_kuesioner')->result_array();
    }

    public function tambahMenilaiDiriSenidri()
    {
        $data = [
            'golongan' => $this->input->post('golongan'),
            'kode' => $this->input->post('kode'),
            'tarif' => $this->input->post('tarif')
        ];
        $this->db->insert('payroll___datapajak', $data);
    }

    public function hapus($id_penilaian_kuesioner)
    {
        $this->db->where('id_penilaian_kuesioner', $id_penilaian_kuesioner);
        $this->db->delete('performances___penilaian_kuesioner');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

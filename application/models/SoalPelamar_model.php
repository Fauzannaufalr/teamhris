<?php

class SoalPelamar_model extends CI_Model
{
    public function getAllSoalPelamar()
    {
        return $this->db->get('soal_recruitment')->result_array();
    }

    public function tambahSoalPelamar()
    {
        $data = [
            'linksoal' => $this->input->post('soalpelamar'),
        ];
        $this->db->insert('soal_recruitment', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('soal_recruitment');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

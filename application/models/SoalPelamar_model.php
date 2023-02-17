<?php

class SoalPelamar_model extends CI_Model
{
    public function getAllSoalPelamar()
    {
        return $this->db->get('recruitment___soal')->result_array();
    }

    public function tambahSoalPelamar()
    {
        $data = [
            'linksoal' => $this->input->post('soalpelamar'),
        ];
        $this->db->insert('recruitment___soal', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('recruitment___soal');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

<?php

class SoalPelamar_model extends CI_Model
{
    public function getAllSoalPelamar()
    {
        //return $this->db->get('recruitment___soal')->result_array();
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_karyawan.id_posisi');
        return  $this->db->get()->result_array();
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

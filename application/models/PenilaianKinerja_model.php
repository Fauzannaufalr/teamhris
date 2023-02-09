<?php

class PenilaianKinerja_model extends CI_Model
{
    public function getAllPenilaianKinerja()
    {
        return $this->db->get('penilaian_kinerja')->result_array();
    }
    public function hapus($id_penilaian_kinerja)
    {
        $this->db->where('id_penilaian_kinerja', $id_penilaian_kinerja);
        $this->db->delete('penilaian_kinerja');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

<?php

class Akumulasi_model extends CI_Model
{
    public function getAllAkumulasi()
    {
        return $this->db->get('akumulasi')->result_array();
    }
    public function hapus($id_akumulasi)
    {
        $this->db->where('id_penilaian_kinerja', $id_akumulasi);
        $this->db->delete('akumulasi');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

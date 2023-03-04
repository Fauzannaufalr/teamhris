<?php

class Akumulasi_model extends CI_Model
{
    public function tampilAkumulasi()
    {
        return $this->db->get('performances___penilaian_kuesioner')->result_array();
    }

}
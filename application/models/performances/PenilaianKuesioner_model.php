<?php

class PenilaianKuesioner_model extends CI_Model
{
    public function tampilPenilaianKuesioner()
    {
        return $this->db->get('performances___penilaian_kuesioner')->result_array();
    }
}
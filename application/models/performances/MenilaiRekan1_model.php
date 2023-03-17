<?php

class MenilaiRekan1_model extends CI_Model
{
    public function tampilMenilaiRekan1()
    {
        return $this->db->get('performances___penilaian_kuesioner')->result_array();

    }


}
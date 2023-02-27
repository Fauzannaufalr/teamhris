<?php

class MenilaiLeader_model extends CI_Model
{
    public function tampilMenilaiLeader()
    {
        return $this->db->get('performances___penilaian_kuesioner')->result_array();
    }

   
 
}

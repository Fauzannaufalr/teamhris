<?php

class SoalKuesioner_model extends CI_Model {
    public function getAllSoalKuesioner() 
    {
        return $this->db->get('soal_kuesioner')->result_array();
    }
}
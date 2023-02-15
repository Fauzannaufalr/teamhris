<?php

class SoalKuesioner_model extends CI_Model {
    public function getAllSoalKuesioner() 
    {
        return $this->db->get('soal_kuesioner')->result_array();
    }
    public function tambahSoalKuesioner()
    {
        $data = [
            'kuesioner' => $this->input->post('kuesioner'),
        ];
        $this->db->insert('soal_kuesioner', $data);
    }
}
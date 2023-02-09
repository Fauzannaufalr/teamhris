<?php

class DataPosisi_model extends CI_Model {
    public function getAllDataPosisi() 
    {
        return $this->db->get('data_posisi')->result_array();
    }

}
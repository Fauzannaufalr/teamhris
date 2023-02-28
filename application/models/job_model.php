<?php

class Pekerjaan_model extends CI_Model
{
    public function tampilDataJob()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('recruitment___pekerjaan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = recruitment___pekerjaan.id_posisi');
        return  $this->db->get()->result_array();
    }
}

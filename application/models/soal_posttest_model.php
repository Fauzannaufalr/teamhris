<?php

class soal_posttest_model extends CI_Model
{
    public function getAllSoal()
    {
        return $this->db->get('post_test')->result_array();
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('post_test');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

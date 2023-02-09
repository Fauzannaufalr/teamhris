<?php

class Kelola_model extends CI_Model
{
    public function getAllKelolaPekerjaan()
    {
        return $this->db->get('kelola')->result_array();
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kelola');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

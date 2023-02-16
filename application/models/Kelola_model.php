<?php

class Kelola_model extends CI_Model
{
    public function getAllKelolaPekerjaan()
    {
        return $this->db->get('recruitment___pekerjaan')->result_array();
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('recruitment___pekerjaan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

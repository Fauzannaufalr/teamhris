<?php

class DataAkun_model extends CI_Model
{
    public function getAllDataAkun()
    {
        return $this->db->get('data_akun')->result_array();
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('data_akun');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

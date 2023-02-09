<?php

class DataKaryawan_model extends CI_Model
{
    public function getAllDataKaryawan()
    {
        return $this->db->get('data_karyawan')->result_array();
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('data_karyawan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

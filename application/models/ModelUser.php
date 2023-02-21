<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    public function simpanData($data = null)
    {
        $this->db->insert('data_karyawan', $data);
    }
    public function cekData($where = null)
    {
        return $this->db->get_where('data_karyawan', $where);
    }
    public function getUserWhere($where = null)
    {
        return $this->db->get_where('data_karyawan', $where);
    }
    public function cekUserAccess($where = null)
    {
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->where($where);
        return $this->db->get();
    }
    public function getUserLimit()
    {
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->limit(10, 0);
        return $this->db->get();
    }
}

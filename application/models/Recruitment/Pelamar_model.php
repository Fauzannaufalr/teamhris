<?php

class Pelamar_model extends CI_Model
{
    public function ambilUser()
    {
        return $this->db->get_where('recruitment___pelamar', ['id_pelamar' => $this->session->userdata('id_pelamar')])->row_array();
    }
    public function getAllPelamar()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('recruitment___pelamar');
        return  $this->db->get()->result_array();
    }

    public function hapus($id_pelamar)
    {
        $this->db->where('id_pelamar', $id_pelamar);
        $this->db->delete('recruitment___pelamar');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

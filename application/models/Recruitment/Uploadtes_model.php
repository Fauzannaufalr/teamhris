<?php

class Uploadtes_model extends CI_Model
{
    public function ambilUser()
    {
        return $this->db->get_where('recruitment___pelamar', ['id_pelamar' => $this->session->userdata('id_pelamar')])->row_array();
    }
    public function getAllhasiltes()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('recruitment___hasiltes');
        return  $this->db->get()->result_array();
    }

    public function hapus($id_pelamar)
    {
        $this->db->where('id_pelamar', $id_pelamar);
        $this->db->delete('recruitmen___hasiltes');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function download($file)
    {
        $query = $this->db->get_where('recruitment___pelamar', array('file_cv' => $file));
        return $query->row_array();
    }
}

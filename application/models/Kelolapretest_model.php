<?php

class kelolapretest_model extends CI_Model
{
    public function getAllhasilpretest()
    {
        return $this->db->get('hasil_pretest')->result_array();
    }
    public function hapus($id_hasilpretest)
    {
        $this->db->where('id_hasipretest', $id_hasilpretest);
        $this->db->delete('hasil_pretest');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

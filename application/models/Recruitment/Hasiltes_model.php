<?php

class Hasiltes_model extends CI_Model
{
    public function ambilUser()
    {
        return $this->db->get_where('recruitment___hasiltes', ['id_hasiltes' => $this->session->userdata('id_hasiltes')])->row_array();
    }
    public function getAllHasiltes()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('recruitment___hasiltes');
        return  $this->db->get()->result_array();
    }

    public function hapus($id_hasiltes)
    {
        $this->db->where('id_hasiltes', $id_hasiltes);
        $this->db->delete('recruitment___hasiltes');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function download($file)
    {
        $query = $this->db->get_where('recruitment___hasiltes', array('hasil_pengerjaan' => $file));
        return $query->row_array();
    }
    public function statuspelamar($id)
    {
        $data = [
            'status' => 'beri nilai'
        ];

        $this->db->where('id_hasiltes', $id);
        $this->db->update('recruitment___hasiltes', $data);
    }
}

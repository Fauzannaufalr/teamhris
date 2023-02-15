<?php

class DataPosisi_model extends CI_Model {
    public function getAllDataPosisi() 
    {
        return $this->db->get('data_posisi')->result_array();
    }
    public function tambahDataPosisi()
    {
        $data = [
            'nama_posisi' => $this->input->post('posisi'),
        ];
        $this->db->insert('data_posisi', $data);
    }

    public function hapus($id_posisi)
    {
        $this->db->where('id_posisi', $id_posisi);
        $this->db->delete('data_posisi');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
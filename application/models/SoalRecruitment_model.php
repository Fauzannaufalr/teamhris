<?php

class SoalRecruitment_model extends CI_Model
{
    public function getAllSoalRecruitment()
    {
        $this->db->select('*');
        $this->db->from('soal_recruitment');
        $this->db->join('data_posisi', 'data_posisi.id_posisi =soal_recruitment.id_posisi');
        return  $this->db->get()->result_array();
    }

    public function tambahSoalRecruitment()
    {
        $data = [
            'id_posisi' => $this->input->post('posisi'),
            'link_soal' => $this->input->post('link_soal')

        ];
        $this->db->insert('soal_recruitment', $data);
    }

    public function ubahSoalRecruitment()
    {
        $data = [
            'link_soal' => $this->input->post('link_soal'),
          
        ];
        $this->db->where('id_soal_recruitment', $this->input->post('id_soal_recruitment'));
        $this->db->update('soal_recruitment', $data);
    }
   
    public function hapus($id_soal_recruitment)
    {
        $this->db->where('id_soal_recruitment', $id_soal_recruitment);
        $this->db->delete('soal_recruitment');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

   
}

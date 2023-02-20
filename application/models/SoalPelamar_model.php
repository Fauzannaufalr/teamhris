<?php

class SoalPelamar_model extends CI_Model
{
    public function getAllSoalPelamar()
    {
        $this->db->select('*');
        $this->db->from('recruitment___soal');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = recruitment___soal.id_posisi');
        return  $this->db->get()->result_array();
    }

    public function tambahSoalPelamar()
    {
        $data = [
            'id_posisi' => $this->input->post('posisi'),
            'link_soal' => $this->input->post('link_soal')

        ];
        $this->db->insert('recruitment___soal', $data);
    }
    public function hapus($id_soal_recruitment)
    {
        $this->db->where('id_soal_recruitment', $id_soal_recruitment);
        $this->db->delete('recruitment___soal');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_soal_by_id($id)
    {
        $this->db->where('id_soal_recruitment', $id);
        $query = $this->db->get('recruitment_soal');
        return $query->row();
    }

    public function update_soal($id, $posisi,  $link_soal)
    {
        $data = array(
            'posisi' => $posisi,
            'link_soal' => $link_soal
        );
        $this->db->where('id_soal_recruitment', $id);
        $this->db->update('id_soal_recruitment', $data);
    }
}

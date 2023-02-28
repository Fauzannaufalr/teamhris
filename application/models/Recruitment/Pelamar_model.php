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
        $this->db->join('recruitment___pekerjaan', 'recruitment___pekerjaan.id_pekerjaan = recruitment___pelamar.id_pelamar');
        return  $this->db->get()->result_array();
    }

    public function tambahPelamar()
    {

        $data = [
            'id_pelamar' => htmlspecialchars($this->input->post('posisi')),
            'email' => htmlspecialchars($this->input->post('email')),
            'file_cv' => htmlspecialchars($this->input->post('file-cv')),
            'status' => htmlspecialchars($this->input->post('status')),
            'nilai' => htmlspecialchars($this->input->post('nilai')),


        ];

        $this->db->insert('recruitment___pelamar', $data);
    }

    public function ubahPelamar()
    {
        $data = [
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'email' => htmlspecialchars($this->input->post('email')),
            'file_cv' => htmlspecialchars($this->input->post('file-cv')),
            'status' => htmlspecialchars($this->input->post('status')),
            'nilai' => htmlspecialchars($this->input->post('nilai')),
        ];

        $this->db->where('id_pelamar', $this->input->post('id_pelamar'));
        $this->db->update('recruitment___pelamar', $data);
    }

    public function hapus($id_pelamar)
    {
        $this->db->where('id_pelamar', $id_pelamar);
        $this->db->delete('recruitment___pelamar');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}

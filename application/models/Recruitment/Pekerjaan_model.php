<?php

class Pekerjaan_model extends CI_Model
{
    public function ambilUser()
    {
        return $this->db->get_where('recruitment___pekerjaan', ['id_posisi' => $this->session->userdata('id_posisi')])->row_array();
    }
    public function tampilPekerjaan()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('recruitment___pekerjaan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = recruitment___pekerjaan.id_posisi');
        return  $this->db->get()->result_array();
    }

    public function tambahPekerjaan()
    {

        $data = [
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'deskripsi_pekerjaan' => htmlspecialchars($this->input->post('deskripsi_pekerjaan')),
            'kualifikasi' => htmlspecialchars($this->input->post('kualifikasi')),
            'tanggal_berakhir' => htmlspecialchars($this->input->post('tanggal_berakhir')),
            'foto' => 'default.jpg'

        ];

        $this->db->insert('recruitment___pekerjaan', $data);
    }

    public function ubahPekerjaan()
    {
        $data = [
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'deskripsi_pekerjaan' => htmlspecialchars($this->input->post('deskripsi_pekerjaan')),
            'kualifikasi' => htmlspecialchars($this->input->post('kualifikasi')),
            'tanggal_berakhir' => htmlspecialchars($this->input->post('tanggal_berakhir')),
            'foto' => 'default.jpg'
        ];

        $this->db->where('id_pekerjaan', $this->input->post('id_pekerjaan'));
        $this->db->update('recruitment___pekerjaan', $data);
    }

    public function hapus($id_pekerjaan)
    {
        $this->db->where('id_pekerjaan', $id_pekerjaan);
        $this->db->delete('recruitment___pekerjaan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function update_cv($filename)
    {
        $id = $this->session->userdata('id_pekerjaan');

        $this->db->set('cv', $filename);
        $this->db->where('id_pekerjaan', $id);
        $this->db->update('recruitment___pekerjaan');
    }
}

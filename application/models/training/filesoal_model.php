<?php

class filesoal_model extends CI_Model
{
    public function getAllfilesoal()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_pes');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_pes.id_posisi');
        $this->db->join('data_karyawan', 'data_karyawan.id_karyawan = data_pes.id_karyawan');
        $this->db->join('tb_jenis_ujian', 'tb_jenis_ujian.id_jenis_ujian = data_pes.id_jenis_ujian');
        return $this->db->get()->result_array();
    }

    public function tambahdatasoal($dokumen)
    {
        $data = [
            'nama_karyawan' => htmlspecialchars($this->input->post('nama')),
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'tanggal_ujian' => htmlspecialchars($this->input->post('tanggal ujian')),
            'jam_ujian' => htmlspecialchars($this->input->post('jam ujian')),
            'id_jenis_ujian' => htmlspecialchars($this->input->post('jenis ujian')),
            'durasi_ujian' => htmlspecialchars($this->input->post('durasi ujian')),
            'file_soal' => htmlspecialchars($this->input->post('dokumen soal')),
            'file_jawaban' => htmlspecialchars($this->input->post('dokumen jawaban')),

        ];
        $this->db->insert('data_pes', $data);
    }

    public function ubahDatasoal()
    {
        $data = [
            'nama_karyawan' => htmlspecialchars($this->input->post('nama')),
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'tanggal_ujian' => htmlspecialchars($this->input->post('tanggal ujian')),
            'jam_ujian' => htmlspecialchars($this->input->post('jam ujian')),
            'id_jenis_ujian' => htmlspecialchars($this->input->post('jenis ujian')),
            'durasi_ujian' => htmlspecialchars($this->input->post('durasi ujian')),
            'file_soal' => htmlspecialchars($this->input->post('dokumen soal')),
            'file_jawaban' => htmlspecialchars($this->input->post('dokumen jawaban')),

        ];

        $this->db->where('id_pes', $this->input->post('id_keseluruhan'));
        $this->db->update('data_pes', $data);
    }
    public function download($file)
    {
        $query = $this->db->get_where('data_pes', array('file' => $file));
        return $query->row_array();
    }

    public function hapus($id_pes)
    {
        $this->db->where('id_pes', $id_pes);
        $this->db->delete('data_pes');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
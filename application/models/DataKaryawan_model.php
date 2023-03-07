<?php

class DataKaryawan_model extends CI_Model
{
    public function getAllDataKaryawan()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_karyawan.id_posisi');
        return $this->db->get()->result_array();
    }
    public function getDataKaryawanExcept($nik)
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_karyawan.id_posisi');
        $this->db->where("data_karyawan.nik !=", $nik);
        return $this->db->get()->result_array();
    }

    public function tambahDataKaryawan()
    {
        $email = $this->input->post('email');
        $data = [
            'nik' => htmlspecialchars($this->input->post('nik')),
            'nama_karyawan' => htmlspecialchars($this->input->post('nama')),
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'email' => htmlspecialchars($email),
            'status' => htmlspecialchars($this->input->post('status')),
            'gajipokok' => htmlspecialchars($this->input->post('gajipokok')),
            'nik_leader' => htmlspecialchars($this->input->post('nikleader')),
            'level' => htmlspecialchars($this->input->post('level')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telepon' => htmlspecialchars($this->input->post('telepon')),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'foto' => 'default.jpg'

        ];
        $token = base64_encode(random_bytes(32));
        $user_token = [
            'email' => $email,
            'token' => $token,
            'date_created' => time()

        ];
        $this->db->insert('data_karyawan', $data);
        $this->db->insert('user_token', $user_token);
    }

    public function ubahDataKaryawan()
    {
        $email = $this->input->post('email');
        $data = [
            'nik' => htmlspecialchars($this->input->post('nik')),
            'nama_karyawan' => htmlspecialchars($this->input->post('nama')),
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'email' => htmlspecialchars($email),
            'status' => htmlspecialchars($this->input->post('status')),
            'gajipokok' => htmlspecialchars($this->input->post('gajipokok')),
            'nik_leader' => htmlspecialchars($this->input->post('nikleader')),
            'level' => htmlspecialchars($this->input->post('level')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telepon' => htmlspecialchars($this->input->post('telepon'))

        ];

        $this->db->where('id_karyawan', $this->input->post('id_karyawan'));
        $this->db->update('data_karyawan', $data);
    }

    public function hapus($id_karyawan)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->delete('data_karyawan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
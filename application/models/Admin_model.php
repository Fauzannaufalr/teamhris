<?php

class Admin_model extends CI_Model
{
    public function ambilUser()
    {
        return $this->db->get_where('data_karyawan', ['nik' => $this->session->userdata('nik')])->row_array();
    }

    public function ubahPassword($password_baru)
    {
        $password = password_hash($password_baru, PASSWORD_DEFAULT);

        $this->db->set('password', $password);
        $this->db->where('nik', $this->session->userdata('nik'));
        $this->db->update('data_karyawan');
    }
}

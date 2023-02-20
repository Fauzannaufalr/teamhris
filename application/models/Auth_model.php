<?php

class Auth_model extends CI_Model
{
    public function ambilUser($username)
    {
        return $this->db->get_where('data_karyawan', ['nik' => $username])->row_array();
    }
}

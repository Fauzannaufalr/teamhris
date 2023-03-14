<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Soal_model extends CI_Model
{

    public function get_joinsoal($id)
    {
        $query = 'SELECT * FROM tb_soal join data_posisi ON tb_soal.id_posisi=data_posisi.id_posisi WHERE tb_soal.id_soal_ujian="' . $id . '"';
        return $this->db->query($query);
    }
}

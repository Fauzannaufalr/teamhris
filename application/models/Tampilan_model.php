<?php

class Tampilan_model extends CI_Model
{

    public function tambahtampilan()
    {

        $data = [
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'email' => htmlspecialchars($this->input->post('email')),
            'file_cv' => htmlspecialchars($this->input->post('fike_cv')),

        ];

        $this->db->insert('recruitment___pekerjaan', $data);
    }
}

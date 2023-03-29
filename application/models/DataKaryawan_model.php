<?php

class DataKaryawan_model extends CI_Model
{
    public function getAllDataKaryawan()
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_karyawan.id_posisi');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = data_karyawan.id_kelas');
        return $this->db->get()->result_array();
    }
    public function getDataKaryawanExcept($nik)
    {
        // return $this->db->get('data_karyawan')->result_array();
        $this->db->select('*');
        $this->db->from('data_karyawan');
        $this->db->join('data_posisi', 'data_posisi.id_posisi = data_karyawan.id_posisi');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = data_karyawan.id_kelas');
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
            'id_kelas' => htmlspecialchars($this->input->post('id_kelas')),
            'email' => htmlspecialchars($email),
            'status' => 'Aktif',
            'gajipokok' => htmlspecialchars($this->input->post('gajipokok')),
            'nik_leader' => htmlspecialchars($this->input->post('nikleader')),
            'level' => htmlspecialchars($this->input->post('level')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telepon' => htmlspecialchars($this->input->post('telepon')),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'foto' => 'default.jpg'

        ];
        $this->db->insert('data_karyawan', $data);
    }

    public function ubahDataKaryawan()
    {
        $email = $this->input->post('email');
        $data = [
            'nik' => htmlspecialchars($this->input->post('nik')),
            'nama_karyawan' => htmlspecialchars($this->input->post('nama')),
            'id_posisi' => htmlspecialchars($this->input->post('posisi')),
            'id_kelas' => htmlspecialchars($this->input->post('id_kelas')),
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

    public function import()
    {
        if (isset($_POST["submit"])) {
            $file = $_FILES['import']['tmp_name'];
            $handle = fopen($file, "r");
            while (($filedata = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $data = [
                    'nik' => htmlspecialchars($filedata[0]),
                    'nama_karyawan' => htmlspecialchars($filedata[1]),
                    'id_posisi' => htmlspecialchars($filedata[2]),
                    'id_kelas' => htmlspecialchars($filedata[3]),
                    'email' => htmlspecialchars($filedata[4]),
                    'status' => $filedata[5],
                    'gajipokok' => htmlspecialchars($filedata[6]),
                    'nik_leader' => htmlspecialchars($filedata[7]),
                    'level' => htmlspecialchars($filedata[8]),
                    'alamat' => htmlspecialchars($filedata[9]),
                    'telepon' => htmlspecialchars($filedata[10]),
                    'password' => password_hash($filedata[11], PASSWORD_DEFAULT),
                    'foto' => $filedata[12]

                ];
                $this->db->insert('data_karyawan', $data);
                return $this->db->insert_id();
            }
            fclose($handle);
            redirect('master/datakaryawan');
        }
    }

    public function import_data($data)
    {
        $jumlah = count($data);
        if ($jumlah > 0) {
            $this->db->insert('data_karyawan', $data);
        }
    }
}

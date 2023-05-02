<?php

class Hris_model extends CI_Model
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

    public function ubahProfile($data)
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $telepon = $this->input->post('telepon');

        // cek jika ada gambar yang akan diuploud
        $upload_gambar = $_FILES['foto']['name'];
        if ($upload_gambar) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '4024';
            $config['upload_path'] = './dist/img/profile';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $gambar_lama = $data['user']['foto'];
                if ($gambar_lama != 'default.jpg') {
                    unlink(FCPATH . 'dist/img/profile/' . $gambar_lama);
                }

                $gambar_baru = $this->upload->data('file_name');
                $this->db->set('foto', $gambar_baru);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('hris/ubahprofile');
            }
        }

        $this->db->set('nama_karyawan', $nama);
        $this->db->set('email', $email);
        $this->db->set('alamat', $alamat);
        $this->db->set('telepon', $telepon);
        $this->db->where('nik', $this->session->userdata('nik'));
        $this->db->update('data_karyawan');
    }

    public function cetakNilaiDashboard($bulantahun)
    {
        $query = $this->db->query("SELECT 
        pk.tanggal,
        dk.nik,
        dk.nama_karyawan,
        (
            SELECT SUM(pk2.total_nilai) / 4
            FROM performances___penilaian_kuesioner pk2 
            WHERE pk2.nik_menilai = dk.nik  AND pk.tanggal = '$bulantahun' GROUP BY pk.tanggal 
        ) AS total_nilai_kuesioner,
        (
            SELECT SUM(pkerja.nilai) 
            FROM performances___penilaian_kinerja pkerja  
            WHERE pkerja.nik = dk.nik AND pkerja.tanggal = '$bulantahun' 
        ) AS total_nilai_kinerja
        FROM data_karyawan dk 
        INNER JOIN performances___penilaian_kuesioner pk ON pk.nik_menilai=dk.nik
        WHERE pk.tanggal = '$bulantahun '
        GROUP BY pk.tanggal, pk.nik_menilai
         ");
        return $query->result_array();

    }
    public function laporan($bulantahun)
    {
        $query = $this->db->query("SELECT 
        pk.tanggal,
        dk.nik,
        dk.nama_karyawan,
        (
            SELECT SUM(pk2.total_nilai) / 4
            FROM performances___penilaian_kuesioner pk2 
            WHERE pk2.nik_menilai = dk.nik  AND pk2.tanggal = '$bulantahun' 
        ) AS total_nilai_kuesioner,
        (
            SELECT SUM(pkerja.nilai) 
            FROM performances___penilaian_kinerja pkerja  
            WHERE pkerja.nik = dk.nik AND pkerja.tanggal = '$bulantahun' 
        ) AS total_nilai_kinerja
        FROM data_karyawan dk 
        INNER JOIN performances___penilaian_kuesioner pk ON pk.nik_menilai=dk.nik
        WHERE pk.tanggal = '$bulantahun '
        GROUP BY pk.tanggal, pk.nik_menilai
         ");
        return $query->result_array();


    }
}
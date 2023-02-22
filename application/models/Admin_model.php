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
            $config['max_size']     = '4000';
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
                redirect('admin/ubahprofile');
            }
        }

        $this->db->set('nama_karyawan', $nama);
        $this->db->set('email', $email);
        $this->db->set('alamat', $alamat);
        $this->db->set('telepon', $telepon);
        $this->db->where('nik', $this->session->userdata('nik'));
        $this->db->update('data_karyawan');
    }
}

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
        $nama = $this->input->post('name', true);
        $email = $this->input->post('email', true);

        ///jika gambar di upload
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['upload_path'] = './dist/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $congig['max_size'] = '3000';
            $config['max_width'] = '1024';
            $config['max_height'] = '1000';
            $config['file_name'] = 'pro' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $gambar_lama = $data['user']['image'];
                if ($gambar_lama != 'default.jpg') {
                    unlink(FCPATH . 'dist/img/profile/' . $gambar_lama);
                }
                $gambar_baru = $this->upload->data('file_name');
                $this->db->set('iamge', $gambar_baru);
            } else {
            }
        }

        $this->db->set('name', $nama);
        $this->db->where('email', $email);
        $this->db->update('user');
    }
}

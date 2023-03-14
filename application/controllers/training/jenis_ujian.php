<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_ujian extends CI_Controller
{

	public function __construct()
	{
		$this->load->model('training/m_data');
		$this->load->model('Hris_model');
	}

	public function index()
	{
		$data['title'] = 'Jenis Ujian';
		$data['user'] = $this->Hris_model->ambilUser();
		$data['jenis_ujian'] = $this->m_data->get_data('tb_jenis_ujian')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('training/jenis_ujian', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[tb_jenis_ujian.jenis_ujian]', ['required' => 'Jenis Ujian tidak boleh kosong!']);

		$nama = htmlspecialchars($this->input->post('nama', TRUE));
		if ($this->form_validation->run() != false) {
			$data = array(
				'jenis_ujian' => $nama
			);
			$this->m_data->insert_data($data, 'tb_jenis_ujian');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil menambahkan data Jenis Ujian</div>');
			redirect(base_url('jenis_ujian'));
		} else {
			$this->load->view('training/jenis_ujian_tambah');
		}
	}

	public function edit($id)
	{
		$where = array(
			'id_jenis_ujian' => $id
		);
		$data['jenis_ujian'] = $this->m_data->edit_data($where, 'tb_jenis_ujian')->result();
		$this->load->view('training/jenis_ujian_edit', $data);
	}

	public function update()
	{
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');

		$where = array('id_jenis_ujian' => $id);


		$data = array(
			'jenis_ujian' => $nama
		);
		$this->m_data->update_data($where, $data, 'tb_jenis_ujian');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil mengupdate data Jenis Ujian</div>');
		redirect(base_url('jenis_ujian'));
	}

	public function hapus($id)
	{
		$where = array(
			'id_jenis_ujian' => $id
		);
		$this->m_data->delete_data($where, 'tb_jenis_ujian');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil menghapus data Jenis Ujian</div>');
		redirect(base_url('jenis_ujian'));
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanGaji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll/laporangaji_model', 'LaporanGaji');
        $this->load->model('payroll/perhitungan_model', 'Perhitungan');
        $this->load->model('DataKaryawan_model', 'DataKaryawan');
        $this->load->model('Hris_model', 'Hris');
        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = "Laporan Gaji Karyawan";
        $data['laporan'] = $this->LaporanGaji->tampilLaporan();
        $data['datakaryawan'] = $this->DataKaryawan->getAllDataKaryawan();
        $data['perhitungan'] = $this->Perhitungan->tampilPerhitungan();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/laporangaji', $data);
        $this->load->view('templates/footer');
    }

    public function generate()
    {
        $data['title'] = "Laporan Gaji Karyawan";
        $data['generate'] = $this->LaporanGaji->generate();
        $data['laporan'] = $this->LaporanGaji->tampilLaporan();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/laporangaji', $data);
        $this->load->view('templates/footer');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Generate data berhasil!</div>');
        redirect('payroll/laporangaji');
    }

    public function status($id)
    {
        $this->LaporanGaji->statusBayar($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Status bayar berhasil diubah!</div>');
        redirect('payroll/laporangaji');
    }

    private function _kirimEmail()
    {
        $file_data = $this->upload_file();
        if (is_array($file_data)) {
            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'belajarcoding78@gmail.com',
                'smtp_pass' => 'jeudcmhfxmcuwllq',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n",
                'wordwrap'  => TRUE
            ];

            $this->load->library('email', $config);
            $this->email->initialize($config);

            $this->email->from('belajarcoding78@gmail.com', 'PT. Sahaware Teknologi Indonesia');
            $this->email->to($this->input->post('email'));

            $this->email->subject('Slip Gaji');
            $this->email->message('Kirim slip gaji');

            $this->email->attach($file_data['full_path']);
            if ($this->email->send()) {
                if (delete_files($file_data['file_path'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Slip gaji berhasil dikirim!</div>');
                    redirect('payroll/laporangaji');
                }
            } else {
                if (delete_files($file_data['file_path'])) {
                    $this->session->set_flashdata('message', 'There is an error in email send');
                    redirect('payroll/laporangaji');
                }
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Slip gaji harus diinput!</div>');
            redirect('payroll/laporangaji');
        }
    }

    public function upload_file()
    {
        $config['upload_path'] = './dist/slipgaji';
        $config['max_size'] = '4024';
        $config['allowed_types'] = 'doc|docx|pdf';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('slipgaji')) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }

    public function kirimSlip()
    {
        $data['title'] = "Laporan Gaji Karyawan";
        $data['laporan'] = $this->LaporanGaji->tampilLaporan();
        $data['datakaryawan'] = $this->DataKaryawan->getAllDataKaryawan();
        $data['perhitungan'] = $this->Perhitungan->tampilPerhitungan();
        $data['user'] = $this->Hris->ambilUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('payroll/laporangaji', $data);
        $this->load->view('templates/footer');

        $this->_kirimEmail();
    }

    public function cetakGaji()
    {
        $data['title'] = "Laporan Gaji Karyawan";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $tahun . $bulan;
        } else {
            $bulan = date('m', strtotime('+1 month'));
            $tahun = date('Y');
            $bulantahun = $tahun . $bulan;
        }
        $data['cetak_gaji'] = $this->LaporanGaji->cetakGaji($bulantahun);
        $this->load->view('templates/header', $data);
        $this->load->view('payroll/cetakgaji', $data);
    }
}

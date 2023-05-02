<?php

class InputJamKerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('performances/InputJamKerja_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Input JamKerja";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }
        // printr($bulantahun);

        $data['jamkerja'] = $this->db->query("SELECT performances___inputjamkerja.*,
        data_karyawan.nama_karyawan, data_karyawan.id_posisi
        FROM performances___inputjamkerja
        INNER JOIN data_karyawan ON performances___inputjamkerja.nik=data_karyawan.nik
        WHERE performances___inputjamkerja.tanggal='$bulantahun'
        ORDER BY data_karyawan.nama_karyawan ASC")->result_array();


        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        // printr($data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/input_jamkerja', $data);
        $this->load->view('templates/footer');
    }

    public function save_jam_kerja()
    {
        $data = array(
            'nik' => $this->input->post('nik_nama'),
            'total_kerja' => $this->input->post('total_kerja'),
            'due_date' => $this->input->post('due_date'),
            'complate_date' => $this->input->post('complate_date'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->PenilaianKinerja_model->save_jam_kerja($data);
        redirect('performances/input_jamkerja');
    }

    private function nik_sudah_digunakan_by_month($nik)
    {
        $currentDate = date("m/Y");
        $query = $this->db->query("SELECT pk.nik FROM performances___inputjamkerja pk WHERE 
        pk.nik = '$nik' AND pk.tanggal = '$currentDate' ")->result_array();
        if (count($query) > 0) {
            return true;
        }
        return false;
    }

    public function Tambahjamkerja()
    {
        $nik = $this->input->post("nik_nama");
        $data['title'] = "Input Jam Kerja";
        $data['jamkerja'] = $this->PenilaianKinerja_model->tambahjamkerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'NIK', 'required', [
            'required' => 'NIK harus diisi !',
        ]);
        $this->form_validation->set_rules('total_kerja', 'Total Kerja', 'required', [
            'required' => 'Total Kerja harus diisi !'
        ]);
        $this->form_validation->set_rules('due_date', 'Due Date', 'required', [
            'required' => 'Due Date harus diisi !'
        ]);
        $this->form_validation->set_rules('complate_Date', 'Complate Date', 'required', [
            'required' => 'Complate Date harus diisi !'
        ]);
        $nik_digunakan = $this->nik_sudah_digunakan_by_month($nik);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('performances/input_jamkerja', $data);
            $this->load->view('templates/footer');
        } else {
            if ($nik_digunakan) {
                $this->session->set_flashdata('error', 'NIK telah digunakan');
                redirect('performances/InputJamKerja');
                return;
            }

            $this->PenilaianKinerja_model->Tambahjamkerja();

            $this->session->set_flashdata('message', ' Data berhasil ditambahkan!');
            redirect('performances/InputJamKerja');
        }
    }

    public function ajax_category()
    {
        $nik = $_GET["nik"];
        if (!$nik)
            return json_encode([]);
        $category = $this->db->query("SELECT
            data_posisi.nama_posisi
            FROM data_karyawan 
                INNER JOIN data_posisi ON data_posisi.id_posisi = data_karyawan.id_posisi 
                    WHERE data_karyawan.nik = '$nik'");
        print_r(json_encode($category->row()));
    }
}
?>
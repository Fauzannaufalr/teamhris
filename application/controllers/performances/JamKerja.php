<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;



class JamKerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('performances/JamKerja_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('DataKaryawan_model');
        $this->load->model('Hris_model');

        if (!$this->session->userdata('nik')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "JamKerja";

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
        $this->load->view('performances/jamkerja', $data);
        $this->load->view('templates/footer');
    }



    public function import()
    {
        $data['title'] = "Jam Kerja";
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['jamkerja'] = $this->JamKerja_model->Tampiljamkerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/jamkerja', $data);
        $this->load->view('templates/footer');

        $config['allowed_types'] = 'xlsx|xls';
        $config['upload_path'] = './dist/import';
        $config['file_name'] = 'doc' . time();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('import')) {
            $file = $this->upload->data();

            $reader = ReaderEntityFactory::createReaderFromFile('./dist/import/' . $file['file_name']);
            $reader->open('./dist/import/' . $file['file_name']);

            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {
                        if (!empty($row->getCellAtIndex(1)->getValue())) {
                            $due_date = $row->getCellAtIndex(3)->getValue();
                            if (!empty($due_date)) {
                                $due_date = date('Y-m-d', strtotime("1899-12-30 + " . intval($due_date) . " days"));
                            }

                            $complete_date = $row->getCellAtIndex(4)->getValue();
                            if (!empty($complete_date)) {
                                $complete_date = date('Y-m-d', strtotime("1899-12-30 + " . intval($complete_date) . " days"));
                            }

                            $data = array(
                                'nik' => htmlspecialchars($row->getCellAtIndex(1)->getValue()),
                                'tanggal' => htmlspecialchars($row->getCellAtIndex(2)->getValue()),
                                'due_date' => $due_date,
                                'complete_date' => $complete_date,
                                'keterangan' => $row->getCellAtIndex(5)->getValue(),
                            );
                        }
                    }
                    $numRow++;
                }
            }

            $reader->close();
            unlink('./dist/import/' . $file['file_name']);
            $this->session->set_flashdata('message', ' Data berhasil diimport!');
            redirect('performances/JamKerja');
        }
    }



    public function tambah()
    {
        $data['title'] = "Jam Kerja";
        $data['jamkerja'] = $this->JamKerja_model->Tampiljamkerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();


        $this->form_validation->set_rules('total_kerja', 'Total Kerja', 'required', [
            'required' => 'Total Kerja harus diisi !'
        ]);


        // $nik_digunakan = $this->nik_sudah_digunakan_by_month($nik);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('performances/jamkerja', $data);
            $this->load->view('templates/footer');
        } else {
            $this->JamKerja_model->tambah();

            $this->session->set_flashdata('message', ' Data berhasil ditambahkan!');
            redirect('performances/JamKerja');
        }
    }
    public function ubah()
    {

        $data['title'] = "Jam Kerja";
        $data['jamkerja'] = $this->JamKerja_model->Tampiljamkerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();


        $this->form_validation->set_rules('total_kerja', 'Total Kerja', 'required', [
            'required' => 'Total Kerja harus diisi !'
        ]);


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('performances/jamkerja', $data);
            $this->load->view('templates/footer');
        } else {
            $this->JamKerja_model->ubah();
            $this->session->set_flashdata('message', 'Data berhasil diUbah!');
            redirect('performances/JamKerja');
        }
    }
    public function hapus($id)
    {
        if ($this->JamKerja_model->hapus($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('performances/JamKerja');
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
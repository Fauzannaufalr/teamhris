<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class PenilaianKinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dompdf_gen');
        $this->load->model('performances/PenilaianKinerja_model');
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
        $data['title'] = "Penilaian Kinerja";
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

        $data['penilaiankinerja'] = $this->db->query("SELECT performances___penilaian_kinerja.*,
        data_karyawan.nama_karyawan, data_karyawan.id_posisi
        FROM performances___penilaian_kinerja
        INNER JOIN data_karyawan ON performances___penilaian_kinerja.nik=data_karyawan.nik
        WHERE performances___penilaian_kinerja.tanggal='$bulantahun'
        ORDER BY data_karyawan.nama_karyawan ASC")->result_array();



        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        // printr($data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('performances/penilaiankinerja', $data);
        $this->load->view('templates/footer');
    }



    private function nik_sudah_digunakan_by_month($nik)
    {
        $currentDate = date("m/Y");
        $query = $this->db->query("SELECT pk.nik FROM performances___penilaian_kinerja pk WHERE 
        pk.nik = '$nik' AND pk.tanggal = '$currentDate' ")->result_array();
        if (count($query) > 0) {
            return true;
        }
        return false;
    }

    public function tambah()
    {
        $nik = $this->input->post("nik_nama");
        $data['title'] = "Penilaian Kinerja";
        $data['penilaiankinerja'] = $this->PenilaianKinerja_model->tampilPenilaianKinerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'NIK', 'required', [
            'required' => 'NIK harus diisi !',
        ]);
        $this->form_validation->set_rules('total_kerja', 'Total Kerja', 'required', [
            'required' => 'Total Kerja harus diisi !'
        ]);
        $this->form_validation->set_rules('done_kerja', 'Done Kerja', 'required', [
            'required' => 'Done Kerja harus diisi !'
        ]);
        $nik_digunakan = $this->nik_sudah_digunakan_by_month($nik);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('performances/penilaiankinerja', $data);
            $this->load->view('templates/footer');
        } else {
            if ($nik_digunakan) {
                $this->session->set_flashdata('error', 'NIK telah digunakan');
                redirect('Performances/PenilaianKinerja');
                return;
            }

            $this->PenilaianKinerja_model->tambahPenilaianKinerja();

            $this->session->set_flashdata('message', ' Data berhasil ditambahkan!');
            redirect('performances/PenilaianKinerja');
        }
    }
    public function ubah()
    {

        $data['title'] = "Penilaian Kinerja";
        $data['penilaiankinerja'] = $this->PenilaianKinerja_model->tampilPenilaianKinerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'NIK', 'required', [
            'required' => 'Total Kerja harus diisi !'
        ]);

        $this->form_validation->set_rules('total_kerja', 'Total Kerja', 'required', [
            'required' => 'Total Kerja harus diisi !'
        ]);
        $this->form_validation->set_rules('done_kerja', 'Done Kerja', 'required', [
            'required' => 'Done Kerja harus diisi !'
        ]);


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('performances/penilaiankinerja', $data);
            $this->load->view('templates/footer');
        } else {
            $this->PenilaianKinerja_model->ubahPenilaianKinerja();
            $this->session->set_flashdata('message', 'Data berhasil diUbah!');
            redirect('Performances/PenilaianKinerja');
        }
    }


    public function hapus($id)
    {
        if ($this->PenilaianKinerja_model->hapus($id)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus');
        }
        redirect('Performances/PenilaianKinerja');
    }


    public function cetakKinerja()
    {
        $data['title'] = "Penilaian Kinerja";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }

        $data['cetak_kinerja'] = $this->PenilaianKinerja_model->cetakKinerja($bulantahun);
        // printr($data['cetak_kinerja']);
        $this->load->view('templates/header', $data);
        $this->load->view('performances/cetak_kinerja', $data);

    }

    public function cetakExcel()
    {
        $data['title'] = "Penilaian Kinerja";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . "/" . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . "/" . $tahun;
        }
        $data['cetak_kinerja'] = $this->PenilaianKinerja_model->cetakKinerja($bulantahun);
        $this->load->view('performances/cetak_excel_kinerja', $data);
    }

    // function import()
    // {
    //     $data['title'] = "Penilaian Kinerja";
    //     $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
    //     $data['penilaiankinerja'] = $this->PenilaianKinerja_model->tampilPenilaianKinerja();
    //     $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
    //     $data['user'] = $this->Hris_model->ambilUser();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/navbar', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('performances/penilaiankinerja', $data);
    //     $this->load->view('templates/footer');

    //     $config['allowed_types'] = 'xlsx|xls';
    //     $config['upload_path'] = './dist/import';
    //     $config['file_name'] = 'doc' . time();

    //     $this->load->library('upload', $config);

    //     if ($this->upload->do_upload('import')) {
    //         $file = $this->upload->data();
    //         $reader = ReaderEntityFactory::createXLSXReader();

    //         $reader->open('./dist/import/' . $file['file_name']);
    //         foreach ($reader->getSheetIterator() as $sheet) {
    //             $numRow = 1;
    //             foreach ($sheet->getRowIterator() as $row) {
    //                 if ($numRow > 1) {
    //                     $data = array(
    //                         'nik' => htmlspecialchars($row->getCellAtIndex(1)),
    //                         'tanggal' => htmlspecialchars($row->getCellAtIndex(2)),
    //                         'total_kerja' => htmlspecialchars($row->getCellAtIndex(3)),
    //                         'done_kerja' => htmlspecialchars($row->getCellAtIndex(4)),
    //                         'nilai' => $row->getCellAtIndex(5),
    //                         'kategorisasi' => htmlspecialchars($row->getCellAtIndex(6)),
    //                     );

    //                     // cek apakah data dengan nik, tanggal, dan nilai yang sama sudah ada di database
    //                     $isDataExist = $this->PenilaianKinerja_model->checkPenilaianKinerjaExists(
    //                         $data['nik'],
    //                         date('m', strtotime($data['tanggal'])),
    //                         date('Y', strtotime($data['tanggal'])),
    //                         $data['nilai']
    //                     );

    //                     if (!$isDataExist) {
    //                         // jika data belum ada di database, maka insert data
    //                         $this->PenilaianKinerja_model->import_data($data);
    //                     }
    //                 }

    //                 $numRow++;
    //             }
    //         }

    //         $reader->close();
    //         unlink('./dist/import/' . $file['file_name']);
    //         $this->session->set_flashdata('message', ' Data berhasil diimport!');
    //         redirect('performances/PenilaianKinerja');
    //     }
    // }

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
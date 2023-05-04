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


    public function save_jam_kerja()
    {
        $data = array(
            'nik' => $this->input->post('nik_nama'),
            'total_kerja' => $this->input->post('total_kerja'),
            'tanggal' => $this->input->post('tanggal'),
            'due_date' => $this->input->post('due_date'),
            'complate_date' => $this->input->post('complate_date'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->PenilaianKinerja_model->save_jam_kerja($data);
        redirect('performances/JamKerja');
    }

    function import()
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
            $reader = ReaderEntityFactory::createXLSXReader();

            $reader->open('./dist/import/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {
                        $data = array(
                            'nik' => htmlspecialchars($row->getCellAtIndex(1)),
                            'due_date' => htmlspecialchars($row->getCellAtIndex(2)),
                            'complate_date' => htmlspecialchars($row->getCellAtIndex(3)),
                            'keterangan' => $row->getCellAtIndex(4),
                        );
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
    // private function nik_sudah_digunakan_by_month($nik)
    // {
    //     $currentDate = date("m/Y");
    //     $query = $this->db->query("SELECT pk.nik FROM performances___inputjamkerja pk WHERE 
    //     pk.nik = '$nik' AND pk.tanggal = '$currentDate' ")->result_array();
    //     if (count($query) > 0) {
    //         return true;
    //     }
    //     return false;
    // }
    // function import()
    // {
    //     $data['title'] = "Penilaian Kinerja";
    //     $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
    //     $data['jamkerja'] = $this->JamKerja_model->Tampiljamkerja();
    //     $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
    //     $data['user'] = $this->Hris_model->ambilUser();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/navbar', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('performances/jamkerja', $data);
    //     $this->load->view('templates/footer');

    //     $config['allowed_types'] = 'xlsx|xls';
    //     $config['upload_path'] = './dist/import';
    //     $config['file_name'] = 'doc' . time();

    //     $this->load->library('upload', $config);

    //     if ($this->upload->do_upload('import')) {
    //         $file = $this->upload->data();
    //         $reader = ReaderEntityFactory::createXLSXReader();
    //         $reader->open('./dist/import/' . $file['file_name']);
    //         $worksheet = $reader->getSheetIterator()->current();
    //         $highestRow = $worksheet->getHighestRow();

    //         for ($row = 2; $row <= $highestRow; $row++) {
    //             $nik = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
    //             $due_date = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
    //             $complate_date = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
    //             $keterangan = "";

    //             if (!empty($complate_date) && !empty($due_date)) {
    //                 if ($complate_date <= $due_date) {
    //                     $keterangan = "Tepat Waktu";
    //                 } else {
    //                     $keterangan = "Terlambat";
    //                 }
    //             } else {
    //                 $keterangan = "Tidak Diisi";
    //             }

    //             $data[] = array(
    //                 'nik' => $nik,
    //                 'due_date' => $due_date,
    //                 'complate_date' => $complate_date,
    //                 'keterangan' => $keterangan
    //             );
    //         }

    //         $reader->close();
    //         unlink('./dist/import/' . $file['file_name']);
    //         $this->JamKerja_model->insert_data($data);
    //         $this->session->set_flashdata('message', ' Data berhasil diimport!');
    //         redirect('performances/JamKerja');
    //     }
    // }

    public function tambah()
    {
        $data['title'] = "Jam Kerja";
        $data['jamkerja'] = $this->JamKerja_model->Tampiljamkerja();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['datakaryawan'] = $this->DataKaryawan_model->getAllDataKaryawan();
        $data['user'] = $this->Hris_model->ambilUser();

        $this->form_validation->set_rules('nik_nama', 'NIK', 'required', [
            'required' => 'NIK harus diisi !',
        ]);
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

        $this->form_validation->set_rules('nik_nama', 'NIK', 'required', [
            'required' => 'NIK harus diisi !',
        ]);
        $this->form_validation->set_rules('total_kerja', 'Total Kerja', 'required', [
            'required' => 'Total Kerja harus diisi !'
        ]);
        $this->form_validation->set_rules('due_date', 'Due Date', 'required', [
            'required' => 'Due Date harus diisi !'
        ]);
        $this->form_validation->set_rules('complate_date', 'Complate Date', 'required', [
            'required' => 'Complate Date Kerja harus diisi !'
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
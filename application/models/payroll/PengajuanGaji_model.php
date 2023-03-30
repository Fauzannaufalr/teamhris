<?php

class PengajuanGaji_model extends CI_Model
{
    public function tampilPengajuan()
    {
        $this->db->select('lg.*, dk.nama_karyawan, dk.nik, dk.email');
        $this->db->from('payroll___pengajuangaji lg');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = lg.id_datakaryawan');
        $this->db->order_by('dk.nik', 'asc');
        return  $this->db->get()->result_array();
    }

    public function ambilKaryawanById($id)
    {
        $this->db->select('lg.*, dk.nama_karyawan, dk.nik, dk.email');
        $this->db->from('payroll___pengajuangaji lg');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = lg.id_datakaryawan');
        $this->db->where('id', $id);
        return  $this->db->get()->result_array();
    }

    public function generate()
    {
        $date = date("Y") . date("m", strtotime('+1 month'));
        $this->db->where('status', 'Belum dibayar');
        $this->db->delete('payroll___pengajuangaji');
        $this->db->affected_rows();

        $this->db->select($date . ' as bulan_tahun, dk.id_karyawan, dp.nama_posisi, dk.gajipokok, pp.id_datapajak as pajak, pg.t_kinerja, pg.t_fungsional, pg.t_jabatan, pg.t_bpjs, pg.potongan, pg.bonus');
        $this->db->from('data_karyawan dk ');
        // $this->db->join('payroll___bpjs pb', 'pb.id_datakaryawan = dk.id_karyawan', 'left');
        $this->db->join('payroll___pajak pp', 'pp.id_datakaryawan = dk.id_karyawan', 'left');
        $this->db->join('data_posisi dp', 'dp.id_posisi = dk.id_posisi', 'left');
        $this->db->join('payroll___perhitungan pg', 'pg.id_datakaryawan = dk.id_karyawan', 'left');
        $this->db->where('dk.status !=', 'Tidak Aktif');
        $this->db->where('dk.id_karyawan NOT IN (SELECT id_datakaryawan FROM payroll___pengajuangaji WHERE bulan_tahun =' . $date . ' AND status = "Sudah dibayar")');
        $nextGaji = $this->db->get()->result_array();
        foreach ($nextGaji as $ng) {
            $data = [
                'bulan_tahun' => $ng['bulan_tahun'],
                'id_datakaryawan' => $ng['id_karyawan'],
                'nama_posisi' => $ng['nama_posisi'],
                'gajipokok' => $ng['gajipokok'],
                'pajak' => $ng['pajak'],
                't_kinerja' => $ng['t_kinerja'],
                't_fungsional' => $ng['t_fungsional'],
                't_jabatan' => $ng['t_jabatan'],
                't_bpjs' => $ng['t_bpjs'],
                'potongan' => $ng['potongan'],
                'bonus' => $ng['bonus'],
                'total' => $ng['gajipokok'] + $ng['t_bpjs'] - $ng['pajak'] + $ng['t_kinerja'] + $ng['t_fungsional'] + $ng['t_jabatan'] - $ng['potongan'] + $ng['bonus'],
                'status' => 'Belum dibayar'
            ];
            $this->db->insert('payroll___pengajuangaji', $data);
        }
    }

    public function statusBayar($id)
    {
        $data = [
            'status' => 'Sudah dibayar'
        ];

        $this->db->where('id', $id);
        $this->db->update('payroll___pengajuangaji', $data);
    }

    public function cetakGaji($bulantahun)
    {
        $this->db->select('lg.*, dk.nama_karyawan, dk.nik, dk.email');
        $this->db->from('payroll___pengajuangaji lg');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = lg.id_datakaryawan');
        $this->db->where('bulan_tahun', $bulantahun);
        $this->db->order_by('lg.id_datakaryawan', 'asc');
        return  $this->db->get()->result_array();
    }

    function dataTable($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        $searchBulan = $postData['searchBulan'];
        $searchBulanTahun = $postData['searchTahun'] . $searchBulan;

        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = " (nama_karyawan like '%" . $searchValue . "%' or 
            nama_posisi like '%" . $searchValue . "%' or 
            nik like'%" . $searchValue . "%' ) ";
        }
        if ($searchBulanTahun != '') {
            $search_arr[] = " bulan_tahun='" . $searchBulanTahun . "' ";
        }
        // if ($searchGender != '') {
        //     $search_arr[] = " ='" . $searchGender . "' ";
        // }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        // $this->db->select('lg.*, dk.nama_karyawan, dk.nik, dk.email');
        $this->db->from('payroll___pengajuangaji lg');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = lg.id_datakaryawan');
        // $records = $this->db->get('payroll___pengajuangaji')->result();
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('payroll___pengajuangaji lg');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = lg.id_datakaryawan');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('lg.*, dk.nama_karyawan, dk.nik, dk.email');
        $this->db->from('payroll___pengajuangaji lg');
        $this->db->join('data_karyawan dk', 'dk.id_karyawan = lg.id_datakaryawan');
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
            $this->db->order_by('dk.nik', 'asc');
        }
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();
        $no = 1;
        foreach ($records as $record) {

            $data[] = array(
                "no" => $no++,
                "nik_nama" => $record->nik . ' - ' . $record->nama_karyawan,
                "posisi" => $record->nama_posisi,
                "gaji" => 'Rp ' . number_format($record->gajipokok, 0, ', ', '.'),
                // "bpjs" => 'Rp ' . number_format($record->bpjs, 0, ', ', '.'),
                "pajak" => 'Rp ' . number_format($record->pajak, 0, ', ', '.'),
                "kinerja" => 'Rp ' . number_format($record->t_kinerja, 0, ', ', '.'),
                "fungsional" => 'Rp ' . number_format($record->t_fungsional, 0, ', ', '.'),
                "jabatan" => 'Rp ' . number_format($record->t_jabatan, 0, ', ', '.'),
                "bpjs" => 'Rp ' . number_format($record->t_bpjs, 0, ', ', '.'),
                "potongan" => 'Rp ' . number_format($record->potongan, 0, ', ', '.'),
                "bonus" => 'Rp ' . number_format($record->bonus, 0, ', ', '.'),
                "total" => 'Rp ' . number_format($record->total, 0, ', ', '.'),
                "status" => $record->status,
                "aksi" => '<button class="badge" style="background-color: #fbff39;" data-toggle="modal" data-target="#modal-sm' . $record->id . '"><i class="fas fa-check-circle"></i> Status Bayar</button>
                <button class="badge badge-success" data-toggle="modal" data-target="#kirimSlipModal' . $record->id . '"><i class="fas fa-paper-plane"></i> Kirim Slip Gaji</button>',
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

    public function laporan()
    {
        $this->db->select("(SELECT SUM(total) FROM `payroll___pengajuangaji` WHERE bulan_tahun = '202304' AND status = 'Sudah dibayar') AS Sudah
        ,
        (SELECT SUM(total) FROM `payroll___pengajuangaji` WHERE bulan_tahun = '202304' AND status = 'Belum dibayar') AS Belum");
        // $this->db->from('payroll___pengajuangaji');
        return  $this->db->get()->result_array();
    }
}

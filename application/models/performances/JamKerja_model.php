<?php

class JamKerja_model extends CI_Model
{
    public function Tampiljamkerja()
    { //model ini akan di tampilkan pada penilaian kinerja
        $this->db->select('data_karyawan.*, 
            performances___inputjamkerja.id_jamkerja,
            performances___inputjamkerja.nik,
            performances___inputjamkerja.tanggal,
            performances___inputjamkerja.total_kerja,
            performances___inputjamkerja.due_date,
            performances___inputjamkerja.complete_date,
            performances___inputjamkerja.keterangan,
            (SELECT 
                data_posisi.nama_posisi 
                    FROM data_posisi
                        WHERE data_posisi.id_posisi = data_karyawan.id_posisi) AS nama_posisi
        ');
        $this->db->from('performances___inputjamkerja');
        $this->db->join('data_karyawan', 'data_karyawan.nik = performances___inputjamkerja.nik');
        return $this->db->get()->result_array();
    }


    public function import_data($data)
    {
        $query = $this->db->get('
        performances___inputjamkerja');
        if ($query->num_rows() > 0) {
            // Jika data sudah ada, maka lakukan update data
            $this->db->where('nik', $data['nik']);
            $this->db->update('performances___inputjamkerja', $data);
        } else {
            // Jika data belum ada, maka lakukan insert data
            $this->db->insert('performances___inputjamkerja', $data);
        }
    }

    public function tambah()
    {
        $done_kerja = $this->input->post('done_kerja');
        $total_kerja = $this->input->post('total_kerja');
        $complate_date = $this->input->post('complete_date');
        $due_date = $this->input->post('due_date');

        if (!$complate_date || !$due_date) { // jika salah satu tanggal tidak diisi
            $keterangan = "Tidak Diisi";
        } else if ($complate_date <= $due_date) { // jika tanggal selesai kurang dari atau sama dengan tanggal jatuh tempo
            $keterangan = "Tepat Waktu";
        } else { // jika tanggal selesai lebih besar dari tanggal jatuh tempo
            $keterangan = "Terlambat";
        }

        echo "Keterangan: " . $keterangan;
        $data = [
            "nik" => $this->input->post("nik_nama"),
            'tanggal' => date("m/Y"),
            'total_kerja' => $total_kerja,
            'due_date' => $due_date,
            "complate_date" => $complate_date,
            "keterangan" => $keterangan,

        ];
        $this->db->insert('performances___inputjamkerja', $data);
    }

    public function ubah()
    {
        $total_kerja = $this->input->post('total_kerja');
        $complate_date = $this->input->post('complate_date');
        $due_date = $this->input->post('due_date');

        if (!$complate_date || !$due_date) { // if either date is not filled
            $keterangan = "Tidak diisi";
        } else if ($complate_date && $due_date) { // if both dates are filled
            $tanggal = $complate_date - $due_date;

            if ($tanggal <= 0) {
                $keterangan = "Tepat Waktu";
            } else {
                $keterangan = "Terlambat";
            }
        }

        echo "Keterangan: " . $keterangan;
        $data = [
            "nik" => $this->input->post("nik_nama"),
            'tanggal' => date("m/Y"),
            'total_kerja' => $total_kerja,
            'due_date' => $due_date,
            "complate_date" => $complate_date,
            "keterangan" => $keterangan,
        ];
        $this->db->insert('performances___inputjamkerja', $data);
    }
    public function hapus($id_jamkerja)
    {
        $this->db->where('id_jamkerja', $id_jamkerja);
        $this->db->delete('performances___inputjamkerja');
        return ($this->db->affected_rows() > 0) ? true : false;
    }


}
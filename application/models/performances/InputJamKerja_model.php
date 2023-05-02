<!-- 
public function save_jam_kerja($data = array())
    {
        $this->db->insert('performances___inputjamkerja', $data);
    }
    <?php

    class InputJamKerja_model extends CI_Model
    {
        public function Tampiljamkerja()
        { //model ini akan di tampilkan pada penilaian kinerja
            $this->db->select('data_karyawan.*, 
            performances___inputjamkerja.id_inputjamkerja,
            performances___inputjamkerja.nik,
            performances___inputjamkerja.tanggal,
            performances___inputjamkerja.total_kerja,
            performances___inputjamkerja.due_date,
            performances___inputjamkerja.complate_date,
            performances___inputjamkerja.keterangan,
            (SELECT 
                data_posisi.nama_posisi 
                    FROM data_posisi
                        WHERE data_posisi.id_posisi = data_karyawan.id_posisi) AS nama_posisi
        ');
            $this->db->from('performances___inputjamkerja');
            $this->db->join('data_karyawan', 'data_karyawan.nik = performances___performances___inputjamkerja.nik');
            return $this->db->get()->result_array();
        }
        public function tambahjamkerja()
        {
            $total_kerja = $this->input->post('total_kerja');
            $complate_date = $this->input->post('complate_date');
            $due_date = $this->input->post('due_Date');

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
                "complate_Date" => $complate_date,
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
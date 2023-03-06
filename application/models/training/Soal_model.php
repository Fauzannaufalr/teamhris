<?php
class Soal_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_soal() {
        // mengambil data soal dari database
        $query = $this->db->get('tb_soal');
        return $query->result();
    }
    
    public function insert_jawaban($data) {
        // menyimpan data jawaban ke database
        $this->db->insert('tb_jawaban', $data);
        return true;
    }
    public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}
}

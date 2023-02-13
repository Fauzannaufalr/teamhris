<?php

class DataKaryawan_model extends CI_Model
{
    public function getAllDataKaryawan()
    {
        return $this->db->get('data_karyawan')->result_array();
    }
    public function add_datakaryawan($datakaryawan)
    {
        $data=array('nik'=>$datakaryawan['nik'], 'nama_karyawan'=>$datakaryawan['nama_karyawan'], 'posisi'=>$datakaryawan['posisi'], 'email'=>$datakaryawan['email'],
        'gajipokok'=>$datakaryawan['gajipokok'], 'status'=>$datakaryawan['status'], 'level'=>$datakaryawan['level'],'foto'=>$datakaryawan['foto']);
        $this->db->insert('data_karyawan', $data);
    }
     public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('data_karyawan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
?>
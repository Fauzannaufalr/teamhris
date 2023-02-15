<?php 
class Survey_model extends CI_Model {
    public function save_survey($data) {
      return $this->db->insert('surveys', $data);
    }
  }
  
?>
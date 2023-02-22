<!-- penilaian HC -->
<?php 
  if($this->session->userdata('level') === 'hc'){ 
    $this->load->view('performances/menilai_dirisendiri');
    $this->load->view('performances/menilai_rekan1');
    $this->load->view('performances/menilai_rekan2');

} ?>
<!-- penilaian leader -->
<?php 
  if($this->session->userdata('level') === 'leader'){ 
    $this->load->view('performances/menilai_dirisendiri');
    $this->load->view('performances/menilai_rekan1');
    $this->load->view('performances/menilai_rekan2');
} ?>

<!-- penilaian karyawan biasa -->
<?php 
  if($this->session->userdata('level') === 'biasa'){ 
    $this->load->view('performances/menilai_dirisendiri');
    $this->load->view('performances/menilai_leader');
    $this->load->view('performances/menilai_rekan1');
    $this->load->view('performances/menilai_rekan2');
} ?>


?>
<!-- Penilaian CEO -->
<?php 
  if($this->session->userdata('level') === 'ceo'){ 
    $this->load->view('performances/menilaidirisendiri');
    $this->load->view('performances/menilairekan1');
    $this->load->view('performances/menilairekan2');
} ?>


<!-- penilaian HC -->
<?php 
  if($this->session->userdata('level') === 'hc'){ 
    $this->load->view('performances/menilaidirisendiri');
    $this->load->view('performances/menilairekan1');
    $this->load->view('performances/menilairekan2');
    // menilai leader tidak ada
} ?>
<!-- penilaian leader -->
<?php 
  if($this->session->userdata('level') === 'leader'){ 
    $this->load->view('performances/menilaidirisendiri');
    $this->load->view('performances/menilairekan1');
    $this->load->view('performances/menilairekan2');
} ?>

<!-- penilaian karyawan biasa -->
<?php 
  if($this->session->userdata('level') === 'biasa'){ 
    $this->load->view('performances/menilaidirisendiri');
    $this->load->view('performances/menilaileader');
    $this->load->view('performances/menilairekan1');
    $this->load->view('performances/menilairekan2');
} ?>



?>
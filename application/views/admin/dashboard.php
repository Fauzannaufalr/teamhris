<!-- ngeload berdasarkan level -->
<!-- level hc -->
<?php 
  if($this->session->userdata('level') === 'hc'){ 
    $this->load->view('admin/dashboard_hc');

} ?>
<!-- level karyawan -->
<?php 
  if($this->session->userdata('level') === 'biasa'){ 
    $this->load->view('admin/dashboard_karyawan');

} ?>

<?php

if($this->session->userdata('level') === 'leader'){
  $this->load->view('admin/dashboard_leader');
} ?>
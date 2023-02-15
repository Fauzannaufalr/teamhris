<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menilaidirisendiri extends CI_Controller
{
    public function save()
    {
      $data = array(
        'question1' => $this->input->post('question1'),
        'question2' => $this->input->post('question2')
      );
    
      // Simpan data ke database atau lakukan aksi lainnya
    
      redirect('menilaidirisendiri/thankyou'); // Redirect ke halaman terima kasih setelah form disimpan
    }
  }

?>

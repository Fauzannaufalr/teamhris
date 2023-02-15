<?php 
class Survey extends CI_Controller {
    public function index() {
      $this->load->view('survey_form');
    }
  
    public function save_survey() {
      $data = array(
        'question1' => $this->input->post('question1'),
        'question2' => $this->input->post('question2')
      );
  
      $this->load->model('Survey_model');
      $this->Survey_model->save_survey($data);
  
      redirect('survey/thankyou');
    }
  
    public function thankyou() {
      $this->load->view('survey_thankyou');
    }
  }
  


?>
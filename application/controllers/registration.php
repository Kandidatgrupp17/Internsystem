<?php

class Registration extends CI_Controller
{
  function index()
  {
      $this->load->view('registration_view');
  }
  function is_valid_mail($email)
  {
      $array = explode('@',$email);
      if($array['1'] == 'student.chalmers.se' AND $array['0'] !== '')
      {
            return TRUE;
      }
      return FALSE;
      
  }
  function insert()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('Email', 'Email', 'required');
	$this->form_validation->set_rules('password', 'Password', 'required');
	$this->form_validation->set_rules('passwordconfirm', 'Passwordconfirm', 'required');
    if($this->form_validation->run())
    {
    if($this->input->post('passwordconfirm') == $this->input->post('password') 
        &&  $this->is_valid_mail($this->input->post('Email')))
    {
    $input = array( 'Email' => $this->input->post('Email'), 'Password' =>  $this->input->post('password'));
    $this->load->model('user_model','',TRUE);   
    $this->user_model->insert_to_db($input);  
    }
    $this->load->view('login_view');
   }
   else
   {
       $this->load->view('registration_view');
    }
}
}
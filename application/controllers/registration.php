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
      if($array['1'] == 'student.chalmers.se')
      {
            return TRUE;
      }
      return FALSE;
      
  }
  function insert()
  {
    if($this->input->post('passwordconfirm') == $this->input->post('password') 
                                        &&  $this->is_valid_mail($this->input->post('email')))
    {
    //Behöver validera email
    $input = array('name' => $this->input->post('username'),
                            'password' =>  $this->input->post('password'),
                            'email' => $this->input->post('email'));
    
    //$this->load->library('form_validation');
    //Sätt upp regler!
	//if ($this->form_validation->run() == FALSE)
	//{
			//$this->load->view('login_view');
	//}
	//else
	//{
        $this->load->model('registration_model','',TRUE);   
        $this->registration_model->insert_to_db($input);  
	//}
    }
        $this->load->view('login_view');
   }
}
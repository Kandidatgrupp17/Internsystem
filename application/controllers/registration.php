<?php

class Registration extends CI_Controller
{
  function __construct()
  {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
   }

  function index()
  {
      $this->load->view('registration_view');
  }
  /*
    Valideringsfunktion för att se om mailen är på rätt form.
    Det bör läggas till en mail-tjänst för bekräftelsebrev. 
    Nu kan en ogiltig mail vara användarnamn
    */
  function is_valid_mail($email)
  {
      $array = explode('@',$email);
      if(($array['1'] == 'student.chalmers.se') AND $array['0'] !== '')
      {
            return TRUE;
      }
      return FALSE;
      
  }
  
  /*
    Insert - Lägger till användaren i databasens tabell users
    Email = Username, kan vara förvirrande. Kolla upp det!
    */
  function insert()
  {
    $this->form_validation->set_rules('Email', 'Email', 'required');
	$this->form_validation->set_rules('password', 'Password', 'required');
	$this->form_validation->set_rules('passwordconfirm', 'Passwordconfirm', 'required');
    if($this->form_validation->run())
    {
    if($this->input->post('passwordconfirm') == $this->input->post('password') 
        &&  $this->is_valid_mail($this->input->post('Email')))
    {
    //Här anropas users-klassen!    
    $this->load->model('user_model','',TRUE);   
    $input = array('Email' => $this->input->post('Email'), 'Password' =>  $this->input->post('password'));
    $this->user_model->insert_to_db($input);  
    }
        redirect('login');
   }
   else
   {
        $this->index();
    }
}
}
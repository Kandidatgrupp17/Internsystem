<?php

class Registration extends CI_Controller
{
  function __construct()
  {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
   }

  function index($error)
  {
      $this->load->view('registration_view',$error);
  }
  /*
    Valideringsfunktion för att se om mailen är på rätt form.
    Det bör läggas till en mail-tjänst för bekräftelsebrev. 
    Nu kan en ogiltig mail vara användarnamn
    */
  function is_valid_mail($email)
  {
      $array = explode('@',$email);
      if(($array['1'] == 'student.chalmers.se' || $array['0'] == 'charm.chalmers.se') AND $array['0'] !== '')
      {
            return TRUE;
      }
      return FALSE;
      
  }
  /*
   * Skickar mail till angiven address
   * 
   * */
	function create_activation_mail($email)
  {
  		
		$url = base_url() . "index.php/registration/";
		$to = "ocarlsson3@gmail.com";
		$subject = "Aktivering av användarkonto";	
		// compose headers
		$headers = "From: noreply@oscarlsson.se\r\n";
		// compose message
		$message = "Du har registrerat dig på CHARM's hemsida";
		$message .= "Ytterliggare ett mail kommer när värdansökan öppnar";
		$message .= $url;
		$message = wordwrap($message, 70);	
		// send email
		mail($to, $subject, $message, $headers);    
  }
  
  /*
    *  
    *Insert - Lägger till användaren i databasens tabell users 
    *här borde mailbekräftelsen ligga - timer som håller koll på autogen nr?
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
		    //Bekräftelse mail skickas
			$this->create_activation_mail($email);
	    	//Här anropas users-klassen!
			$this->load->model('user_model','',TRUE);   
		    $input = array('Email' => $this->input->post('Email'), 'Password' =>  $this->input->post('password'));
		    $this->user_model->insert_to_tempdb($input);  
		}
		$this->index("Lösenorden stämmer inte eller inte korrekt mail");
   }
   else
   {
        $this->index();
   }
  }
}
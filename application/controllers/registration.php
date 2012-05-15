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
  	  $input['Sektioner'] = array('D' => 'D', 'F' => 'F','KFKB' => 'KFKB','K' => 'K');
  	  $input['ViewField'] = "registration_view";
      $this->load->view('startpage',$input);
  }
  /*
    Valideringsfunktion för att se om mailen är på rätt form.
    Det bör läggas till en mail-tjänst för bekräftelsebrev. 
    Nu kan en ogiltig mail vara användarnamn
    */
  function is_valid_mail($email)
  {
      $array = explode('@',$email);
      if((($array['1'] == 'student.chalmers.se') OR $array['1'] == 'charm.chalmers.se') AND $array['0'] !== '')
      {
            return TRUE;
      }
      return FALSE;
      
  }
  /*
   * Skickar mail till den regisrerade mailen
   * 
   * 
   * */
  private function __send_mail($email)
  {
		$to = $email;
		$subject = "Aktivering av användarkonto";	
		// compose headers
		$headers = "From: noreply@charm.se\r\n";
		// compose message
		$message = "Du har registrerat dig på CHARM's hemsida";
		$message = wordwrap($message, 70);	
		// send email
		mail($to, $subject, $message, $headers);    
  }
  
  
  /*
    Insert - Lägger till användaren i databasens tabell users
    Email = Username, kan vara förvirrande. Kolla upp det!
    */
  function insert()
  {
    $this->form_validation->set_rules('Email', 'Email', 'required');
	$this->form_validation->set_rules('Password', 'Password', 'required');
	$this->form_validation->set_rules('Passwordconfirm', 'Passwordconfirm', 'required');
    if($this->form_validation->run())
    {
	    if($this->input->post('passwordconfirm') == $this->input->post('password') 
	        &&  $this->is_valid_mail($this->input->post('Email')))
	    {
	    	//Här anropas users-klassen!    
	    	$this->load->model('user_model','',TRUE);   
	    	$input = $this->input->post();
	    	$input['AccessID'] = '2';
	    	$this->user_model->insert_to_db($input);  
	    	//$email($this->input->post('Email'));
	    }
       		redirect('login');
    }
   else
  	{
        $this->index();
  	}
  }
}
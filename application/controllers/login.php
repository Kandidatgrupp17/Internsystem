<?php
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }
    
    /*
     * visar login per automatik
     * */
    function index()
    {
    	$input['ViewField'] = "login_view";
        $this->load->view('startpage',$input);     
    }
    /*
     * Sköter referenser för index sidan
     * skickar användaren till registrering
     * */
    function reg()
    {
    	$input['ViewField'] = "registration_view";
        $this->load->view('startpage',$input);     
    }
    /*
    Kontrollerar att formulären är ifyllda samt anropar
    check_user i user_model. Check_user kontaktar databasen för att kolla upp om
    användaren finns. 

    Om användaren inte finns anropas index, annars skickas användaren till secure_view
    Skriven av: Oscar
    */
    function check()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run())
        {
	        $Username = $this->input->post('username');
	        $Password = $this->input->post('password');
	        /*
	         * Verifierar att användaren finns i databasen
	         * */	
	        $this->load->model('user_model', '',TRUE);
	        $array = array('Email' => $Username, 'Password' => $Password);
	        if($this->user_model->login_check($array))
	        {
	        	//redirect('student/secure');
	        	$access = (Array) $this->user_model->access_level($array);
	        	$access = (Array)$access['0'];
	        if($access['AccessID'] == '2')
	        	{
	        		//var_dump($access['AccessID']);
	        		redirect('student/secure');
	        	}else 
	        	{
	        		redirect('CHARMk/charm_secure');
	        	}
	        	
	        	
	        }else
	       {
	       		$this->index();
	        	//redirect('login');
	        }	        
        }
        else
        {
        	/*
        	 * Formuläret är ifyllt fel. Visar vyn igen för 
        	 * att få med felmeddelande via validator
        	 * */
    	    $this->index();
        	
        	//$this->load->view('login_view');
        }
    }
}
?>
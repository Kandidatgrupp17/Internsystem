<?php
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }
    function index()
    {
        $this->load->view('login_view');     
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
        $username = $this->input->post('username');
        $password = $this->input->post('password');
      
        /*
         * Verifierar att användaren finns i databasen
         * */	
        $this->load->model('user_model', '',TRUE);
        $array = array('Email' => $username, 'Password' => do_hash($password));
        $query = $this->user_model->get_user($array);
        if($query->num_rows() == 1)
        {
        	$input = $query->result_array();
        	$arrayinput = array('UserID' => $input['0']['UserID'],
        						'Email' => $username,
        						'loggedin' => TRUE);
	        $this->session->set_userdata($arrayinput);
	        redirect('student/secure');
        }
        else
        {
        	/*
        	 * Användaren fanns ej tillbaka till login
        	 * */
	        redirect('login');
        }
        }
        else
        {
        	/*
        	 * Formuläret är ifyllt fel. Visar vyn igen för 
        	 * att få med felmeddelande via validator
        	 * */
    	    $this->load->view('login_view');
        }
    }
}



?>
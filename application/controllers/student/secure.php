<?php
class Secure extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->__check();
    }
	/*
	 * Ladda meny-vyn för studenter
	*/   
    function index()
    {
      $this->load->view('student/student_menu',$this->session->all_userdata());
    }
    
    /*
     * Funktion för att plocka ut användardatan för den inloggade
     * ej färdig.
     */
    
    private function __user_data()
    {	
      $this->load->model('user_model');
      $sessiondata = $this->session->all_userdata();
      $array = array('UserID' => $sessiondata['UserID']);
      $querydata = $this->user_model->get_user($array);
      $querydata['password'] = '';
      return $querydata->result_array();
    } 
	/*
	 * Funktionen för att kontrollera att användaren är 
	 * inloggad och ok att titta på systemet.
	*/
    function __check()
    {  
        //Osäkert!
        if($this->session->userdata('loggedin') == '' OR $this->session->userdata('loggedin') == FALSE)
        {
            $this->log_out();
        }
    }
    /*
     * Förstör sessionen och skickar tillbaka användaren till
     * första sidan. Login.
     * 
    */
    function log_out()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
?>

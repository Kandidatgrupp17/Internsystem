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
      $this->load->view('student/student_menu', $this->__user_data());
    }
    /*
     * En användare vill updatera sin information -> Inte vårat jobb!
     * */
    function update()
    {
    	
    
    
    }
    /*
     * Funktion för att plocka ut användardatan för den inloggade. 
     * Grymt fult löst!!!!! ÄNDRA DET HÄR
     */
    
    private function __user_data()
    {	
      $sessiondata = $this->session->all_userdata();
      $this->load->model('user_model');
      $user = $this->user_model->get_user(array('UserID' => $sessiondata['UserID']));
      $user = $user->result_array();
      return $user['0'];
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

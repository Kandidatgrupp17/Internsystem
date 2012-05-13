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
	 * Skickar en bool som bestämmer om Ansökan är öppen eller inte
	*/   
    function index()
    {
      $input = $this->__user_data();
      $input['ViewFile'] = '';
      $this->load->model('hostapp_model');
      $input['ansok'] = $this->hostapp_model->application_open();
      $input['AllInstitute'] = array('D' => 'D', 'F' => 'F','KFKB' => 'KFKB','K' => 'K');
      $this->load->view('student/student_menu',$input);
    }
    
    /*
     * En användare vill updatera sin information -> Inte vårat jobb!
     * */
    function update()
    {	
    	$this->load->model('user_model');
    	$this->user_model->_update_user($this->input->post());
    	$this->index();
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
    function edit_info()
    {
      $input = $this->__user_data();
    	
      $this->load->model('hostapp_model');
      $input['ansok'] = $this->hostapp_model->application_open();    
      $input['ViewFile'] = 'student/student_menu_edit';
      $input['AllInstitute'] = array('D' => 'D', 'F' => 'F','KFKB' => 'KFKB','K' => 'K');
      ;
      $this->load->view('student/student_menu',$input);
    }
    
  function application_view()
  {
  	  $input = $this->__user_data();
  	  
	  $this->load->model('hostapp_model');
      $input['ansok'] = $this->hostapp_model->application_open();      $input['ViewFile'] = 'student/hostapp_view';
      $input['AllInstitute'] = '';
      $this->load->view('student/student_menu',$input);
  }
/*
 * Lägger till en applikation och en assignment
 * */
  function add_application()
  {
    $this->load->model('hostapp_model','',TRUE);
    $this->hostapp_model->insert_to_db($this->input->post());
    $this->load->model('Assignment_model','',TRUE);
    $asinput = array('UserID' => $this->input->post('UserID'), 'status' => 'Vantande', 'host_type' => 'Ej_tilldelad');
    $this->Assignment_model->insert_to_db($asinput);
   	$this->index();
  }  
}
?>

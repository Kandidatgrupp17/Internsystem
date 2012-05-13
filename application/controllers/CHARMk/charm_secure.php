<?php
class Charm_secure extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('table');
        $this->load->helper('form');
        $this->load->helper('string');
        
	}
	function index()
	{
		$input['ViewField'] = '';
		$this->load->view('CHARMk/charm_view',$input);
	}
	function Upload()
	{
        $this->load->model('company_model');
        $input['companies'] = $this->company_model->get_all_companies();
        $input['error'] = null;
        $input['ViewField'] = 'foretag/uploadform_view';
		$this->load->view('CHARMk/charm_view', $input);		
	}
	function Members()
	{
		$this->load->library('table');
		$this->load->model('user_model');
		$input['users'] = $this->user_model->get_alluser(); 
		$input['ViewField'] = 'student/student_view';		
		$this->load->view('CHARMk/charm_view',$input);
		
	}
	function Application()
	{
		/*
		 * Kolla om värdansökan är öppen!
		 * */
		$this->load->model('hostapp_model');
		if($this->hostapp_model->application_open())
		{
			$input['disabled'] = 'disabled';
		}else
		{
			$input['disabled'] = null;
			
		}
		
		$input['ViewField'] = 'CHARMk/hostapp_CHARMkview';
		$this->load->view('CHARMk/charm_view',$input);
		
	}
	function Assignment()
	{
		// get the data from the database
        $this->load->model('assignment_model','',TRUE);
        $this->assignment_model->create_db();
        $applicationdata = $this->assignment_model->get_applications();
        
        // create the table template
        $tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" width="500px">',
			
              );
              
        // set the template
        $this->table->set_template($tmpl); 
        // create the table headings
        $tableheadings = array (
            '&nbsp;','Name','Status','Host',
        );
        // set the table headings
        $this->table->set_heading($tableheadings);

        
        //Hårdkodade värdtyper                    
        $options = array('Ej tilldelad' => 'Ej tilldelad',
                                    'Foretagsvard' => 'Foretagsvard',
                                    'Omradesvard' => 'Omradesvard');
                                    
        $status = array('Vantande' => 'Vantande',
                                  'Antagen' => 'Antagen',
                                  'Ej antagen' => 'Ej antagen',
                                  'Svartlistad' => 'Svartlistad');

	        
        $this->load->model('user_model');
        /*
         * För varje applikation.
         * */
        foreach($applicationdata->result() as $row)
        {
        	//Användarinformation
        	$USER = $this->user_model->get_user(array('UserID' => $row->UserID))->result();
        	$USER = (Array) $USER['0'];
            $name =  $USER['FirstName'] . " " . $USER['LastName'];
            $data['UserID'] = $USER['UserID'];
            $UserIDArray = array('UserID' => $USER['UserID']);
            $assignment_result = $this->assignment_model->get_assignments_result($UserIDArray);
            
            //array_push($name_list,$name);

            /*
             * Input till tabell
             * */
            $input = array('name' => 'check[]',
                                    'value' => $USER['UserID'],
                                    'checked' => FALSE,
                                    );
            $status_nr = 'status_' . $USER['UserID'];
            $host_nr = 'host_' . $USER['UserID'];
            /*
             * 
             * Genererea tabell med användare och rätt val ikryssat
             * */
            if(sizeof($assignment_result) == 1)
            {
                $selected_status = $assignment_result[0]['status'];
                $selected_hosttype = $assignment_result[0]['host_type'];
                $this->table->add_row(form_checkbox($input),
                                                  $name,
                                                  form_dropdown($status_nr, $status, $selected_status),
                                                  form_dropdown($host_nr, $options, $selected_hosttype),
                                                  form_hidden('UserID', $USER['UserID'])
                                                  );
            }
            else
            {
                $this->table->add_row(form_checkbox($input),
                                                  $name,
                                                  form_dropdown($status_nr, $status),
                                                  form_dropdown($host_nr, $options),
                                                  form_hidden('UserID', $USER['UserID'])
                                                  );
            }
            
        }

        // generate the table and put it into a variable
        $data['table'] = $this->table->generate();
        $data['ViewField'] = 'CHARMk/assignment_view';
        $this->load->view('CHARMk/charm_view', $data);
				
	}
	
	/*
	 * 
	 * Genererar en tabell för formuläret och lägger till via rätt modul.
	 * */
	function preview()
	{
		    $questions = $this->input->post('hidden');
		    $categories = $this->input->post('hidden2');
		    $types = $this->input->post('hidden3');
		    $answers = array();
		    $count = 0; //used to ignore the hidden posts
		    $array_list = array();
		    $question_list = array();
		    
		    //Replace all spaces with _
		    foreach($questions as $q)
		    {
		        $temp = str_replace (" ", "_", $q);
		        array_push($question_list, $temp);
		    }
		    //$input = array_combine($question_list,$answers);           
		    $this->load->model('hostapp_model','',TRUE);
		    $this->hostapp_model->create_db($question_list, $categories, $types);
		    $input['disabled'] = 'disabled';
			$input['ViewField'] = 'CHARMk/hostapp_CHARMkview';
		    $this->load->view('CHARMk/charm_view', $input); 
	}
	
	
}

?>
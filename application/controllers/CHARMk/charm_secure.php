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
                    'table_open'          => '<table border="1" cellpadding="4" cellspacing="0">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );
              
        // set the template
        $this->table->set_template($tmpl); 
        // create the table headings
        $tableheadings = array (
            '&nbsp;','Name','Status','Host',
        );
        // set the table headings
        $this->table->set_heading($tableheadings);
                                    
        $options = array('Ej_tilldelad' => 'Ej_tilldelad',
                                    'Foretagsvard' => 'Foretagsvard',
                                    'Omradesvard' => 'Omradesvard');
                                    
        $status = array('Vantande' => 'Vantande',
                                  'Antagen' => 'Antagen',
                                  'Ej_antagen' => 'Ej_antagen',
                                  'Svartlistad' => 'Svartlistad');

        // create the table rows
        $checkbox_nr = increment_string('checkbox');
        $status_nr = increment_string('status');
        $host_nr = increment_string('host');
        $name_list = array();
        $this->load->model('user_model');
        foreach($applicationdata->result() as $row)
        {
        	$USER = $this->user_model->get_user(array('UserID' => $row->UserID))->result();
        	$USER = (Array) $USER['0'];
            $name =  $USER['FirstName'] . " " . $USER['LastName'];
            $data['UserID'] = $USER['UserID'];
            array_push($name_list,$name);
            $getapp = array('UserID' => $USER['UserID']);
            $assignment_result = $this->assignment_model->get_assignments_result($getapp);

            /*
             * Input till tabell
             * */
            $input = array('name' => $checkbox_nr,
                                    'value' => 'Checked',
                                    'checked' => FALSE,
                                    );
            if(sizeof($assignment_result) == 1)
            {
                $selected_status = $assignment_result[0]['status'];
                $selected_hosttype = $assignment_result[0]['host_type'];
                $this->table->add_row(form_checkbox($input),
                                                  $name,
                                                  form_dropdown($status_nr, $status, $selected_status),
                                                  form_dropdown($host_nr, $options, $selected_hosttype)
                                                  );
            }
            else
            {
                $this->table->add_row(form_checkbox($input),
                                                  $name,
                                                  form_dropdown($status_nr, $status),
                                                  form_dropdown($host_nr, $options)
                                                  );
            }
            $checkbox_nr =  increment_string($checkbox_nr);
            $status_nr = increment_string($status_nr);
            $host_nr = increment_string($host_nr);
        }

        // generate the table and put it into a variable
        $data['table'] = $this->table->generate();
        $data['names'] = $name_list;
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
		    
			$input['ViewField'] = 'CHARMk/hostapp_CHARMkview';
		    $this->load->view('CHARMk/charm_view', $input); 
	}
	
	
}

?>
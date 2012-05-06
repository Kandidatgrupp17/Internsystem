<?php
/*
 * Tilldelningscontroller
 * 
 * */
class Assignment extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->library('table');
        $this->load->helper('form');
        $this->load->helper('string');
        
	}
	
    function insert()
    {
        $array = array('status','host_type');
        $prev1 = 'null';
        $prev2 = 'null';
        $prev3 = 'null';
        $answers = array();
        $row = array();
        $names = $this->input->post('name_list');
        $count = 0;
        
        //Get the checked values and their correspond status and host type
        foreach ($_POST as $key => $value)
        {
            if($value == 'Checked')
            {
                $prev1 = 'Checked';
                $username = $names[$count];
                array_push($row,$username);
            }
            //status
            else if($prev1 == 'Checked')
            {
                $prev1 = 'null';
                $prev2 = 'Checked';
                array_push($row,$value);
            }
            //host type
            else if($prev2 == 'Checked')
            {
                $prev2 = 'null';
                array_push($row,$value);
                $input = array_combine($array,$row); 
                array_push($answers,$input);
                array_pop($input);
                array_pop($input);
                array_pop($input);
                array_pop($row);
                array_pop($row);
                array_pop($row);
                $count++;
            }
            else if($prev1 == 'Not_Checked')
            {
                $count++;
                $prev1 = 'null';
            }
            else
            {
                $prev1 = 'Not_Checked';
            }
        }
        $this->load->model('assignment_model','',TRUE);
        $answers['UserID'] =  $this->input->post('UserID');
        $this->assignment_model->insert_to_db($answers);
    	$this->redirect('CHARMk/charm_secure/Assignment');
    }

}
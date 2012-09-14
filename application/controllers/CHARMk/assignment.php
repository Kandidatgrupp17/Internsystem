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
        /*
         * Foreach checked UserID
         * They have: Status_UserID
         * and Host_UserID
         * */
        $this->load->model('assignment_model','',TRUE);
        foreach($this->input->post('check') as $UserID)
        {
        	$input = array('UserID' => $UserID,
        					 'status' => $this->input->post('status_'.$UserID),
        	 				 'host_type' => $this->input->post('host_'.$UserID),
                             'company' => $this->input->post('company'.$UserID));
			$this->assignment_model->update_assignment($input);
        }
        redirect('CHARMk/charm_secure/Assignment');
        
        
    }

}
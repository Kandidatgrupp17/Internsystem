<?php
class Student extends CI_Controller 
{
	function showAll()
	{
		$this->load->library('table');
		$this->load->model('user_model');
		$input['users'] = $this->user_model->get_alluser(); 
		$this->load->view('student/student_view', $input);
	}

}

?>
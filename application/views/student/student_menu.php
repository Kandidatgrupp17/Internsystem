<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Här ska utseendet för studenter defineras.
 * 
 * */

$input = array('Email' => $Email, 'FirstName' => $FirstName, 'LastName' => $LastName, 'Institute' => $Institute);

$this->load->view('student/student_menu_val.php');
$this->load->view('student/student',$input);  

?>
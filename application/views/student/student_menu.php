<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Här ska utseendet för studenter defineras.
 * 
 * */

$input = array('Error' => '','UserID' => $UserID, 'Email' => $Email, 'FirstName' => $FirstName, 'LastName' => $LastName, 'AllInstitute' => $AllInstitute, 'Institute' => $Institute);

$this->load->view('student/student_menu_down',$input);  

?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Här ska utseendet för studenter defineras.
 * 
 * */
$this->load->view('student/student_menu_val.php', array('Email' => $Email));
$input = array('UserID' => $UserID, 'Email' => $Email);
$this->load->view('student/student',$input);  

?>
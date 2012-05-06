<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Här ska utseendet för studenter defineras.
 * 
 * */
$input = array('Error' => '','UserID' => $UserID, 'Email' => $Email, 'FirstName' => $FirstName, 'LastName' => $LastName, 'AllInstitute' => $AllInstitute, 'Institute' => $Institute);
echo anchor('student/secure/log_out', 'Logga ut');
echo "<br>";
echo anchor('student/secure/application_view', ' ANSÖK TILL VÄRD!');
echo "<br>";
$this->load->view($ViewFile,$input);  

?>
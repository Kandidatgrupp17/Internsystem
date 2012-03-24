<?php
$this->load->helper('form');
echo form_open('registration/insert');

$input = array('name' => 'username');
echo "username: " . form_input($input) . "<br>";

$input = array('name' => 'email');
echo "email: " . form_input($input) . "<br>";

$input = array('name' => 'password');
echo "password: " . form_input($input) . "<br>";

$input = array('name' => 'passwordconfirm');
echo "confirm pw:  " . form_input($input) . "<br>";
echo form_submit('','Registrera');

?>
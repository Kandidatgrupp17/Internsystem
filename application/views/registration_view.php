<?php
$this->load->helper('form');
echo form_open('registration/insert');

$input = array('name' => 'Email');
echo "Email: " . form_input($input) . "<br>";

$input = array('name' => 'password');
echo "Password: " . form_password($input) . "<br>";

$input = array('name' => 'passwordconfirm');
echo "Confirm pw:  " . form_password($input) . "<br>";
echo form_submit('','Registrera');

echo validation_errors();

?>
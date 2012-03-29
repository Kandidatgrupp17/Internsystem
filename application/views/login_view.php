<?php
echo form_open('login/check');

//Username-formulär
$array = array('name' => 'username');
echo "Username: " . form_input($array) . "<br>";

//Password-formulär
$array = array('name' => 'password');
echo "Password: " . form_password($array) . "<br>";

//Knapp
echo form_submit('Logga in', 'Logga in');
$this->load->helper('url');
echo "<br>" . anchor ('registration/index', 'Registrera dig');
echo validation_errors();

?>
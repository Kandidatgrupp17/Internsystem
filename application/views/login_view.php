<?php

$this->load->helper('form');
echo form_open('login/check');
//Username-formulär
$array = array('name' => 'username');
echo "username: " . form_input($array) . "<br>";

//Password-formulär
$array = array('name' => 'password');
echo "password: " . form_input($array) . "<br>";

//Knapp
echo form_submit('Logga in', 'Logga in');
$this->load->helper('url');
echo "<br>" . anchor ('registration/index', 'Registrera dig');

?>
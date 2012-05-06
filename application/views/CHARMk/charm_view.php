<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Länkar till olika funktioner i tillhörande controller.
 * 
 * */
echo anchor('', "logga ut"); echo "<br>";
echo anchor('CHARMk/charm_secure/Members', 'Se alla medlemmar'); echo "<br>";
echo anchor('CHARMk/charm_secure/Application', 'Förhandsgranska formuläret'); echo "<br>"; 
echo anchor('CHARMk/charm_secure/Assignment', 'Tilldelning av värdar'); echo "<br>";
echo anchor('CHARMk/charm_secure/Upload','Importera företag'); echo "<br><br>";

/*
 * 
 * Här bestäms vilken view som ska visas. Den sätts igenom att 
 * skicka med en parameter. $input['ViewField'] = 'Länk_till_view'
 * */

if($ViewField)
{
	$this->load->view($ViewField);
}
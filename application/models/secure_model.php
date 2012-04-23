<?php 

class Secure_model extends CI_model
{
	function __construct()
	{
	
	
	}

	function check_session($session_id)
	{
		$this->db->get_where('ci_sessions', array('session_id' => $session_id));
	}
}


?>
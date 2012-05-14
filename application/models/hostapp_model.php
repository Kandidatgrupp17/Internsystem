<?php

class Hostapp_model extends CI_Model
{
	
	function create_db($questions, $types, $type_list)
	{
		$this->load->dbforge();
	    $fields = array();
	    for($i=0;$i<sizeof($type_list);$i++)
	    {
	        $temp = $type_list[$i];
	        array_push($fields, $types[$temp]);
	    }
	    
	    //Create a new table in database if not exist
	    $newfield = array_combine($questions, $fields); 
	    $this->dbforge->add_field('id');
	    $this->dbforge->add_field(array('UserID' => array('type' => 'INT')));
	    $this->dbforge->add_field($newfield);
		$this->dbforge->create_table('application', TRUE);
	    
	}
    function insert_to_db($input)
    {
	   $this->db->insert('application',$input);
    }

    function application_open()
    {
    	$tables = $this->db->query("show tables")->result();
    	foreach($tables as $tb)
    	{
    		$tb = (Array) $tb;
    		if($tb['Tables_in_CHARM_System'] == "application")
    		{
    			return true;
    		}
    	}
    	return false;
    }
}

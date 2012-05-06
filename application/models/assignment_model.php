<?php

class Assignment_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
        $this->load->dbforge();
		
	}
    function get_applications()
    {
         return $this->db->get('Application');
    }
    function get_assignments_result($name)
    {
         $q = $this->db->get_where('assignment', $name);
         $query= $q->result_array();
         return $query;
    }
    function create_db()
    {
    	$fields = array(
    					'UserID' => array( 'type' => 'INT'
    									),
                        'name' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '30',
                                          ),
                        'status' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '30',
                                          ),
                        'host_type' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '30',
                                          ),
                );
        //Create a new table in database if not exist
        $this->dbforge->add_key('UserID', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('assignment', TRUE);
    }
    function insert_to_db($answers)
    {
        $this->db->insert('assignment',$answers);
        //$this->load->view('hostapp_view'); 
    }
}
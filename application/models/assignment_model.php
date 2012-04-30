<?php

class Assignment_model extends CI_Model
{
    function get_applications()
    {
         $query = $this->db->get('application3');
         return $query;
    }
    function get_assignments_result($name)
    {
         $q = $this->db->get_where('assignment', $name);
         $query= $q->result_array();
         return $query;
    }
    function insert_to_db($answers)
    {
        $this->load->dbforge();
        $fields = array(
                        'username' => array(
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
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('assignment', TRUE);
        $this->db->insert_batch('assignment',$answers);
        $this->load->view('hostapp_view'); 
    }
}
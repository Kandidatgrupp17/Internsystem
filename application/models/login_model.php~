<?php

class Login_model extends CI_Model
{
    function check_user($username,$password)
    {
        $this->load->database();
        $this->load->helper('security');
        return $this->db->get_where('users', array('name' => $username , 'password' => do_hash($password)));
    }
    
}
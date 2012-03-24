<?php
/*
Model för klassen USER
Här sker all databaskontakt för användare!


*/
class User_model extends CI_Model
{
    var $UserID = "";
    var $Email = "";
    var $Password = "";
    
    function get_users()
    {
        $this->load->database();
        $query = $this->db->get('users'); //Ange tabell dom ligger i
        return $query->result();        
    }
    
    function check_user($username,$password)
    {
        $this->load->database();
        $this->load->helper('security');
        return $this->db->get_where('users', array('Email' => $username , 'Password' => do_hash($password)));
    }
    
    
    function insert_to_db($array)
    {
        if(! $this->is_name_taken($array['Email']))
        {
            $this->load->helper('security');
            $array['Password'] = do_hash($array['Password']);
            $this->db->insert('users', $array);

       }
    }
   
   //Kollar om ett specifikt användarnamn finns i databasen
   function is_name_taken($Email)
   {
       $query = $this->db->get_where('users', array('Email' => $Email));
       return ($query->num_rows() > 0);
    }
    
    
    
}


?>
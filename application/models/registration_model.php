<?php

class Registration_model extends CI_Model
{
    //Kollar så att användaren inte finns
    //och lägger in i databasen.
  function insert_to_db($array)
  {
        
        if(! $this->is_name_taken($array['name']))
        {
            $this->load->helper('security');
            $array['password'] = do_hash($array['password']);
            $this->db->insert('users',$array);

       }
            $this->load->view('login_view');    
   }
   
   //Kollar om ett specifikt användarnamn finns i databasen
   function is_name_taken($username)
   {
       $query = $this->db->get_where('users', array('name' => $username));
       return ($query->num_rows() > 0);
    }
    
    
}
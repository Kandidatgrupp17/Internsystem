<?php
/*
Model för klassen USER
Här sker all databaskontakt för användare!
*/
class User_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->database();
    }
    
    function get_user($array)
    {
        return $this->db->get_where('users', $array);
    }
    /*
    Hashar lösenordet samt lägger till användaren databasen
	returnerar false om email inte stämmer
	true om användare lagts till.
    */
    function insert_to_db($array)
    {
        if(! $this->is_name_taken($array['Email']))
        {
            $this->load->helper('security');
            $array['Password'] = do_hash($array['Password']);
            $this->db->insert('users', $array);
			return true;
       }
       return false;
    }
	function insert_to_tempdb($array)
    {
        if(! $this->is_name_taken($array['Email']))
        {
            $this->load->helper('security');
            $array['Password'] = do_hash($array['Password']);
            $this->db->insert('temp_users', $array);
			return true;
       }
       return false;
    }
   
   /*
    Kollar om ett specifikt användarnamn finns i databasen
    returnerar 
    true	-  om det fanns
    false	-  fanns inte
    */
   function is_name_taken($Email)
   {
       $query = $this->db->get_where('users', array('Email' => $Email));
       return ($query->num_rows() > 0);
    }
}


?>
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
    function access_level($input)
    {
    	$input['Password'] = do_hash($input['Password']);
    	$this->db->select('AccessID');
    	/*
    	 * Borde kolla userID och inte mail
    	 * */
    	$this->db->where('Email', $input['Email']);
    	$this->db->from('users');
    	return $this->db->get()->result();
    	    	
    }
    function login_check($input)
    {
    	$input['Password'] = do_hash($input['Password']);
        $query = $this->db->get_where('users', $input);
        if($query->num_rows() == 1)
        {
        	$input = $query->result_array();
        	$arrayinput = array('UserID' => $input['0']['UserID'],
        						'Email' => $username,
        						'loggedin' => TRUE);
	        $this->session->set_userdata($arrayinput);
			return TRUE;
        }
        else
        {
        	/*
        	 * Användaren fanns ej: tillbaka till login!
        	 * */
			return FALSE;
        }
    
    
    }
    function get_alluser()
    {
    	$this->db->select('FirstName,LastName, Email, Institute, Registered');
    	return $this->db->get('users');
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
    	unset($array['Passwordconfirm']);
        if(! $this->is_name_taken($array['Email']))
        {
            $this->load->helper('security');
            $array['Password'] = do_hash($array['Password']);
            $this->db->insert('users', $array);
			return true;
       }
       return false;
    }
    /*
     * Använder postdata - Farligt?
     * */
	function _update_user()
	{
		$this->db->update('users', $this->input->post(), array('UserID' => $this->input->post('UserID')));
	
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
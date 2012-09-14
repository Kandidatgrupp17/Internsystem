<?php
//Model fil f�r att ladda in all f�retagsinfo till databasen
class Company_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    function insert_to_db ($array)
    {
        for($i = 0; $i < SizeOF($array); $i++)
        {
        	$SID = $array[$i]['SID'];
            //Om fältet for foretaget inte ar tommt sa forsoker programmet att uppdatera
        	if($this->get_company($SID)->num_rows() > 0)
        	{     		
        		$this->db->where('SID', $array[$i]['SID']);
            	$this->db->update('companies', $array[$i]);	
            //Ifall foretaget inte existerar sedan tidigare sa satts den in med insert funktionen
        	}else
        	{
        		$this->db->insert('companies', $array[$i]);
        	}
        }
    }
    
    function get_company($SID)
    {
    	return $this->db->get_where('companies', array('SID' => $SID));
    }
    function get_all_companies()
    {
    	$this->db->select('SID,Organisationsnamn');
    	$this->db->from('companies');
        return $this->db->get();
    
    }

}



?>
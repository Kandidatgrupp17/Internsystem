<?php
//Model fil för att ladda in all företagsinfo till databasen
class Company_model extends CI_Model
{
    function insert_to_db ($array)
    {
        $this->load->database();
        for($i = 0; $i < SizeOF($array); $i++)
        {
            $this->db->where('SID', $array[$i]['SID']);
            $this->db->update('companies', $array[$i]);
        }
    }
    function get_all_companies()
    {
    
        return $this->db->get('companies');
    
    }

}



?>
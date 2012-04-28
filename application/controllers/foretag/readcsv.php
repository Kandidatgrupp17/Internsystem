<?php
// Läser filen till $filePath och sparar en lista med all data i variabeln $data
class Readcsv extends CI_Controller
{

    function index()  
    {  
         $this->load->library('csvreader');  
  
         $filePath = 'C:\Users\Mmbg\Desktop\upload\common.csv';  
  
         $data = $this->csvreader->parse_file($filePath);  
  
         //laddar company_model och anropar funktionen för att lägga all data i databasen
         $this->load->model('company_model');
         $this->company_model->insert_to_db($data);
    }
}
?>
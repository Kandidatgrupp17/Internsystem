function index()  
{  
         $this->load->library('csvreader');  
  
         $filePath = 'C:\Users\Mmbg\Desktop\upload\output.csv';  
  
         $data['csvData'] = $this->csvreader->parse_file($filePath);  
  
         $this->load->view('csv_view', $data);  
}
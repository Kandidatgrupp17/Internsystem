<?php
//Controller fil som inneh�ller funktionerna f�r att ladda filen till angiven destination
class Companies extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('table');
		$this->load->library('csvreader');  
		
		
	}

	function do_upload()
	{
		/*
		 * Laddar upp en fil till en specifik plats. Fungerar men ej för CSV
		 * 
		 * 
		 * 
		 * */
		$config['upload_path'] = '/var/www/Internsystem/CSV/';
		$config['allowed_types'] = 'csv|txt';
        $input['error'] = null;
        
		$this->load->library('upload', $config);

	
		if ( ! $this->upload->do_upload())
		{
			$input['error'] = $this->upload->display_errors();
			$input['companies'] = null;
			$input['ViewField'] = 'foretag/uploadform_view';
			$this->load->view('CHARMk/charm_view', $input);	
		
		}else
		{
			/*
			 * Uppladdningen har gått rätt till. Nu uppdaterar vi databasen
			 * och skriver ut resultatet.
			 *  
			 * */
			$datainfo = $this->upload->data();
			$filePath = $datainfo['full_path'];
			$data = $this->csvreader->parse_file($filePath);  
	        $this->load->model('company_model');
	        $this->company_model->insert_to_db($data);
		
	        $input['companies'] = $this->company_model->get_all_companies();
	        $input['ViewField'] = 'foretag/uploadform_view';
			$this->load->view('CHARMk/charm_view', $input);		
			/*
			 * Ta bort filen
			 * */
			unlink($filePath);
		}
	}
}
?>
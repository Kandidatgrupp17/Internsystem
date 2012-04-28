<?php
//Controller fil som innehåller funktionerna för att ladda filen till angiven destination
class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
    
        $this->load->model('company_model');
        $this->load->library('table');
        $input['companies'] = $this->company_model->get_all_companies();
        $input['error'] = null;
		$this->load->view('foretag/uploadform_view', $input);
	}

	function do_upload()
	{
		$config['upload_path'] = 'C:\Users\Mmbg\Desktop\upload';
		$config['allowed_types'] = 'csv|txt';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('foretag\uploadform_view', $error);
		}
		else
		{
			//$data = array('upload_data' => $this->upload->data());

			//$this->load->view('foretag\uploadsuccess_view', $data);
            //$this->load->library('csvreader');
            //$filePath = 'C:\Users\Mmbg\Desktop\upload\common.csv';
            //$data['csvData'] = $this->csvreader->parse_file($filePath);
            $error = array('error' => null);
            $this->load->view('foretag\uploadform_view',$error);
		}
	}
}
?>
<?php
class Login extends CI_Controller
{
    function index()
    {
        $this->load->view('login_view');     
    }
    function check()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run())
        {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->model('user_model', '',TRUE);
        $query = $this->user_model->check_user($username, $password);
        if($query->num_rows() == 1){
        $this->load->view('secure_view');    
        }
        else
        {
        $this->load->view('login_view');
        }
        }
        else
        {
        $this->load->view('login_view');
        }
    }
    
    
}



?>
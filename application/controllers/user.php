<?php
/*
Location: CI/application/controllers
Accessed at: /CI/index.php/user

*/
class User extends CI_Controller
{
    $username = "";
    $password = "";
    
    function index()
  	{
        $this->load->model('User_model', '', TRUE);
        $data['query'] = $this->User_model->get_users();
        $this->load->view('user_view', $data);
    }
    
}


?>
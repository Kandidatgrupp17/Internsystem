<?php

class Hostapp extends CI_Controller
{
  function index()
  {
      $this->load->view('hostapp_view');
  }
  
  function insert()
  {
    $questions = $this->input->post('hidden');
    $categories = $this->input->post('hidden2');
    $types = $this->input->post('hidden3');
    $answers = array();
    $count = 0; //used to ignore the hidden posts
    $array_list = array();
    
    //Get all answers
    foreach ($_POST as $entry)
    {
        if(is_array($entry) && $count>2)
        {
            array_push($answers,(implode(',',$entry)));
        }
        else if ($count>2)
        {
            array_push($answers,$entry);
        }
        $count++;
    }
    $question_list = array();
    
    //Replace all spaces with _
    foreach($questions as $q)
    {
        $temp = str_replace (" ", "_", $q);
        array_push($question_list, $temp);
    }
    $input = array_combine($question_list,$answers);           
    $this->load->model('hostapp_model','',TRUE);
    $this->hostapp_model->insert_to_db($question_list, $categories, $types, $input);
  }

}

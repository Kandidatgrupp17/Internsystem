<?php

class Assignment extends CI_Controller
{
    function index()
    {
        $this->load->library('table');
        $this->load->helper('form');
        $this->load->helper('string');
        // get the data from the database
        $this->load->model('assignment_model','',TRUE);
        $applicationdata = $this->assignment_model->get_applications();
        
        // create the table template
        $tmpl = array (
                    'table_open'          => '<table border="1" cellpadding="4" cellspacing="0">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );
              
        // set the template
        $this->table->set_template($tmpl); 
        // create the table headings
        $tableheadings = array (
            '&nbsp;','Name','Status','Host',
        );
        // set the table headings
        $this->table->set_heading($tableheadings);
                                    
        $options = array('Ej_tilldelad' => 'Ej_tilldelad',
                                    'Foretagsvard' => 'Foretagsvard',
                                    'Omradesvard' => 'Omradesvard');
                                    
        $status = array('Vantande' => 'Vantande',
                                  'Antagen' => 'Antagen',
                                  'Ej_antagen' => 'Ej_antagen',
                                  'Svartlistad' => 'Svartlistad');

        // create the table rows
        $checkbox_nr = increment_string('checkbox');
        $status_nr = increment_string('status');
        $host_nr = increment_string('host');
        $name_list = array();
        foreach($applicationdata->result() as $row)
        {
            $name = $row->Name;
            array_push($name_list,$name);
            $input = array('name' => $checkbox_nr,
                                    'value' => 'Checked',
                                    'checked' => FALSE,
                                    );
            $getapp = array('username' => $name);
            $assignment_result = $this->assignment_model->get_assignments_result($getapp);

            if(sizeof($assignment_result) == 1)
            {
                $selected_status = $assignment_result[0]['status'];
                $selected_hosttype = $assignment_result[0]['host_type'];
                $this->table->add_row(form_checkbox($input),
                                                  $name,
                                                  form_dropdown($status_nr, $status, $selected_status),
                                                  form_dropdown($host_nr, $options, $selected_hosttype)
                                                  );
            }
            else
            {
                $this->table->add_row(form_checkbox($input),
                                                  $name,
                                                  form_dropdown($status_nr, $status),
                                                  form_dropdown($host_nr, $options)
                                                  );
            }
            $checkbox_nr =  increment_string($checkbox_nr);
            $status_nr = increment_string($status_nr);
            $host_nr = increment_string($host_nr);
        }

        // generate the table and put it into a variable
        $data['table'] = $this->table->generate();
        $data['names'] = $name_list;
        $this->load->view('assignment_view', $data);
    }
    
    function insert()
    {
        $array = array('username','status','host_type');
        $prev1 = 'null';
        $prev2 = 'null';
        $prev3 = 'null';
        $answers = array();
        $row = array();
        $names = $this->input->post('name_list');
        $count = 0;
        
        //Get the checked values and their correspond status and host type
        foreach ($_POST as $key => $value)
        {
            if($value == 'Checked')
            {
                $prev1 = 'Checked';
                $username = $names[$count];
                array_push($row,$username);
            }
            //status
            else if($prev1 == 'Checked')
            {
                $prev1 = 'null';
                $prev2 = 'Checked';
                array_push($row,$value);
            }
            //host type
            else if($prev2 == 'Checked')
            {
                $prev2 = 'null';
                array_push($row,$value);
                $input = array_combine($array,$row); 
                array_push($answers,$input);
                array_pop($input);
                array_pop($input);
                array_pop($input);
                array_pop($row);
                array_pop($row);
                array_pop($row);
                $count++;
            }
            else if($prev1 == 'Not_Checked')
            {
                $count++;
                $prev1 = 'null';
            }
            else
            {
                $prev1 = 'Not_Checked';
            }
        }
        $this->load->model('assignment_model','',TRUE);
        $this->assignment_model->insert_to_db($answers);
    }

}
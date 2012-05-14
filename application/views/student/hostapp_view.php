<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<html>
<body>
<div id="viewpage">
<h2>värdansökan</h2>
<?php
echo validation_errors();

$this->load->helper('form');
$this->load->helper('string');
$path = "XML/test.xml";
$xml = simplexml_load_file($path);
//BOF XML
foreach($xml->children() as $xml_questions)
  {
      /*$question_list = array();
      $category_list = array();
      $type_list = array();
      //Get all categories (their database types)
      foreach($xml_questions->category as $xml_category)
      {
          $dbtype = $xml_category->dbtype;
          array_push($category_list, array('type' => $dbtype));
      }
      //Get all questions and their types
      foreach($xml_questions->question as $xml_question)
      {
          $question = $xml_question->name;
          $type = $xml_question->category;
          array_push($question_list, $question);
          array_push($type_list, $type);
      }
      
       * Open form
       * 
       * */
      echo form_open('student/secure/add_application');
      echo form_hidden('UserID', $UserID);
      //Print all questions
      foreach($xml_questions->question as $xml_question)
      {
          $question = $xml_question->name;
          $type = $xml_question->category;
          $options = array();
          foreach($xml_question->option as $option)
          {
              array_push($options, $option);       
          }
          echo "<b>" . $question . "</b>:<br>";
          $question = str_replace(" ", "_", (String) $question);
          switch ($type)
          {
              
              //Input
              case 0:
                $input = array('name' => (String) $question);
                echo form_input($input) . "<br>";
               // $inputnr = increment_string($inputnr);
                break;

              //Checkbox  
              case 1: 
                $size = sizeof($options);
                for($i=0;$i<$size;$i++)
                {
                    $input = array('name' => (String) $question,
                                            'value' => $options[$i],
                                            'checked' => FALSE,
                                            );
                    echo $options[$i] . form_checkbox($input);
                }
                //$checkboxnr = increment_string($checkboxnr);
                echo "<br>";
                break;

              //TextArea  
              case 2: 
                $input = array('name' => (String) $question);
                echo form_textarea($input) . "<br>";
                //$textnr = increment_string($textnr);
                break;

              //Radio  
              case 3:
                $size = sizeof($options);
                for($i=0;$i<$size;$i++)
                {
                    $input = array('name' => (String) $question,
                                            'value' => $options[$i],
                                            'checked' => FALSE,
                                            );
                    echo $options[$i] . form_radio($input);
                }
      			echo "<br>";
                //$radionr = increment_string($radionr);
                break;

              //DropDownList  
              case 4:
                $size = sizeof($options);
                echo "<select name='". (String) $question ."'>";
                for($i=0;$i<$size;$i++)
                {
                    $value = $options[$i]; 
                    echo "<option value='$value'>$value</option>";
                }
                echo "</select><br />";
                //$dropdownnr = increment_string($dropdownnr);
                break;

              //SelectionList  
              case 5: 
                $size = sizeof($options);
                echo "<select name='".(String) $question."' multiple='multiple' size='$size'>";
                for($i=0;$i<$size;$i++)
                {
                    $value = $options[$i]; 
                    echo "<option value='$value'>$value</option>";
                }
                echo "</select><br />";
                //$selectionnr = increment_string($selectionnr);
                break;

              //default  
              default:
                break;
           }
       }
  }
echo "<br />" . "<input type='submit'></input>"  . "</form>";
?> 
</div>
</body>
</html>
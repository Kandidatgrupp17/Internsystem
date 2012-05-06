<html>
<body>
<?php
$this->load->helper('form');
$this->load->helper('string');
$xml = simplexml_load_file("XML/test.xml");

echo $xml->getName() . "<br /><br />";
//BOF XML
foreach($xml->children() as $xml_questions)
  {
      $question_list = array();
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
      
      //Open form
      echo form_open('student/secure/add_application');
      //echo form_hidden('hidden',$question_list);
      //echo form_hidden('hidden2',$category_list);
      echo form_hidden('UserID',$UserID);
      $inputnr = increment_string('input');
      $checkboxnr = increment_string('checkbox[]');
      $textnr = increment_string('text');
      $radionr = increment_string('radio');
      $dropdownnr = increment_string('dropdown');
      $selectionnr = increment_string('selection[]');
      
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
          switch ($type)
          {
              
              //Input
              case 0:
                $input = array('name' =>  (String) $question);
                echo $question . ": <br />" . form_input($input) . "<br>";
                $inputnr = increment_string($inputnr);
                break;

              //Checkbox  
              case 1: 
                echo "<br>". $question . ": ";
                $size = sizeof($options);
                for($i=0;$i<$size;$i++)
                {
                	//$checkboxnr
                    $input = array('name' => (String) $question,
                                            'value' => $options[$i],
                                            'checked' => FALSE,
                                            );
                    echo $options[$i] . form_checkbox($input);
                }
                $checkboxnr = increment_string($checkboxnr);
                break;

              //TextArea  
              case 2: 
                $input = array('name' => (String) $question);
                echo "<br />" . $question . ": <br />". form_textarea($input) . "<br>";
                $textnr = increment_string($textnr);
                break;

              //Radio  
              case 3:
                echo "<br />" . $question . ": <br />";
                $size = sizeof($options);
                for($i=0;$i<$size;$i++)
                {
                    $input = array('name' => (String) $question,
                                            'value' => $options[$i],
                                            'checked' => FALSE,
                                            );
                    echo $options[$i] . form_radio($input);
                }
                $radionr = increment_string($radionr);
                break;

              //DropDownList  
              case 4:
                $size = sizeof($options);
                echo "<br />" . $question . ": <br />";
                echo "<select name='" . (String) $question . "'>";
                for($i=0;$i<$size;$i++)
                {
                    $value = $options[$i]; 
                    echo "<option value='$value'>$value</option>";
                }
                echo "</select><br />";
                $dropdownnr = increment_string($dropdownnr);
                break;

              //SelectionList  
              case 5: 
                $size = sizeof($options);
                echo "<br />" . $question . ": <br />";
                echo "<select name='" . (String) $question . "' multiple='multiple' size='$size'>";
                for($i=0;$i<$size;$i++)
                {
                    $value = $options[$i]; 
                    echo "<option value='$value'>$value</option>";
                }
                echo "</select><br />";
                $selectionnr = increment_string($selectionnr);
                break;

              //default  
              default:
              break;
           }
       }
  }
echo "<br />" . form_submit('','Skicka') . "</form>";
?> 
</body>
</html>
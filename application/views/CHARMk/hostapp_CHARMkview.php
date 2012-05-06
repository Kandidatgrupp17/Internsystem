<html>
<body>
<?php
$this->load->helper('form');
$this->load->helper('string');
$xml = simplexml_load_file("XML/test.xml");

echo "Du tittar just nu på formulär: " . $xml->getName() . "<br /><br />";

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
      /*
       * Open form
       * 
       * */
      echo form_open('CHARMk/charm_secure/preview');
      echo form_hidden('hidden',$question_list);
      echo form_hidden('hidden2',$category_list);
      echo form_hidden('hidden3',$type_list);
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
                $input = array('name' => $inputnr);
                echo $question . ": <br />" . form_input($input) . "<br>";
                $inputnr = increment_string($inputnr);
                break;

              //Checkbox  
              case 1: 
                echo $question . ": <br />";
                $size = sizeof($options);
                for($i=0;$i<$size;$i++)
                {
                    $input = array('name' => $checkboxnr,
                                            'value' => $options[$i],
                                            'checked' => FALSE,
                                            );
                    echo $options[$i] . form_checkbox($input);
                }
                $checkboxnr = increment_string($checkboxnr);
                break;

              //TextArea  
              case 2: 
                $input = array('name' => $textnr);
                echo "<br />" . $question . ": <br />". form_textarea($input) . "<br>";
                $textnr = increment_string($textnr);
                break;

              //Radio  
              case 3:
                echo "<br />" . $question . ": <br />";
                $size = sizeof($options);
                for($i=0;$i<$size;$i++)
                {
                    $input = array('name' => $radionr,
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
                echo "<select name='$dropdownnr'>";
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
                echo "<select name='$selectionnr' multiple='multiple' size='$size'>";
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
echo "<br />" . form_submit('','Godkänn formuläret') . "</form>";
?> 
</body>
</html>
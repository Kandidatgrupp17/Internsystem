<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CSVParser Class
 * 
 * Allows to retrieve a CSV file content as a two dimensional array.
 * Optionally, the first text line may contains the column names to
 * be used to retrieve fields values (default).
 * 
 * Let's consider the following CSV formatted data:
 * 
 *        "col1","col2","col3"
 *         "11","12","13"
 *         "21,"22,"2,3"
 * 
 * It's returned as follow by the parsing operation with first line
 * used to name fields:
 * 
 *         Array(
 *             [0] => Array(
 *                     [col1] => 11,
 *                     [col2] => 12,
 *                     [col3] => 13
 *             )
 *             [1] => Array(
 *                     [col1] => 21,
 *                     [col2] => 22,
 *                     [col3] => 2,3
 *             )
 *        )
 * @author              Pierre-Jean Turpeau
 * @modifier/optimizer  Mirac Günes 
 */
class CSVParser {
    
    var $fields;            /** columns names retrieved after parsing */ 
    var $separator = ',';    /** separator used to explode each line */
    var $enclosure = '"';    /** enclosure used to decorate each field */
    
    var $max_row_size = 4096;    /** maximum row size to be used for decoding */
    
    
    function parse_file($p_Filepath)
    {
        $file = fopen($p_Filepath, 'r'); //Filinnehållet läggs i variabeln
        $this->fields = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure); //Filinnehållet parsas till csv format i en array, rader som inte ar i csv format blir false
        while( ($row = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure)) != false ) //Sa lange filen inte har natt EOF sa fortsatter den
        {
                    // Gar igenom alla element i arrayen och rensar bort alla onödigt tecken ifall elementet inte är NULL
                    // Byter även "+" tecknet till "00" i telefonnummer
                    foreach( $this->fields as $id => $field ) //Alla rader gas igenom med nyckeln ID som specifierar villken rad det ar
                    {
                        if(isset($row[$id])) //Kollar om raden innehaller nagot eller ar NULL
                        {
                            $row[$id] = str_replace('+','00',$row[$id]); //Parsas
                            $row[$id] = str_replace('\n',' ',$row[$id]);
                            $row[$id] = str_replace('\t',' ',$row[$id]);
                            $row[$id] = str_replace('*',' ',$row[$id]);
                            $row[$id] = str_replace('"','',$row[$id]);
                            $row[$id] = str_replace('-','',$row[$id]);
                            $items[$field] = $row[$id]; //Parsade raden laggs in i nya Arrayen
                        }
                    }
                    $content[] = $items; //Elementen laggs in i content arrayen for att nummreringen pa arrayen skall stamma
        }
        fclose($file);
        return $content;
    }
}
?>  
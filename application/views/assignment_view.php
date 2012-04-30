<html>
<body>
<?php
$this->load->helper('form');
echo form_open('assignment/insert');

echo $table;
echo form_hidden('name_list', $names);

echo "<br />" . form_submit('','Tilldela') . "</form>";
?> 
</body>
</html>
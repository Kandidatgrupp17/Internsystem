<html>
<body>
<?php
$this->load->helper('form');
echo form_open('CHARMk/assignment/insert');
echo $table;
echo form_hidden('UserID', $UserID);
echo form_hidden('name_list', $names);
echo "<br />" . form_submit('','Tilldela') . "</form>";
?> 
</body>
</html>
<html>
<body>
<?php
$this->load->helper('form');
echo form_open('CHARMk/assignment/insert');
echo $table;
//echo form_hidden('UserID', $UserID);
echo "<br />" . form_submit('','Tilldela') . "</form>";
?> 
</body>
</html>
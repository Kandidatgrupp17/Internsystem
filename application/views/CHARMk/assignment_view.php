<html>
<body>
<div id="viewpage">
<h2>värdtilldelning</h2>
<?php
$this->load->helper('form');
echo form_open('CHARMk/assignment/insert');
echo $table;
//echo form_hidden('UserID', $UserID);
echo "<br />" . form_submit('','Tilldela') . "</form>";
?> 
</div>
</body>
</html>
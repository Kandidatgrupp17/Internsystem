<html>
<div class="loginbox">
<?php
$this->load->helper('html');

echo link_tag('css/mystyle.css');
$arrayuser = array('name' => 'username');
$arraypw = array('name' => 'password');

?>
<body>
<?php echo form_open('login/check'); ?>
<table>
<tr><td>Username:</td> <td><?php echo form_input($arrayuser);?></td></tr>
<tr><td>Password:</td> <td><?php echo form_password($arraypw);?></td></tr>

</table>
<?php 
echo form_submit('Logga in', 'Logga in');
$this->load->helper('url');
echo "<br>" . anchor ('registration/index', 'Registrera dig');
echo validation_errors();

?>
</div>
<br /><br />

<p><?php echo anchor('foretag/upload', 'Snabb lank till foretagsimport'); ?></p>

</body>
</html>
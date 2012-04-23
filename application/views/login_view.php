<html>
<h1>Login</h1>
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
<a href="http://localhost/Internsystem/index.php/CHARMk/charm_secure">Admin sidan (Ska bli CHARMk)</a>
</body>
</html>
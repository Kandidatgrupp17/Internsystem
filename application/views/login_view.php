<h2>LOGGA IN</h2>
<div id="viewpage">
<?php 
$this->load->helper('html_helper');
$this->load->helper('url_helper');
echo link_tag('css/style.css'); 
$this->load->helper('html_helper');
$arrayuser = array('name' => 'username');
$arraypw = array('name' => 'password');

echo form_open('login/check'); 
?>
<table>
<tr><td>Användarnamn:</td> <td><?php echo form_input($arrayuser);?></td></tr>
<tr><td>Lösenord:</td> <td><?php echo form_password($arraypw);?></td></tr>
</table>

<?php 
echo form_submit('Logga in', 'Logga in');
$this->load->helper('url_helper');
echo "<br><br>";
echo "<h17>Sidan använder kakor. Genom att logga in samtycker du hantering av kakor på webbplatsen.</h17>";
echo validation_errors();
?>
</div>
<h2>Registrering</h2>
<?php
 $this->load->helper('HTML');

echo link_tag('css/style.css'); 

echo form_open('registration/insert');
?>
<table>
<tr>
<td>Email</td>
<td><input type="text" style="width:300;" name="Email"></input></td></tr>
</tr>
<tr>
<td>Förnamn</td>
<td><input type="text" style="width:300;" name="FirstName"></input></td></tr>
</tr>
<tr>
<td>Efternamn</td>
<td><input type="text" style="width:300;" name="LastName" ></input> </td>
</tr>
<tr>
<td>Sektion</td>
<td>
<?php
 $this->load->helper('form');
 echo form_dropdown('Institute', $Sektioner);?> </td>
</tr>

<tr>
<td>Lösenord</td>
<td><input type="password" style="width:300;" name="Password"></input> </td>
</tr>
<tr>
<td>Lösenord igen</td>
<td><input type="password" style="width:300;" name="Passwordconfirm"></input> </td>
</tr>
<?php
/*
 * Datumet
 * */
$this->load->helper('date');
$datestring = "%Y-%m-%d";
 ?>
<input type="hidden" name="Registered" value="<?=mdate($datestring)?>"></input> 
<tr>
<td><?php echo form_submit('','Registrera');?></td>
</tr>
</table>
<?php 
echo "<br>";
echo validation_errors();
?>
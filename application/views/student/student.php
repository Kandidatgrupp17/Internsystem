<html>
<br>
<br>
Redigera dina användaruppgifter: <br>
<?php echo form_open('secure/update');?>
<table>
<table>
<tr>
<td>Email</td>
<td><input type="text" style="width:300;" value="<?php echo $Email;?>"></input> </td>
</tr>
<tr>
<td>Förnamn</td>
<td><input type="text" style="width:300;" value="<?php echo $FirstName;?>"></input> </td></tr>
</tr>
<tr>
<td>Efternamn</td>
<td><input type="text" style="width:300;" value="<?php echo $LastName;?>"></input> </td>
</tr>
<tr>
<td>Sektion</td>
<td><input type="text" style="width:300;" value="<?php echo $Institute;?>"></input> </td>
</tr>
<tr>
<td><input type="submit" value="Ändra"></input></td>
</tr>
</table>
</table>



</html>
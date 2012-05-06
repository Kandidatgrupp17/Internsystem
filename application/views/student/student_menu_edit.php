<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<html>
<br>
<br>
Redigera dina användaruppgifter: <br>
<?php echo form_open('student/secure/update');?>
<input type="hidden" name="UserID" value="<?php echo $UserID ?>"></input>
<table>
<tr>
<td>Email</td>
<td><?php echo $Email;?></input> </td>
</tr>
<tr>
<td>Förnamn</td>
<td><input type="text" style="width:300;" name="FirstName" value="<?php echo $FirstName;?>"></input> </td></tr>
</tr>
<tr>
<td>Efternamn</td>
<td><input type="text" style="width:300;" name="LastName" value="<?php echo $LastName;?>"></input> </td>
</tr>
<td>Sektion</td>
<td><?php $this->load->helper('form');
 echo form_dropdown('Institute', $AllInstitute);?> </td>
</tr>
<tr>
<td><input type="submit" value="Ändra"></input></td>
</tr>
</table>
</table>
<?php echo $Error?>
</html>
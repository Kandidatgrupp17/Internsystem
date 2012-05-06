<html>
<head>
<title>Foretagsimport</title>
</head>
<body>

<?php echo "Importera foretagen:" ;?>
<br /><br />
<?php
//View fil f�r att ladda upp en fil, finns �ven en l�nk till login sidan
 echo form_open_multipart('foretag/companies/do_upload');
?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="Ladda upp" />

<br /><br />
<?php echo $error;?>

</form>
<?php 	
if($companies)
{
	echo $this->table->generate($companies); 
}
?>
</body>
</html>
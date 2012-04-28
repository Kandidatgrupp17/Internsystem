<html>
<head>
<title>Foretagsimport</title>
</head>
<body>

<?php echo $error;?>
<?php echo "Importera foretagen:" ;?>
<br /><br />
<?php
//View fil för att ladda upp en fil, finns även en länk till login sidan
   echo form_open_multipart('foretag/upload/do_upload');
?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="Ladda upp" />

<br /><br />

<p><?php echo anchor('login', 'Tillbaka'); ?></p>
<p><?php echo anchor('foretag/readcsv', 'Uppdatera databasen!'); ?></p>
</form>
<?php $this->table->generate($companies); ?>
</body>
</html>
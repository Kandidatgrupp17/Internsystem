<html>
<head>
<title>Foretagsimport</title>
</head>
<body>

<?php echo $error;?>
<?php echo "Importera foretagen:" ;?>
<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="Ladda upp" />

</form>

</body>
</html>
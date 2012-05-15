<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<html>
<body>
<div id="viewpage">
<h2>värdansökan</h2>
Du har redan skickat in en ansökan
<?php 
$this->table->set_heading('Namn', 'Email', 'Sektion', 'Värdroll', 'Önskat företag', 'Om dig själv');
echo $this->table->generate($appinfo);?>
</div>
</body>
</html>
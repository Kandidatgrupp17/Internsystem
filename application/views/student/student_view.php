<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
?>
<div id="viewpage">
<h2>MEDLEMMAR</h2>
<?php
$this->table->set_heading('Förnamn', 'Efternamn','Email', 'Sektion', 'Registreringsdatum');

echo $this->table->generate($users);
?>
</div>
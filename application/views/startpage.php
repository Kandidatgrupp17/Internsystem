<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Hand Crafted  
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20120401

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>CHARMPORTALEN</title>
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Coda:400,800" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="overflow: hidden;	height: 56px; background: url(<?=base_url()?>/images/img01.gif) repeat-x left top;">
	<div id="menu">
		<ul>
		<li><?=anchor ('registration/index', 'Registrera dig')?></li>
		<li><a href="http://charm.chalmers.se/sv/" target="_blank">Charmsidan</a>?></li>
		
		</ul>
	</div>
	<!-- end #menu -->
</div>
<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<h1><?=anchor('login','CHARM<span>Portalen</span>')?></a></h1>
			<p>Webbportal för nordens största arbetsmarknadsmässa!</a></p>
		</div>
	</div>
</div>
<div id="wrapper">
	<!-- end #header -->
	<div id="page">
		<div id="page-bgbtm">
		<div id="content">
		<?php 
			if($ViewField == 'login_view')
			{
				$this->load->view('middlecontent');
			}
		?>	
		</div>
		</div>
		<div id="page-bgtop">			
			<?php
			if($ViewField)
			{ 
				$this->load->view($ViewField);
			}
			?>
		</div>
	</div>
	<div id="page">
	
	</div>
	<div id="page">
	</div>
	<!-- end #page -->
</div>
<div id="footer">
	<p>Copyright (c) 2012 www.charm.se . All rights reserved. Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
</div>
<!-- end #footer -->
</body>
</html>
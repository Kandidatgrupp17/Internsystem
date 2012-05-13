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
<?php 

$input = array('Error' => '','UserID' => $UserID, 'Email' => $Email, 'FirstName' => $FirstName, 'LastName' => $LastName, 'AllInstitute' => $AllInstitute, 'Institute' => $Institute);

$this->load->helper('html');
$this->load->helper('url');
echo link_tag('css/style.css'); ?>
</head>
<body>
<div style="overflow: hidden;	height: 56px; background: url(<?=base_url()?>/images/img01.gif) repeat-x left top;">
	<div id="menu">
		<ul>
		<li><?= anchor('student/secure/log_out', "logga ut")?></li>
		
		</ul>
	</div>
	<!-- end #menu -->
</div>
<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<h1><?=anchor('student/secure/index', 'CHARM<span>Portalen</span>')?></h1>
			<p>Webbportal för nordens största arbetsmarknadsmässa!</a></p>
		</div>
	</div>
</div>
<div id="wrapper">
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<?php 
						if($ViewFile)
						{
							$this->load->view($ViewFile,$input);  
						}else 
						{ ?>
								<div id="viewpage">
								<h2>STUDENT</h2>
								<?php echo "Du är inloggad som: " . $FirstName . " " . $LastName . "<br>"?> 
								</div>
							
						<?php }
					 ?>	
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div id="sidebar">
					<ul>
							<li>
							<h2>Kategorier</h2>
							<ul>
								<?php if($ansok)
								{
								?>
									<li><?=anchor('student/secure/application_view', ' ANSÖK TILL VÄRD!');?></li>
								<?php 	
								}?>
								<li><?=anchor('student/secure/edit_info','Redigera dina uppgifter')?></li>
							</ul>
						</li>
					</ul>
				</div>
				<div id="page"></div>
				<div id="page"></div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>
<div id="footer">
	<p>Copyright (c) 2012 www.charm.se . All rights reserved. Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
</div>
<!-- end #footer -->
</body>
</html>

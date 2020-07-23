<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/style.js"></script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50" >
	<!--Navbar-->
	<?php 
	session_start();
	include 'head_navbar.php';
	include 'carousel.php';
	include 'home_services.php';
	include 'contact.php';
	include 'footer.php';
	?>
</body>
</html>
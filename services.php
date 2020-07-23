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
<body>
<?php 
	session_start();
	include 'head_navbar.php';
?>
	<div class="container">
		<h1 class="text-center">Services</h1>
		<div class="row float-right">
			<div class="col-sm-4">
				<form action="/" method="post" class="form-inline">
					<div class="form-group">
					    <input type="name" class="form-control shadow w-80" id="search-ws" name="search-ws" placeholder="Search by Service Name">&nbsp
						<button class="btn btn-simple">Search</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>
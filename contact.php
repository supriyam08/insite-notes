<?php 
require_once "config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$yourName = $_POST['con-name'];
	$yourEmail = $_POST['con-email'];
	$yourPhone = $_POST['con-phone'];
	$yourMessage = $_POST['con-message'];
	$yourUname = $_SESSION['uname'];
	$sql="INSERT INTO contact_form_info (name, email, phone, message, username) VALUES ('".$yourName."','".$yourEmail."', '".$yourPhone."', '".$yourMessage."','".$yourUname."')";
	if($link->query($sql)== FALSE){
		die('There was an error running the query [' . $conn->error . ']');
	}
	else{
		echo '<div class="bg-success text-white text-center">Thank you! We will contact you soon</div>';
	}

}
?>
<div class="container-fluid py-5 bg-light" id="contact">
		<div class="container py-4">
			<h1 class="text-center">Contact Us</h1>
			<div class="row">
				<div class="col-sm-6 mt-4">
					<div class="mapouter">
						<div class="gmap_canvas">
							<iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=30.860596,75.863368&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
							
						</div>
						
					</div>
				</div>
				<div class="col-sm-6 mt-4 slideanim">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validated">
					  <div class="form-group">
					    <input type="name" class="form-control contact-box shadow slideanim" id="con-name" name="con-name" placeholder="Name" required>
					  </div>
					  <div class="form-group">
					    <input type="email" class="form-control contact-box shadow slideanim" id="con-email" name="con-email" placeholder="E-mail Address" required value="<?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){echo '';}
					    		else{echo $_SESSION["uname"];}?>" disabled>
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control contact-box shadow slideanim" id="con-phone" name="con-phone" placeholder="Phone Number" required>
					  </div>
					  <div class="form-group">
					      <textarea class="contact-box form-control shadow slideanim" name="con-message" name="con-message" placeholder="Message..." rows="4" required></textarea>
					  </div>
					  <?php
					  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    						echo '<button type="submit" class="btn-simple btn-lg float-right shadow" disabled>Submit</button>
    						You must be logged in to Submit';
						}else{
							echo '<button type="submit" class="btn-simple btn-lg float-right shadow">Submit</button>';
						}?>
					  
					</form>
				</div>
			</div>
		</div>
	</div>

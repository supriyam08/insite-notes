<nav class="navbar navbar-expand-sm bg-dark">  
		<div class="container ">
				<a class="navbar-brand" href="#">!Nsite Notes</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		    		<i class="navbar-toggler-icon"></i>
		 		</button>
	  		<div class="collapse navbar-collapse navbar-right" id="collapsibleNavbar">
		 		<ul class="navbar-nav ml-auto font-weight-bold">
				    <li class="nav-item">
				      <a class="nav-link" href="index.php">HOME</a>
				    </li>
				    <!--<li class="nav-item dropdown">
      					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        					SERVICES
        				</a>
      					<div class="dropdown-menu bg-dark">
					        <a class="dropdown-item" href="#">Home Appliances</a>
					        <a class="dropdown-item" href="#">Coaching</a>
					        <a class="dropdown-item" href="#">Planning</a>
					        <a class="dropdown-item" href="#">Decorations</a>
					        <a class="dropdown-item" href="#">Labour</a>
					        <a class="dropdown-item" href="#">Constructions</a>
					        <a class="dropdown-item" href="#">Personal Care</a>
					        <a class="dropdown-item" href="#">Others</a>
					    </div>
				    </li>-->
				    <li class="nav-item">
	    				<a class="nav-link" href="notes.php">MY NOTES</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="index.php#contact">CONTACT</a>
				    </li>
				     	<?php
				     	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    						echo '<li class="nav-item"><button type="button" class="btn nav-link p-2 mx-2" data-toggle="modal" data-target="#signform">SIGN IN | SIGN UP</button></li>';
    					}
    					else{
    						echo '<li class="nav-item dropdown">
      					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        					Hi,'.htmlspecialchars($_SESSION["uname"]).'
        				</a>
      					<div class="dropdown-menu bg-dark">
					        <a class="dropdown-item" href="logout.php">Logout</a>
					        <a class="dropdown-item" href="reset-password.php">Change Password</a>
					    </div>
				    </li>';
    					}
						?>			    
		 		 </ul>
	 		</div>
	 	</div>
</nav>
<?php include 'signmodal.php';?>
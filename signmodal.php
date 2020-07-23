<?php
// Initialize the session
 
// Check if the user is already logged in, if yes then redirect him to welcome page

 $username = $password = "";
	$username_err = $password_err = "";
// Include config file
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	require_once "config.php";
	 
	// Define variables and initialize with empty values
	
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
	    // Check if username is empty
	    if(empty(trim($_POST["uname"])||$_SESSION["uname"])){
	        $username_err = "Please enter username.";

	    } else{
	        $username = trim($_POST["uname"]);
	    }
	    
	    // Check if password is empty
	    if(empty(trim($_POST["pwd"])||$_SESSION["pwd"])){
	        $password_err = "Please enter your password.";
	    } else{
	        $password = trim($_POST["pwd"]);
	    }
	    
	    // Validate credentials
	    if(empty($username_err) && empty($password_err)){
	        // Prepare a select statement
	        $sql = "SELECT id, username, password FROM users WHERE username = ?";
	        
	        if($stmt = mysqli_prepare($link, $sql)){
	            // Bind variables to the prepared statement as parameters
	            mysqli_stmt_bind_param($stmt, "s", $param_username);
	            
	            // Set parameters
	            $param_username = $username;
	            
	            // Attempt to execute the prepared statement
	            if(mysqli_stmt_execute($stmt)){
	                // Store result
	                mysqli_stmt_store_result($stmt);
	                
	                // Check if username exists, if yes then verify password
	                if(mysqli_stmt_num_rows($stmt) == 1){                    
	                    // Bind result variables
	                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
	                    if(mysqli_stmt_fetch($stmt)){
	                        if(password_verify($password, $hashed_password)){
	                            // Password is correct, so start a new session
	                            session_start();
	                            
	                            // Store data in session variables
	                            $_SESSION["loggedin"] = true;
	                            $_SESSION["id"] = $id;
	                            $_SESSION["uname"] = $username;                            
	                            
	                            // Redirect user to welcome page
	                            header("location: index.php");
	                        } else{
	                            // Display an error message if password is not valid
	                            $password_err = "The password you entered was not valid.";
	                        }
	                    }
	                } else{
	                    // Display an error message if username doesn't exist
	                    $username_err = "No account found with that username.";
	                }
	            } else{
	                echo "Oops! Something went wrong. Please try again later.";
	            }
	        }
	        
	        // Close statement
	        mysqli_stmt_close($stmt);
	    }
	    
	    // Close connection
	    mysqli_close($link);
	}
}
?>
<?php echo '<div class="bg-danger text-white text-center">'.$username_err.'</div>'; ?>
<?php echo '<div class="bg-danger text-white text-center">'.$password_err.'</div>'; ?>
<div class="modal fade" id="signform" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
 		 <div class="modal-dialog modal-dialog-centered">
   			<div class="modal-content">
      		<br>
          		<ul id="myTab" class="nav nav-tabs">
          				<li class="nav-item"><a href="#signin" class="nav-link active" data-toggle="tab">Sign In</a></li>
           				<a href="register.php" class="nav-link">Sign Up</a>
         			    <li class="nav-item"><a href="#why" class="nav-link" data-toggle="tab">Why?</a></li>
            	</ul>
       			<div class="modal-body">
	        		<div id="myTabContent" class="tab-content">
	       				<div class="tab-pane" id="why">
	       					<p>We need this information so that you can receive access to the site and its content. Rest assured your information will not be sold, traded, or given to anyone.</p>        					
	        				<p>Please contact <a href="mailto:supriyamsingh5@gmail.com">supriyamsingh5@gmail.com</a> for any other inquiries.</p>
	        			</div>
	        			<div class="tab-pane active" id="signin">
	          				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" method="POST">
 								<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
   									<label for="email">Email address:</label>
    								<input type="email" class="form-control" name="uname" value="<?php echo $username; ?>" required>
  								</div>
							 	<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
							    	<label for="pwd">Password:</label>
							   		<input type="password" class="form-control" name="pwd" required>
							   	
							  	</div>
							  	<button type="submit" class="btn" style="background-color: #d27e01; color:white;">Submit</button><br>
							  	<a href="register.php">Don't have an account</a>
							</form>
					    </div>
	   				</div>
	     		</div>
	      		<div class="modal-footer">
	      			<center>
	       				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        		</center>
	      		</div>
    		</div>
  		</div>
	</div>

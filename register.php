<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $sql2="CREATE TABLE `".$_POST["username"]."` ( id INT(11) NOT NULL AUTO_INCREMENT , head VARCHAR(100) NOT NULL , content VARCHAR(1024) NOT NULL , time DATETIME NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (id))";
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt) && ($link->query($sql2) === TRUE))
            {
                // Redirect to login page
                header("location:index.php?signup-try=true");  

            } else{
                echo "Something went wrong. Please try again later.".$link->error;
            }
        }
        
        // Close statement
       mysqli_stmt_close($stmt);


    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
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
                                     
                 </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container p-5">
            <h2>Sign Up</h2>
            <p>Fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="email" name="username" class="form-control" value="<?php echo $username; ?>" required>
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required>
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" required>
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit" style="background-color: #d27e01; color:white;">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
                <p>Already have an account? <a href="index.php">Sign in here</a>.</p>
            </form>
        </div>
    </div>    
    
</body>
</html>
<?php
include 'config.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: index.php");
    exit;
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
    <?php include 'head_navbar.php';?>
    <div class="wrapper">
        <div class="container p-5">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Heading</label>
                    <input type="text" name="heading" class="form-control" placeholder="Note heading" required>
                </div>    
                <div class="form-group">
                    <label>Content</label>
                    <textarea type="text" name="content" class="form-control" placeholder="Insert content here" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value=Create style="background-color: #d27e01; color:white;">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
            </form>
        </div>
    </div>    
    </body>
    </html>

<?php
echo $_SESSION["uname"];
if($_SERVER["REQUEST_METHOD"] == "POST"){
   $head = $_POST['heading'];
   $content = $_POST['content'];
   $sql2="INSERT INTO `".$_SESSION["uname"]."` (`id`, `head`, `content`, `time`) VALUES (NULL,'".$head."','".$content."',current_timestamp())";
   if($link->query($sql2)== FALSE){
      die('There was an error running the query [' . $conn->error . ']');
   }
   else{
      echo '<div class="bg-success text-white text-center">Success</div>';
   }
}
$sql = 'SELECT * FROM `'.$_SESSION["uname"].'`';
$result = $link->query($sql);
   echo'<table border="5px">
   <tr>
      <th>Name:</th>
      <th>Email:</th>
      <th>Message</th>
   </tr>';
   while($row =  $result->fetch_assoc()) {
      echo "<tr><td>{$row['id']}</td>".
         "<td>{$row['head']}</td>".
         "<td>{$row['content']}</td></tr>";
   }
   echo '</table>';
   
   echo "Fetched data successfully\n";
   
   $link->close();
?>
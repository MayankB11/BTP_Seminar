<?php
session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false || !isset($_SESSION['isOrg']) || $_SESSION['isOrg']==true){
      session_destroy();
      header('Location: index.html');  
  }
  else
  {
    $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
    if(!$conn) {
          die("Connection failed: " . $conn->connect_error);
      } 
    if(isset($_POST['add']))
    {
      $user = $_SESSION['id'];
      $am = $_POST['amount'];
      $result = mysqli_query($conn, "UPDATE User SET wallet = wallet + $am WHERE user_id = '$user'");
      header("Location: Pro/index.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Simple Login Form Template</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  
</head>

<body>
  <div class="log-form">
  <h2>Add Money</h2>
  <form method="post" action="add_money.php">
    <input requried type="number" name="amount" required="required" title="amount" placeholder="Amount" />
    <!-- <a class="forgot" href="signup.php">Don't have an account? Create one.</a> -->
    <button type="submit" class="btn" name="add" value="Money" style="display: inline-block; float: left;font-size:0.9em;">Add</button>
    <br>
    <!-- <a href="index.html" class="btn" style="text-decoration: none">Return to Home</a>  -->
    
  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 

</body>

</html>
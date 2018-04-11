<?php
session_start();

  $user_error = array('','','','','','','','','','','','','');
  $flag = 0;
    
  if(isset($_POST['signup'])){
    $conn = mysqli_connect("localhost", "root", "demosql", "temp");
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    } 

      $dept_cd = $_POST['dept_cd'];
      $result = mysqli_query($conn,"SELECT * FROM Department WHERE dept_cd = '$dept_cd'");
      $dept_name = $_POST['dept_name'];
      $year = $_POST['year'];

      $result = mysqli_query($conn,"SELECT * FROM Department WHERE dept_cd = '$dept_cd'");
      if (mysqli_num_rows($result) == 0 ){      
        if(!empty($year) && !empty($dept_name))  
          $res = mysqli_query($conn,"INSERT INTO Department values('$dept_cd','$dept_name',$year)");
        else if(!empty($dept_name))
          $res = mysqli_query($conn,"INSERT INTO Department(dept_cd,dept_name) values('$dept_cd','$dept_name')");
        else if(!empty($year))
          $res = mysqli_query($conn,"INSERT INTO Department(dept_cd,year_established) values('$dept_cd',$year)");
        else
          $res = mysqli_query($conn,"INSERT INTO Department(dept_cd) values('$dept_cd')");

        if($res!=false){
         echo '<script type="text/javascript">

            window.onload = function () { alert("Data Successfully Entered"); }
          </script>';
          
        }
        else{
         echo '<script type="text/javascript">

            window.onload = function () { alert("Data Not Entered"); }
          </script>'; 
        }
      } 
      else if(mysqli_num_rows($result) != 0){
          // Username already exists
        echo '<script type="text/javascript">

            window.onload = function () { alert("Department Code already exists"); }
          </script>'; 
      }
  }
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Department Details</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

  <div class="log-form" style=" height:600px; width: 500px; padding:0em;">
  <h2 style="border-radius: 0px 0px 0px 0px">Enter Department Details</h2>
  <br>
  <form method="post" action="dept.php">
    <br>
    <input type="text" name="dept_cd" title="dept_cd" required="required" data-validate = "Department Code is required" placeholder="Department Code" maxlength="9" />

    <input type="text" name="dept_name" title="dept_name" placeholder="Department Name" maxlength="19" />
    

    <input type="number" name="year" title="year" placeholder="Year Established" max="2018"/>
    
    <button type="submit" class="btn" name="signup" value="Sign Up">Enter Details</button>
    <a class="forgot" href="signup.php">Enter some other details</a>
    <br/> <a class="forgot" href="search.php">Go To Search</a>
  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 

</body>

</html>
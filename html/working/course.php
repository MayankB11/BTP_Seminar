<?php
session_start();

  $user_error = array('','','','','','','','','','','','','');
  $flag = 0;
    
  if(isset($_POST['signup'])){
    $conn = mysqli_connect("localhost", "root", "demosql", "temp");
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    } 

      $course_cd = $_POST['course_cd'];
      $result = mysqli_query($conn,"SELECT * FROM Course WHERE course_cd = '$course_cd'");
      $course_name = $_POST['course_name'];
      $credits = $_POST['credits'];


      $result = mysqli_query($conn,"SELECT * FROM Course WHERE course_cd = '$course_cd'");
      if (mysqli_num_rows($result) == 0 ){    
        if(!empty($credits) && !empty($course_name))  
          $res = mysqli_query($conn,"INSERT INTO Course values('$course_cd','$course_name',$credits)");
        else if(!empty($course_name))
          $res = mysqli_query($conn,"INSERT INTO Course(course_cd,course_name) values('$course_cd','$course_name')");
        else if(!empty($credits))
          $res = mysqli_query($conn,"INSERT INTO Course(course_cd,no_of_credits) values('$course_cd',$credits)");
        else
          $res = mysqli_query($conn,"INSERT INTO Course(course_cd) values('$course_cd')");

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

            window.onload = function () { alert("Course Code already exists"); }
          </script>'; 
      }
  }
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Course Details</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

  <div class="log-form" style=" height:600px; width: 500px; padding:0em;">
  <h2 style="border-radius: 0px 0px 0px 0px">Enter Course Details</h2>
  <br>
  <form method="post" action="course.php">
    <br>
    <input type="text" name="course_cd" title="course_cd" required="required" data-validate = "Course Code is required" placeholder="Course Code" maxlength="9" />

    <input type="text" name="course_name" title="course_name" placeholder="Course Name" maxlength="19" />
    

    <input type="number" name="credits" title="credits" placeholder="No of Credits" min="2" max="5"/>
    
    <button type="submit" class="btn" name="signup" value="Sign Up">Enter Details</button>
    <a class="forgot" href="signup.php">Enter some other details</a>
    <br/> <a class="forgot" href="search.php">Go To Search</a>
  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 

</body>

</html>
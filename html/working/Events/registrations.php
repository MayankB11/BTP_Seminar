<?php
session_start();
  
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false || !isset($_SESSION['isOrg']) || $_SESSION['isOrg']==true){
    session_destroy();
    header('Location: index.html');  
  }
  $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
  if (!$conn) {
      die("Connection failed: " . $conn->connect_error);
  }
  $user = $_SESSION['id'];
  $result = mysqli_query($conn,"SELECT * FROM  User_offline WHERE user_id = '$user'");
  ?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Simple Login Form Template</title>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="toggle.css">
</head>

<body>
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">  
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

 
  <div class="container">
  <div class="page-header"><h2> My Registrations </h2></div>
  <div class="table-responsive">          
  <table class="table" style = "color: white; overflow-y:scroll;">
    <thead>
      <tr>
        <th>#</th>
        <th>Event ID</th>
        <th>Time of Registration</th>
      </tr>
    </thead>
    <tbody>
      <?php
  function familyName($result) {
    $i = 1;
    while($res=mysqli_fetch_array($result)){
      echo "<tr>
              <td>".$i."
              <td>".$res['event_id']."
              <td>".$res['time_stamp']."
            </tr>";
      $i = $i+1;
    }
  }
  familyName($result);
  ?>
    </tbody>
  </table>
  </div>
 </div>

    <br>
  </div>
  
</body>

</html>
  .
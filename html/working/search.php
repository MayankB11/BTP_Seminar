<?php
session_start();
  $map = array(
    "event_id" => "Event Id",
    "org_id" => "Organisation Id",
    "name" => "Event Name",
    "description" => "Description",
    "address_house_no" => "House No",
    "address_street_name" => "Street Name",
    "address_city" => "City",
    "address_state" => "State",
  );
  $conn = mysqli_connect("localhost", "root", "demosql", "temp");
  if (!$conn) {
      die("Connection failed: " . $conn->connect_error);
  }
  $filter = "None";
  $result = mysqli_query($conn,"SELECT D.dept_cd,D.dept_name,year_established,Offering.semester FROM Department as D,Course as C,Offering WHERE C.course_cd = Offering.course_cd AND D.dept_cd = Offering.dept_cd"); 
  if(isset($_POST['submit'])){ 
    if(!empty($_POST['search'])){
      $temp = $_POST['search'];
      $filter = $_POST['filter'];

      if($filter === 'course_name'){
        $result = mysqli_query($conn,"SELECT D.dept_cd,D.dept_name,year_established,Offering.semester FROM Course as C,Department as D,Offering WHERE C.course_cd = Offering.course_cd AND D.dept_cd = Offering.dept_cd AND C.course_name like '%$temp%'");
      }
      else if($filter === 'course_cd'){
        $result = mysqli_query($conn,"SELECT D.dept_cd,D.dept_name,year_established,Offering.semester FROM Course as C,Department as D,Offering WHERE C.course_cd = Offering.course_cd AND D.dept_cd = Offering.dept_cd AND C.course_cd like '%$temp%'");
      }
      else if($filter === 'dept_cd'){
        $result = mysqli_query($conn,"SELECT C.course_cd,C.course_name,C.no_of_credits,Offering.semester FROM Course as C,Department,Offering WHERE C.course_cd = Offering.course_cd AND Department.dept_cd = Offering.dept_cd AND Department.dept_cd like '%$temp%'");
      }
      else if($filter === 'dept_name'){
              $result = mysqli_query($conn,"SELECT C.course_cd,C.course_name,C.no_of_credits,Offering.semester FROM Course as C,Department,Offering WHERE C.course_cd = Offering.course_cd AND Department.dept_cd = Offering.dept_cd AND dept_name like '%$temp%'");
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Search</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="toggle.css">
</head>

<body>
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">  
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

 
  <div class="container" >
  <form action="search.php" method="POST"> 
        <div class="page-header"><h2> Search </h2></div>
  <div class="row">
    <div class="col-xs-6 col-md-4">
      <div class="input-group">
   <input type="text" class="form-control" name="search" placeholder="Search" id="txtSearch"/>
   <div class="input-group-btn">
        <button class="btn btn-primary" name="submit" type="submit">
        <span class="glyphicon glyphicon-search"></span>
        </button>

   </div>
   </div>
    </div> 
        <select value="" name="filter">
          
         <option value="dept_cd">Department Code </option>
         <option value="dept_name">Department Name </option>
         <option value="course_name">Course Name </option>
         <option value="course_cd">Course Code </option>
        </select>
      </form>
</div>

    <br>

  <form action="search.php" method="POST" style="overflow-y:scroll;">
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
  <?php
      if($filter == "None" || $filter == "course_cd" || $filter == "course_name"){

        echo "<th>Department Code</th>
        <th>Department Name</th>
        <th>Year Established</th>
        <th>Semester</th>";
      }
      else{
        echo "<th>Course Code</th>
        <th>Course Name</th>
        <th>No of Credits</th>
        <th>Semester</th>";
      }
  ?>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php
        while($res=mysqli_fetch_array($result)){
          if($filter == "None" || $filter == "course_cd" || $filter == "course_name"){

              echo"<td>".$res['dept_cd']."</td>
          <td>".$res['dept_name']."</td>
          <td>".$res['year_established']."</td>
          <td>".$res['semester']."</td></tr>";         

          }
          else{
              echo"<td>".$res['course_cd']."</td>
            <td>".$res['course_name']."</td>
            <td>".$res['no_of_credits']."</td>
            <td>".$res['semester']."</td></tr>";
          }
        }
        ?>
      </tr>
    </tbody>
  </table>
  </div>
</form>
  </div>
  
</body>

</html>
  .
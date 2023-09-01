<?php

include_once '../model/Enrolled.php';

$en = new Enrolled();

if(isset($_SESSION['id']))
{
  if($_SESSION['role']!='teacher')
  {
    header('location:../../view/dashboard.php');
    exit;
  }
}
else
{
  header('location:../view/login.php');
  exit;
}

$student = $en->getEnrolled($_GET['id']);
// echo "<pre>";
// print_r($student);
// exit;

?>

<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>View Enrolled</title>
    <style>
        a:link, a:visited, a:hover, a:active{
    text-decoration: none;
}
    tr,td,th
    {
      padding:8px;
      margin:3px;
      text-align:center;
    }
    table 
    {
      border:2px solid black;
      border-radius:3px 3px 3px 3px;
    }
    .error
    {
      color:red;
    }
    </style>
  </head>
  <body>
  <center><h2 class="display-6">View Enrolled Student</h2></center>
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a href="add_course.php"><button class="btn btn-primary">Add Course</button></a>

  <a href="dashboard_teacher.php"><button class="btn btn-primary" >Back To DashBoard</button></a>

  </div>
  <br>
<table class="table">
        <tr><th>Image</th><th>Student Name</th><th>Course Name</th><th>Progress</th><th>Teacher Name</th><th>Action</th></tr>
    <?php
    foreach($student as $value)
    {
      echo "<tr><td><img src='../view/img/$value[image]' height='50px' width='60px'></td><td>$value[student_name]</td><td>$value[coursename]</td>";
if(empty($value['progress']))
{
  echo "<td>0%</td>";
}
else
{
  echo "<td>$value[progress]%</td>";
}
 echo "<td>$value[teacher_name]</td><td></td></tr>";
  

    }
    ?>
        </table>
    
  </body>
</html>
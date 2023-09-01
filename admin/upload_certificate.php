<?php
include_once '../model/course_progress.php';
include_once '../controller/Validation.php';
include_once '../controller/ProgressController.php';
// session_start();


if(isset($_SESSION['id']))
{
  if($_SESSION['role']!='teacher')
  {
    header("location:../view/dashboard.php");
    exit;
  }
}
else
{
  header("location:../view/login.php");
  exit;
}
$valid = new Validation();
$cp = new course_progress();
$progress = new ProgressController();
$result = $cp->get_certificate($_GET['id']);

if(isset($_POST['submit']))
{
  
if($_FILES['certificate']['error']!=4)
{
  $ext=pathinfo($_FILES['certificate']['name'],PATHINFO_EXTENSION);
  if($ext=='pdf')
  {
    $filesave = date("Ymdhis");
    move_uploaded_file ($_FILES["certificate"]["tmp_name"], "../view/img/".$filesave.'.'.$ext);
    $progress->upload_certificate($_POST,$filesave.'.'.$ext);
    
  }
  else
  {
  $error = "Invalid File Type";
  }
}
else
{
  $error = "Select PDF";

}
}


?>


<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Certificate</title>
<style>
  span
  {
    color:red;
  }
</style>
  </head>
  <body>
  <center>
  <br><br>
  
  <?php

if(empty($result))
{
  echo "<h4 class='display-4'>No Certificate Request Found</h4><br><br>";
  echo "<a href='add_course.php'><button class='btn btn-primary'>Add Course</button></a>&nbsp;&nbsp;<a href='dashboard_teacher.php'><button class='btn btn-primary'>Back To Dashboard</button></a>";
  exit;

}
?>
  <h3 class="display-3">Upload Certificate</h3>


  <table class="table table-bordered">
    <tr><th>Student Name</th><th>Course Name</th><th>Progress</th><th>Certificate</th></tr>
  <?php
foreach($result as $value)
{
  echo "<tr><td>$value[fullname]</td><td>$value[coursename]</td><td>$value[progress]</td>";
  echo "<td><form action='' method='post' enctype='multipart/form-data'>";
  echo "<input type='text' name='progress_id' value='$value[id]' hidden>";
  echo "<input type='text' name='course_id' value='$_GET[id]' hidden>";
  if(!empty($error)) 
  echo "<span>$error</span><input type='file' name='certificate'> <input type='submit' name='submit' value='Upload' class='btn btn-success'>";
  else
  echo "<input type='file' name='certificate'> <input type='submit' name='submit' value='Upload' class='btn btn-success'>";

  echo "</td></form></tr>";

}

?>

  </table>
  <a href="add_course.php"><button class="btn btn-primary">Add Course</button></a>
<a href="dashboard_teacher.php"><button class="btn btn-primary">Back To Dashboard</button></a>


  </center>  


  </body>
</html>
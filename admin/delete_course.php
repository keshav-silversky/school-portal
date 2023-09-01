<?php

include_once '../model/Courses.php';

$cors = new Courses();

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

$result=$cors->delete($_GET['id']);

if($result)
{
  header("location:add_course.php");
}
else
{
  echo" <script>alert('Course Cannot Be Deleted')
  window.location='add_course.php'</script>";
  exit;
}



?>
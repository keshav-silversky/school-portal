<?php
require_once "../model/Notice.php";

$note = new Notice();

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

if($_GET['action']=='delete')
{
  $result =$note->deleteNotice($_GET['id']);
  if($result==TRUE)
  {
    echo "<script>window.history.back()</script>";

  }
}




?>
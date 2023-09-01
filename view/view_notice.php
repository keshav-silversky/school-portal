<?php
include_once '../model/notice.php';
// session_start();
$n = new Notice();
$notice = $n->view_notice_by_student($_SESSION['id']);
if(isset($_SESSION['id']))
{
  if($_SESSION['role']!='student')
  {
    header('location:../dashboard_teacher.php');
  }
}
else
{
  header('location:login.php');
}
?>

<html>
  <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <title>Notice</title>
    <style>
      .buttooon
      {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
      }
    </style>
  </head>
  <body>
  <center>
    <h4 class="display-5">+---------- Notices ----------+</h4>
    <br>
    <table class="table table-bordered">
  <tr><th>Course Name</th><th>Subject</th><th>Notice</th><th>Teacher</th></tr>
<?php

foreach($notice as $value)
{
  echo "<tr><td>$value[coursename]</td><td>$value[subject]</td><td>$value[detail]</td><td>$value[fullname]</td></tr>";
}


?>

</table>
<a href="dashboard.php"><button class="btn btn-primary" style=" box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">Back To Dashboard</button></a>
</center>
  </body>
  </html>


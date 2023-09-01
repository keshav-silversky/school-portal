<?php

include_once '../model/Enrolled.php';

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

$e = new Enrolled();

$result = $e->ViewClassmates($_GET['id']);

?>
<html>
  <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <title>View ClassMates</title>
  </head>
  <body>
  <center>
    <h2 class="display-5"><u><b>Your ClassMates</b></u></h2>  
    <table class="table">

    <br><br><a href="dashboard.php"><button class="btn btn-primary" style=" box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">Back To Dashboard</button></a><br><br>
  <tr><th>Image</th><th>Name</th><th>Email</th></tr>
  <?php

  foreach($result as $key => $value)
  {
    echo "<tr><td><img src='img/$value[image]' height='50px' width='60px'></td><td>$value[fullname]</td><td>$value[email]</td></tr>";
  }
  ?>
</table>

  </body>
</html>
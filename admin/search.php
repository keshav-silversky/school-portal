<?php
include_once '../model/Enrolled.php';

// session_start();


if(isset($_SESSION['id']))
{
  if($_SESSION['role']!='teacher')
  {
    header('location:dashboard_teacher.php');
    exit;
  }
}
else
{
  header('location:login.php');
  exit;
}
$e = new Enrolled();
if(empty($_GET['value']))
{
  echo "<script>alert('Enter In Search Bar');
  window.location='dashboard_teacher.php'</script>";
  exit;
}
$search_result = $e->search_by_teacher($_GET['value']);


?>


<html>
  <head>
    <title>Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <center>
      <?php
if(empty($search_result))
{
  echo "<br><br><br><h4 class='display-4'>No Record Found</h4>";
  echo "<a href='dashboard_teacher.php'><button class='btn btn-primary'>Back To Dashboard</button></a>";
  exit;
}


      ?>
<h4 class="display-4">Search Result</h4>

  <table class="table">
  <tr><th>Student Name</th><th>Course Name</th><th>Course Price</th><th>Action</th></tr>
  <?php
  foreach($search_result as $value)
  echo "<tr><td>$value[fullname]</td><td>$value[coursename]</td><td>$value[price]</td><td></td></tr>";
  ?>

  </table>
  <a href="dashboard_teacher.php"><button class="btn btn-primary">Back To Dashboard</button></a>


    </center>
  </body>
</html>
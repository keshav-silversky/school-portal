<?php

include_once '../model/payment.php';

if(isset($_SESSION['id']))
{
  if($_SESSION['role']!='teacher')
  {
    header("location:../view/login.php");
    exit;
  }

}
else
{
  header("location:../view/login.php");
  exit;
}

$pay = new Payment();
$result = $pay->select_payment($_SESSION['id']);

?>


<html lang="en">
<head>
<title>View Payment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>
.table
{
  text-align:center;
}
.action 
{
  width:60px;
}
</style>

</head>
<body>

<center>
<br>
<h4 class="display-5">View Payment</h4>
<br>

<a href="dashboard_teacher.php"><button class="btn btn-outline-primary">Back To DashBoard</button></a>
<br><br>
<table class="table table-bordered">
<tr><th>Student Name</th><th>Course Name</th><th>Receipt</th><th>Date</th><th>Action</th></tr>
</td></tr>

<?php
foreach ($result as $value)
{
  echo "<tr><td>$value[fullname]</td><td>$value[coursename]</td><td><a href='../view/img/$value[pdf]' target='_blank'>Receipt</a></td><td>$value[created_at]</td><td><a href='update_payment.php?action=approve&id=$value[id]'><button class='btn btn-outline-success'>Approve</button></a>&nbsp;<a href='update_payment.php?action=reject&id=$value[id]'><button class='btn btn-outline-danger'>Reject</button></a></td></tr>";
}




?>



</table>




</center>

  
</body>
</html>

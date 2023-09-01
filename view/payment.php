<?php

include_once '../controller/Validation.php';
include_once '../controller/PaymentController.php';

$pay = new PaymentController();
$valid = new Validation();

session_start();

if(isset($_SESSION['id']))
{
  if($_SESSION['role']!='student')
  {
    header("location:../admin/dashboard_teacher.php");
    exit;
  }
}
else
{
  header("location:login.php");
  exit;
}

if(isset($_POST['submit']))
{
  $error['fullname']= $valid->fullname($_POST['fullname']);
  $error['card_detail']=$valid->card_detail($_POST['card_detail']);
  $error['cvv']=$valid->cvv($_POST['cvv']);
  $error['exp_date']=$valid->exp_date($_POST['exp_date']);

  if(pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION)!='pdf')
  {
    $error['pdf']="Invalid PDF";
  }

  if(empty($error['fullname']) && empty($error['card_detail']) && empty($error['cvv']) && empty($error['exp_date']) && empty($error['pdf']))
  {
   
    $filesave=date("Ymdhis");
    
    move_uploaded_file($_FILES['pdf']['tmp_name'],"./img/".$filesave.'.'.pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION));

    $pay->payment($_POST,$filesave.'.'.pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION));
  }
}


?>


<html lang="en">
<head>
  <title>Payment Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <style>
.mb-3
{
  width:40%;
}
span
{
  color:red;
}

    </style>
</head>
<body>
  <center>

  <h3 class="display-5">+------ Course Payment ------+</h3>
  <br><br>
 
<form action="" method="post" enctype="multipart/form-data">
  <div class="mb-3">
  <input type="number" class="form-control" name="course_id" value=<?php echo $_GET['id']; ?> hidden>
  <?php if(!empty($error['fullname'])) echo '<span>Enter Fullname</span>' ?>
  <input type="text" class="form-control <?php if(!empty($error['fullname'])) echo 'is-invalid' ?>" name="fullname" placeholder="Enter Name"><br>
  <?php if(!empty($error['card_detail'])) echo '<span>Enter Card Number</span>' ?>

  <input type="number" class="form-control <?php if(!empty($error['card_detail'])) echo 'is-invalid' ?>" name="card_detail" pattern="[0-9\s]{13,19}" placeholder="Card Number " ><br>
  <?php if(!empty($error['cvv'])) echo '<span>Enter cvv</span>' ?>
 
  <input type="number" class="form-control <?php if(!empty($error['cvv'])) echo 'is-invalid' ?>" name="cvv" placeholder="CVV"><br>
  <?php if(!empty($error['exp_date'])) echo '<span>Enter Card Expire Date</span>' ?>

  <input type="date" class="form-control <?php if(!empty($error['exp_date'])) echo 'is-invalid' ?>" name="exp_date" placeholder="Card Expire Date"><br>

  <input type="number" class="form-control " name="amount" value="<?php echo $_GET['price'] ?>" readonly><br>
  <?php if(!empty($error['pdf'])) echo '<span>Invalid File  </span>' ?>
  <input type="file" name="pdf">
  </div>
  <input type="submit" name="submit" value="Payment" class="btn btn-primary">
</form>
<a href="dashboard.php"><button class="btn btn-success">Back To Dashboard</button></a>
</center>
</body>
</html>
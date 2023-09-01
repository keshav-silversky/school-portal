<?php

require_once '../controller/PaymentController.php';

$pay = new PaymentController();

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
   
    if($_FILES['pdf']['error']!='4')
    {
      if(pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION)=='pdf')
        {
            if(empty($error['fullname']) && empty($error['card_detail']) && empty($error['cvv']) && empty($error['exp_date']) )
        {
                $filesave= date("Ymdhis");
                move_uploaded_file($_FILES["pdf"]["tmp_name"], "../view/img/".$filesave.'.'.pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION));
                $pay->repayment($_POST,$filesave.'.'.pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION));         
    }
  }
  else
  {
    $error['pdf']="Select PDF";
  }
 }
 else
 {
  $error['pdf']="Select File";
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
.disabled
{
  background-color:#140101a6;
  color:white;
  font-weight:700;

}
    </style>
</head>
<body>
  <center>

  <h3 class="display-5">+------ Course Re-Payment ------+</h3>
  <br><br>
<form action="" method="post" enctype="multipart/form-data">
  <div class="mb-3">
  <input type="number" class="form-control" name="course_id" value=<?php echo $_GET['id']; ?> hidden>
<?php if($error['fullname']) echo "<span>$error[fullname]</span>"; ?>
  <input type="text" class="form-control <?php if($error['fullname']) echo "is-invalid"; ?>" name="fullname" placeholder="Enter Name"><br>
  <?php if($error['card_detail']) echo "<span>$error[card_detail]</span>"; ?>
  <input type="number" class="form-control <?php if($error['card_detail']) echo "is-invalid"; ?>" name="card_detail" pattern="[0-9\s]{13,19}" placeholder="Card Number " ><br>
  <?php if($error['cvv']) echo "<span>$error[cvv]</span>"; ?>
  <input type="number" class="form-control   <?php if($error['cvv']) echo "is-invalid"; ?>" name="cvv" placeholder="CVV"><br>
  <?php if($error['exp_date']) echo "<span>$error[exp_date]</span>"; ?>
  <input type="date" class="form-control   <?php if($error['exp_date']) echo "is-invalid"; ?>" name="exp_date" placeholder="Card Expire Date"><br>

  <input type="number" class="form-control disabled" name="amount" value="<?php echo $_GET['price'] ?>" readonly><br>
  <?php if($error['pdf']) echo "<span>$error[pdf]</span>"; ?>
  <input type="file" name="pdf" class="form-control <?php if($error['exp_date']) echo "is-invalid"; ?>">
  </div>
  <input type="submit" name="submit" value="Submit" class="btn btn-primary" >
</form>
<a href="dashboard.php"><button class="btn btn-primary">Back To Dashboard</button></a>
</center>
</body>
</html>
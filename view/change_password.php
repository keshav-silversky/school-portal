<?php
include_once '../model/User.php';
include_once '../controller/UController.php';
include_once '../controller/Validation.php';

$user = new User();
$valid = new Validation();
$user_controller = new UserController();

// session_start();

if(isset($_SESSION['id']))
{

}
else
{
  header('location:login.php');
}

if(isset($_POST['submit']))
{
  $password = $user->fetch_password($_SESSION['id']);
  if($password['password']==md5($_POST['current_password']))
  {

    if(strlen($_POST['new_pass'])>=8)
    {
   
      if($_POST['new_pass']==$_POST['c_new_pass'])
      {
        $user_controller->change_password(md5($_POST['new_pass']));
      }
       else
        {
          $error['new_pass']= "New Password Not Match";
        }
      }
      else
      {
        $error['short_pass']= "Too Short Pass";
      }
  }
  else
  {
    $error['curr_pass']= "Current Password Not Match";   
  }
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <title>Change Password</title>
  <style>
    .password
    {
      width:30%;
      margin-top:16px;
    }
    form`
    {
      filter: drop-shadow(3px 2px 10px #cfedff);
     
    }
    span
    {
      color:red;
    }
  </style>
</head>
<body>
<center>
<h3 class="display-4">+----- Change Password -----+</h3>
<br><br>
<form action="" method="post">
<?php if(isset($error['curr_pass'])) echo "<span>$error[curr_pass]</span>"; ?>
<input type="password" class="form-control password" name="current_password" placeholder="Enter Current Password">

<?php if(isset($error['new_pass'])) echo "<span>$error[new_pass]</span>"; ?>
<?php if(isset($error['short_pass'])) echo "<span>$error[short_pass]</span>"; ?>
<input type="password" class="form-control password" name="new_pass" placeholder="Enter New Password">

<?php if(isset($error['new_pass'])) echo "<span>$error[new_pass]</span>"; ?>
<?php if(isset($error['short_pass'])) echo "<span>$error[short_pass]</span>"; ?>
<input type="password" class="form-control password" name="c_new_pass" placeholder="Re-enter New Password">

<input type="submit" class="btn btn-primary password" name="submit" Value="Change Password">

</form>
<br><br>
<a href="dashboard.php"><button class="btn btn-outline-primary">Back To Dashboard</button></a>
</center>

 
</body>
</html>
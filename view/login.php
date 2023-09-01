<?php
include_once "../controller/validation.php";
include_once "../controller/UController.php";

$valid = new Validation();

if(isset($_SESSION['id']))
{
  if($_SESSION['role']=='student')
  {
    header('location:dashboard.php');
  }
  else
  {
    header('location:../admin/dashboard_teacher.php');
  }
}
else
{
    if(isset($_POST['submit']))
    {
      $error['email']=$valid->email($_POST['email']);
      $error['password']=$valid->password($_POST['password']);
      if(empty($error['email']) && empty($error['password']))
      {
        $user = new UserController();
        $user->login($_POST);
      }

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
    body {
      background-color: #f0f0f0;
    }
    .login-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 40px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
      margin-top: 100px;
      position: relative;
      overflow: hidden;
    }
    .login-container::before {
      content: "";
      position: absolute;
      top: -40px;
      left: -40px;
      background-color: #007bff;
      width: 80px;
      height: 80px;
      border-radius: 50%;
      z-index: -1;
    }
    .login-container::after {
      content: "";
      position: absolute;
      bottom: -40px;
      right: -40px;
      background-color: #007bff;
      width: 80px;
      height: 80px;
      border-radius: 50%;
      z-index: -1;
    }
    .login-container h3 {
      margin-bottom: 30px;
      color: #007bff;
    }
    .form-control {
      border-radius: 25px;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }
    .btn-primary {
      border-radius: 25px;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #007bff;
      border-color: #007bff;
    }
    .create-account-btn {
      margin-top: 15px;
    }
    .create-account-btn a {
      text-decoration: none;
      color: #007bff;
    }
    .create-account-btn a:hover {
      text-decoration: underline;
    }
    span
    {
      color:red;
    }
  </style>
  <title>LOGIN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>

    <div class="container">
    <div class="login-container">
      <h3 class="mb-4">Login</h3>
      <form action="" method="post">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <?php    if(!empty($error['email'])) echo "<span>$error[email]</span>"; ?>
          <input type="email" class="form-control  <?php    if(!empty($error['email'])) echo "is-invalid"; ?>" id="email" name="email" >
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <?php    if(!empty($error['password'])) echo "<span>$error[password]</span>"; ?>
          <input type="password" class="form-control  <?php    if(!empty($error['email'])) echo "is-invalid"; ?>" id="password" name="password" > 
        </div>
        <div class="mb-3 text-center">
          <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        </div>
        <p class="text-center create-account-btn">Don't have an account? <a href="register.php">Create an account</a></p>
      </form>
    </div>
  </div>

  </form>


  
</body>
</html>

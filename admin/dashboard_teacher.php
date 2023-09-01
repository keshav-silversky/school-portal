<?php
require_once '../model/User.php';


    session_start();

    if(isset($_SESSION['id']))
    {
      if($_SESSION['role']!='teacher')
      {
    
        header('location:../view/dashboard.php');
        exit;
      }
    }
    else
    {
      header('location:../view/login.php');
      exit;
    }
    $u = new User();
    $user = $u->getUserDetail($_SESSION['id']);
  



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <style>
    /* Custom styles */
    .header {
      background-image:url("../view/img/background.jpg");
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-family: cursive;
      font-size:14px;
    }

    .student-portal {
      font-size: 32px;
      font-weight: bold;
      animation-duration: 3s;
  animation-name: fadeInUp;
  animation-iteration-count: infinite;
  animation-direction: alternate;
  filter: drop-shadow(3px 2px 10px red);
    }

    .logout-btn {
      transition: all 0.3s ease-in-out;
    }

    .logout-btn:hover {
      transform: scale(1.1);
    }

    @keyframes fadeInUp {
      0% {
        transform: translateY(0);
        opacity: 0.8;
      }

      50% {
        transform: translateY(-5px);
        opacity: 1;
      }

      100% {
        transform: translateY(0);
        opacity: 0.8;
      }
    }
    /* button */

    .main
    {
      height:60px;
      width:100%;
      background-color:yellow;
      font-size:24px;
    }
    #dash
    {
      margin-left:40%;
    }
    #user,#image,#role
    {
      float:right; 
      margin-left:5px;
      padding: 3px;
    }
    #role
    {
      float:right; 
   
      padding: 3px;
   
    }
    .add_button
    {
      width:200px;
      text-transform: uppercase;
  letter-spacing: 2.5px;
  font-weight: 500;
  color: #000;
  background-color: #fff;
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease 0s;
  cursor: pointer;
  outline: none;
    }
    .add_button:hover {
  background-color: #2EE59D;
  box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
  color: #fff;
  transform: translateY(-7px);
}

.nav_div
{
  height:5rem;
  width:100%;
  background-color:skyblue;

}
.search
{
  width:300px;
  align:center;
  
}
.right-section {
  display: flex;
  align-items: center;
}

.search {
  width: 300px;
  margin-right: 10px; /* Add some space between search box and user info */
}
.form_margin
{
  margin-right:30px;
}
.anchor{
    text-decoration: none;
    color: #000; 
    background: #00edb2;
    padding: 5px 16px;
    display: inline-block;
    border-radius: 3px;
      
   }  
   .anchor:hover
   {
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
   }

/* button */


  </style>
</head>

<body>
  <header class="header">
    <!-- Left section -->
    <div class="left-section">
      <a href="#" class="anchor">Home</a>&nbsp;
      <a href="../view/change_password.php" class="anchor">Change Password</a>&nbsp;
      <a href="../view/update_profile.php" class="anchor">Update Profile</a>&nbsp;
    </div>

    <!-- Middle section -->
    <div class="student-portal">Teacher Portal</div>

    <!-- Right section -->
    <div class="right-section">

            <form action="search.php" method="get" class="form-control form_margin" style='background-color: transparent !important;border:0px'>
            <input type="search" name="value" class="" placeholder="Search">
            <button type="submit" name="search" class="search-btn" value="search_by_teacher">Search</button>
          </form>


    <img src="../view/img/<?php echo $user['image'] ?>" alt="Image" class="user-image rounded-circle" height="50px" width="60px"> &nbsp;
    &nbsp;<span class="user-name"> <?php echo $user['fullname'] ?></span>&nbsp;&nbsp;
      <a href="../view/logout.php"> <button class="btn btn-danger logout-btn">Logout</button></a>
    </div>
  </header>
<br><br>
  <center>
    <!-- --------------------------------------------------------DASHBOARD FOR TEACHER------------------------------------- -->

    <br>
    <a class="link-light" href="add_course.php"><Button class='add_button btn btn-success'>Add Course</Button></a>
    <br><br>
    <a class="link-light" href="view_payment.php"><Button class='add_button btn btn-danger'>View Payments</Button></a>
    </center>
  <!-- Bootstrap 5 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>





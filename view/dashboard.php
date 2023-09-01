<?php

require_once '../model/User.php';
require_once '../model/Enrolled.php';
include_once '../model/payment.php';
include_once '../model/course_progress.php';


 
    session_start();
    if(isset($_SESSION['id']))
    {
      if($_SESSION['role']=='teacher')
      {
        header('location:../admin/dashboard_teacher.php');
      }
    }
    else
    {
      header('location:login.php');
    }

$u = new User();
$user = $u->GetUserDetail($_SESSION['id']);

    
$e= new Enrolled();
$result = $e->student_enrolled();

$pay = new Payment();
$payment = $pay->view_payment($_SESSION['id']);

$cp = new Course_Progress();
// $progress = $cp->fetch_progress($_SESSION['id']);


if(isset($_POST['request_certificate']))
{
  $cp->request_certificate($_POST['course_id']);
  exit;
}


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
      background-color: #f8f9fa;
      /* background-image:url('img/background.png'); */
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
.search_button
{
  width: 80px;
  height: 40px;
  cursor: pointer;
  background: transparent;
  border: 1px solid #91C9FF;
  outline: none;
  transition: 1s ease-in-out;
}
.search_button:hover {
  transition: 1s ease-in-out;
  background: #4F95DA;
}
.search_box
{
  height:37px;
  width: 216px;
  border:0px;
  border-radius:8px 8px 8px 8px;
  filter:  drop-shadow(1px 3px 5px grey);
  
}

.anchor{
    text-decoration: none;
    color: #000; 
    background: #00edb2;
    padding: 5px 16px;
    display: inline-block;
    border-radius: 3px;
   }  
  
  </style>
</head>

<body>
  <header class="header">
    <!-- Left section -->
    <div class="left-section">
      <a href="#" class="anchor">Home</a>&nbsp;
      <a href="change_password.php" class="anchor">Change Password</a>&nbsp;
      <a href="update_profile.php" class="anchor">Update Profile</a>&nbsp;
    </div>

    <!-- Middle section -->
    <div class="student-portal">Student Portal</div>

    <!-- Right section -->
    <div class="right-section">
    <div id="search_box">
            <form action="search.php" method="get" class="form-control" style='background-color: transparent !important;border:0px'>
            <input type="search" name="value" class="search_box " placeholder="Search">
            <button type="submit" name="search" class="search_button" value="search_by_student">Search</button>
          </form>
  </div>
  <div>
    <img src="img/<?php echo $user['image'] ?>" alt="Image" class="user-image rounded-circle" height="50px" width="60px"> &nbsp;
    &nbsp;<span class="user-name"> <?php echo $user['fullname'] ?></span>&nbsp;&nbsp;
      <a href="logout.php"> <button class="btn btn-danger logout-btn">Logout</button></a>
    </div>
    </div>
  </header>

  <center>
    
 <br><h3 class="display-6" style="filter: drop-shadow(3px 3px 2px green);"> Your Course</h3>

 <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a href="view_notice.php" class="link-light"><button class="btn btn-warning me-md-2" type="button"><img src="img/notice.png" height="22px" width="22px"> View Notices</button></a>
</div>
    <br>
      <table class="table ">
      <thead class="thead-dark"> 
        <tr> <th class="col">Course Name</th><th class="col">Price</th><th class="col">Assigned By</th><th class="col">Action</th><th>Status</th></tr>
      <?php

        foreach($result as $value)
        {
        echo "<tr><td>$value[coursename]</td><td>$value[price]</td><td>$value[fullname]</td><td><a href='view_course_enrolled.php?id=$value[course_id]'><button class='btn btn-outline-info'>View</button></a>&nbsp;<a href='../admin/view_comment.php?id=$value[course_id]'><button class='btn btn-outline-primary'>View Comments</button></a></td>";
        if($value['status']=='p')
        {
          echo "<td><button class='btn btn-warning'>Pending</button></td></tr>";  
        }
        else if($value['status']=='r')
        {
          echo "<td><a href='update_payment.php?id=$value[course_id]&price=$value[price]'><button class='btn btn-outline-danger'>Rejected</button></a></td></tr>";

        } else if($value['status']=='a')
        {
            if($value['progress']=='100')
          {
            if($value['certificate']==NULL)
            {
             echo  "<form action='' method='post'>
                  <input type='number' name='course_id' value='$value[course_id]' hidden>
             <td><input type='submit' class='btn btn-outline-success' name='request_certificate' value='Request Certificate'></td></tr>
              </form>";
             
             
            }
            else if($value['certificate']=='Requested')
            {
              echo "<td><button class='btn btn-outline-success'>Requested</button></td></tr>";
        
            }
            else if($value['certificate']!='Requested')
            {
              echo "<td><a href='img/$value[certificate]' target='_blank'><button class='btn btn-outline-dark'>Download Certificate</button></a></td></tr>";
              
            }
          }
          else
          echo "<td><a href='start_course.php?id=$value[course_id]'><button class='btn btn-outline-primary'>Start Course</button></a></td></tr>";
        }
        else
        {
          echo "<td><a href='payment.php?id=$value[course_id]&price=$value[price]'><button class='btn btn-outline-success'>Payment</button></a></td></tr>";
        }
        

        }

      ?>
  </center>
  

  <!-- Bootstrap 5 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>






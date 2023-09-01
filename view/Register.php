<?php
// require_once '../controller/UserController.php';
require_once '../controller/UController.php';
require_once '../controller/Validation.php';

$user = new UserController();
$valid = new Validation();



// session_start();
if(isset($_SESSION['id']))
{
  if($_SESSION['role']=='student')
  {
    header('location:dashboard.php');
    exit;
  }
  else
  {
    header('location:dashboard_teacher.php');
    exit;
  }
}

if(isset($_POST['register_user']))
{
  $error['role'] = $valid->role($_POST['role']);
$error['fullname']= $valid->fullname($_POST['fullname']);
$error['mob']=$valid->mob($_POST['mob']);
$error['dob']=$valid->dob($_POST['dob']);
$error['hobbies']=$valid->hobbies($_POST['student_list']);
$error['address']=$valid->address($_POST['address']);
$error['password']=$valid->password($_POST['password']);
$error['hobbies']=$valid->hobbies($_POST['hobbies']);

// print_r($error);

$ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
$valid_ext=array('jpg','jpeg','png');

if(in_array($ext,$valid_ext)===TRUE)
{
  if(empty($error['role']) && empty($error['fullname']) && empty($error['mob']) && empty($error['dob']) && empty($error['address']) && empty($error['password']) && empty($error['hobbies']))
  {
    $filesave=date("Ymdhis");
    move_uploaded_file($_FILES['image']['tmp_name'],'./img/'.$filesave.'.'.pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
    $user->register($_POST,$filesave.'.'.pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));

  }
}
if(empty($_FILES['image']['tmp_name']))
{

 $error['image']="Invalid Image";


}
 
}







?>

<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Registration</title>
    <style>
    .gradient-custom {
/* fallback for old browsers */
background: #f093fb;


/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1))
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}
.card-registration .select-arrow {
top: 13px;
}
.hobbies
{
  font-size:20px;
}
span
{
  color:red;
}
    </style>
  </head>
  <body>


  <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
            <form action="" method="post" enctype='multipart/form-data'>
            <div class="row">
                <div class="col-12">
                <?php if(!empty($error['role'])) echo "<span>$error[role]</span>"; ?>
                  <select class="select form-control-lg" name="role">
                    <option class="" >Select Role</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
        
                  </select >
                  <!-- <label class="form-label select-label">Select Role</label> -->

                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                  <?php if(!empty($error['image'])) echo "<span>$error[image]</span>"; ?>
                    <input type="file" id="email" name="image" class="form-control form-control-lg <?php if(!empty($error['image'])) echo 'is-invalid';?>" />
                    <label class="form-label" for="image">Profile Pic</label>
                   
                  </div>

                </div>
<br>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                  <?php if(!empty($error['fullname'])) echo "<span>$error[fullname]</span>"; ?>
                    <input type="text" id="email" name="fullname" class="form-control form-control-lg   <?php if(!empty($error['fullname'])) echo 'is-invalid'; ?>" />
                    <label class="form-label" for="Fullname">Full Name</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="email" id="lastName" name="email" class="form-control form-control-lg" />
                    <label class="form-label" for="Email">Email</label>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">

                  <div class="form-outline datepicker w-100">
                  <?php if(!empty($error['dob'])) echo "<span>$error[dob]</span>"; ?>
                    <input type="date" class="form-control form-control-lg  <?php if(!empty($error['fullname'])) echo "is-invalid"; ?>" name="dob" id="birthdayDate" />
                    <label for="birthdayDate" class="form-label">Date Of Birth</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <h6 class="mb-2 pb-1">Gender: </h6>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                      value="m"  />
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="maleGender"
                      value="f" />
                    <label class="form-check-label" for="femaleGender">Female</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="otherGender"
                      value="o" />
                    <label class="form-check-label" for="otherGender">Other</label>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                  <?php if(!empty($error['address'])) echo "<span>$error[address]</span>"; ?>
                    <textarea name="address" id="" cols="30" rows="5" class="form-control  <?php if(!empty($error['address'])) echo "is-invalid"; ?>"></textarea>
                    <label class="form-label" for="Fullname">Address</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                  <?php if(!empty($error['mob'])) echo "<span>$error[mob]</span>"; ?>
                    <input type="number" id="lastName" name="mob" class="form-control form-control-lg  <?php if(!empty($error['mob'])) echo "is-invalid"; ?>" />
                    <label class="form-label" for="mobile">Mobile No</label>
                  </div>

                </div>
               
              </div>
              <?php if(!empty($error['hobbies'])) echo "<span>$error[hobbies]</span>"; ?>
              <div class="hobbies">
              
                Hobbies : <input type="checkbox" name="hobbies[]" value="cricket"class="form-check-input   <?php if(!empty($error['hobbies'])) echo "is-invalid"; ?>"> Cricket 
      <input type="checkbox" name="hobbies[]" value="football" class="form-check-input   <?php if(!empty($error['hobbies'])) echo "is-invalid"; ?>"> Football 
      <input type="checkbox" name="hobbies[]" value="hockey" class="form-check-input   <?php if(!empty($error['hobbies'])) echo "is-invalid"; ?>"> Hockey<br>
                </div>
              <br><br>
              <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                  <?php if(!empty($error['password'])) echo "<span>$error[password]</span>"; ?>
                    <input type="password" id="emailAddress" name="password" class="form-control form-control-lg  <?php if(!empty($error['password'])) echo "is-invalid"; ?>" />
                    <label class="form-label" for="emailAddress">Password</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                  <?php if(!empty($error['password'])) echo "<span>$error[password]</span>"; ?>
                    <input type="password" id="emailAddress" name="cpassword" class="form-control form-control-lg <?php if(!empty($error['password'])) echo "is-invalid"; ?>" />
                    <label class="form-label" for="emailAddress">Confirm Password</label>
                  </div>

                </div>
              </div>

          
              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" name="register_user" type="submit" value="Submit" />
              </div>

            </form>

          </div>
          <center><span>Already have an account ?</span><br>  
            <a href="login.php"><button class="btn btn-primary">Login</button></a></center>
        </div>
      </div>
    </div>
  </div>
  

</section>

</body>
</html>

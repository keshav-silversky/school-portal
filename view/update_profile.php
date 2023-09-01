<?php

require_once '../model/User.php';
require_once '../controller/UController.php';
require_once '../controller/Validation.php';

$u_controller = new UserController();
$valid = new Validation();

// session_start();
if(isset($_SESSION['id']))
{

}
else
{
  header('location:login.php');
  exit;
}
$u = new User();
$user = $u->GetUserDetail($_SESSION['id']);


///////////////



if(isset($_POST['update_profile']))
{

   
 if($_FILES['image']['error']!=4)
  {
 
   
        $error['role'] = $valid->role($_POST['role']);
        $error['fullname']= $valid->fullname($_POST['fullname']);
        $error['mob']=$valid->mob($_POST['mob']);
        $error['dob']=$valid->dob($_POST['dob']);
        $error['hobbies']=$valid->hobbies($_POST['student_list']);
        $error['address']=$valid->address($_POST['address']);
        $error['hobbies']=$valid->hobbies($_POST['hobbies']);
        $ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
        $valid_ext=array('jpg','jpeg','png');
        

        if(in_array($ext,$valid_ext)===TRUE)
        {
           if(empty($error['role']) && empty($error['fullname']) && empty($error['mob']) && empty($error['dob']) && empty($error['address']) && empty($error['hobbies']))
           {
            $filesave=date("Ymdhis");
            move_uploaded_file($_FILES['image']['tmp_name'],'./img/'.$filesave.'.'.pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
            $hobbies=implode('-',$_POST['hobbies']);
            $u_controller->update_profile($_POST,$hobbies,$filesave.'.'.pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
            } 
        }
          else
          {
      $error['image']="Invalid Image";
          }
      }
  else
  {
  
    $error['fullname']= $valid->fullname($_POST['fullname']);
    $error['mob']=$valid->mob($_POST['mob']);
    $error['dob']=$valid->dob($_POST['dob']);
    $error['hobbies']=$valid->hobbies($_POST['hobbies']);
    $error['address']=$valid->address($_POST['address']);
    $error['hobbies']=$valid->hobbies($_POST['hobbies']);
 
    if( empty($error['fullname']) && empty($error['mob']) && empty($error['dob']) && empty($error['address']) && empty($error['hobbies']))
    {
     
      $hobbies=implode('-',$_POST['hobbies']);
      $u_controller->update_profile_without_image($_POST,$hobbies);

    }

    
  }
  }




///////////////



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
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Update Profile</h3>
            <form action="" method="post"  enctype='multipart/form-data'>
            <div class="row">
                <div class="col-12">

                  <select class="select form-control-lg" name="role" style="-webkit-appearance: none;" value="<?php echo $user['role'] ?>" disabled>
                  <option value="" readonly><?php echo $user['role']; ?></option>
                  </select >
               

                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                  <input type="file" id="email" name="image" class="form-control form-control-lg" >
                    <label class="form-label" for="image">Profile Pic</label>
                   
                  </div>

                </div>
<br>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                  <?php if(!empty($error['fullname'])) echo '<span>Enter Fullname</span>' ?>
                    <input type="text" id="email" name="fullname" class="form-control form-control-lg <?php if(!empty($error['fullname'])) echo 'is-invalid' ?>" value="<?php echo$user['fullname']; ?>"/>
                    <label class="form-label" for="Fullname">Full Name</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="email" id="lastName" name="" class="form-control form-control-lg" value="<?php echo$user['email']; ?>" readonly/>
                    <label class="form-label" for="Email">Email</label>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">

                  <div class="form-outline datepicker w-100">
                  <?php if(!empty($error['dob'])) echo '<span>Select DOB</span>' ?>
                    <input type="date" class="form-control form-control-lg <?php if(!empty($error['dob'])) echo 'is-invalid' ?>" name="dob" id="birthdayDate" value="<?php echo$user['dob']; ?>"/>
                    <label for="birthdayDate" class="form-label">Date Of Birth</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <h6 class="mb-2 pb-1">Gender: </h6>

                  <div class="form-check form-check-inline">
                
                    <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                      value="m" <?php if($user['gender']=='m')
                    echo "checked";
                    ?> />
                    <label class="form-check-label" for="maleGender" >Male</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="maleGender"
                      value="f"  <?php if($user['gender']=='f')
                    echo "checked";
                    ?>/>
                    <label class="form-check-label" for="femaleGender" >Female</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="otherGender"
                      value="o"  <?php if($user['gender']=='o')
                    echo "checked";
                    ?>/>
                    <label class="form-check-label" for="otherGender">Other</label>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                  <?php if(!empty($error['address'])) echo '<span>Enter Address</span>' ?>
                    <textarea name="address" id="" cols="30" rows="5" class="form-control <?php if(!empty($error['address'])) echo 'is-invalid' ?>"><?php echo$user['address']; ?></textarea>
                    <label class="form-label" for="Fullname">Address</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                  <?php if(!empty($error['mob'])) echo '<span> Invalid Mobile Number</span>' ?>
                    <input type="number" id="lastName" name="mob" class="form-control form-control-lg <?php if(!empty($error['mob'])) echo 'is-invalid' ?>" value="<?php echo$user['mob']; ?>" />
                    <label class="form-label" for="mobile">Mobile No</label>
                  </div>

                </div>
               
              </div>
              <?php if(!empty($error['hobbies'])) echo '<span>Select Hobbies</span>' ?>
              <div class="hobbies">
          
                Hobbies : <input type="checkbox" name="hobbies[]" value="cricket"class="form-check-input <?php if(!empty($error['hobbies'])) echo 'is-invalid' ?>"
                 <?php $hobbies = explode('-',$user['hobbies']);
                if(in_array('cricket',$hobbies))
                {
                echo "Checked";

                }
                
                
                ?>> Cricket 
      <input type="checkbox" name="hobbies[]" value="football" class="form-check-input <?php if(!empty($error['hobbies'])) echo 'is-invalid' ?>"  <?php $hobbies = explode('-',$user['hobbies']);
                if(in_array('football',$hobbies))
                {
                echo "Checked";
                }
                
        
                ?>> Football 
      <input type="checkbox" name="hobbies[]" value="hockey" class="form-check-input <?php if(!empty($error['hobbies'])) echo 'is-invalid' ?>"  <?php $hobbies = explode('-',$user['hobbies']);
                if(in_array('hockey',$hobbies))
                {
                echo "Checked";
                }
                
                
                ?>> Hockey <span class="error"></span><br>
                </div>
              <br><br>
             
              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" name="update_profile" type="submit" value="Update" />

           
              </div>

            </form>
      
         
          </div>
          <center>
            <a href="dashboard.php"><button class='btn btn-primary'>Back To Dashboard</button></a>
            </center>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
<?php
error_reporting(E_ALL & ~E_WARNING);
require_once '../model/User.php';
include_once 'Validation.php';
session_start();

$valid = new Validation();

$error['role'] = $valid->role($_POST['role']);
// $error['image'] = $valid->image($_FILES['image']);
$error['fullname']= $valid->fullname($_POST['fullname']);
$error['mob']=$valid->mob($_POST['mob']);
$error['dob']=$valid->dob($_POST['dob']);
$error['address']=$valid->address($_POST['address']);
$error['password']=$valid->password($_POST['password']);
$error['hobbies']=$valid->hobbies($_POST['hobbies']);
$user = new User();

// echo "<pre>";
// print_r($error);
// exit;

// if(isset($_POST['register_user']))
// {
//   $file_save="";
//   $extension="";
//     if($_FILES['image']['error']!=4)
    
//   {
//       $filename = $_FILES['image']['name'];
//       $tmp_name = $_FILES['image']['tmp_name'];
//       $extension = pathinfo($filename,PATHINFO_EXTENSION);
//       $valid_image = array('png','jpg','jpeg');
//           $file_save=date('Ymdhis');
//               if(in_array($extension,$valid_image))
//                 {
//                     move_uploaded_file($tmp_name,'../view/img/'.$file_save.".".$extension);
//                 }
//    }
//    else
//    {
//     header('location:../view/register.php');
//    }


//   if(empty($error['role']) && empty($error['fullname']) && empty($error['mob']) && empty($error['dob']) && empty($error['address']) && empty($error['password']) && empty($error['hobbies']) && !empty($file_save))
//     {
     
//       $data = $user->register($_POST,$file_save.".".$extension);
//      session_start();
//      $_SESSION['id']=$data['id'];
//      $_SESSION['role']=$data['role'];

//      echo $_SESSION['role'];

//      if($_SESSION['role']=='student')
//      {
//      header('location:../view/dashboard.php');
//      }
//      else
//      {
//       header('location:../admin/dashboard_teacher.php');
//      }
//     }
//     else
//     {
//       header('location:../view/register.php');
     
//     }
    

// }

///////////////////////////////////////////////
if(isset($_POST['login']))
{
  $data = $user->login($_POST);  
    if(!empty($data))
    {
     session_start();
     $_SESSION['id']=$data['id'];
     $_SESSION['role']=$data['role'];
     if($_SESSION['role']!='teacher')
     {
     header('location:../view/dashboard.php');
     }
     else
     {
      header('location:../admin/dashboard_teacher.php');
     }
    }
    else
    {
      header('location:../view/login.php');
    }
    
}
////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////
if(isset($_POST['change_password']))
{
 $password = $user->fetch_password($_SESSION['id']);

 if($password['password']==md5($_POST['current_password']))
 {
  if(strlen($_POST['new_pass']) >= '8')
  {
    if($_POST['new_pass']==$_POST['c_new_pass'])
    {
      $user->change_password(md5($_POST['new_pass']),$_SESSION['id']);
    }
    else
    {
      // echo "<script>alert('New Password Not Matching');</script>";
      $error = array('new_pass_error'=>'New Password Not Matching');
      $errorMessage = http_build_query($error);
      echo "<script>window.location='../view/change_password.php?$errorMessage';</script>";

    }

  }
  else
  {
    $error = array('short_pass_error'=>'New Password Not Matching');
    $errorMessage = http_build_query($error);
    echo "<script>window.location='../view/change_password.php?$errorMessage';</script>";
  }

 }
 else
 {
  $error = array('curr_pass_error'=>'New Password Not Matching');
  $errorMessage = http_build_query($error);
  echo "<script>window.location='../view/change_password.php?$errorMessage';</script>";
 }
 

}
//////////////////////////////////////

$filesave;
if(isset($_POST['update_profile']))
{
  // foreach ($_POST as $value)
  // {
  //   if(empty($value))
  //   {
  //       echo "<script>alert('Not Update With Blank Fields');
  //       window.location.replace('../view/update_profile.php');</script>";
  //     exit();   
  //   }
  // }
  $error=NULL;

//   $error['role'] = $valid->role($_POST['role']);
// // $error['image'] = $valid->image($_FILES['image']);
$error['fullname']= $valid->fullname($_POST['fullname']);
$error['mob']=$valid->mob($_POST['mob']);
$error['dob']=$valid->dob($_POST['dob']);
$error['address']=$valid->address($_POST['address']);
// $error['password']=$valid->password($_POST['password']);
$error['hobbies']=$valid->hobbies($_POST['hobbies']);

foreach ($error as $er)
{
  $string = http_build_query($error);
  if(!empty($er))
  {
    echo "<script>alert('Invalid Fields')</script>";
    echo "<script>window.location='../view/update_profile.php?$string';</script>";
    exit;

  }
}

  if($_FILES['image']['error']!='4')
  {
    $ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
    $valid_ext= array('jpg','jpeg','png');

    if(in_array($ext,$valid_ext)===TRUE)
    {
      $filesave=date('Ymdhis');
      move_uploaded_file($_FILES["image"]["tmp_name"], "../view/img/".$filesave.'.'.pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
      $hobbies=implode('-',$_POST['hobbies']);
    
      if($user->update_profile($_POST,$hobbies,$filesave.'.'.pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION))==true)
      {
        echo "<script>alert('Successfully Profile Updated');
        window.location='../view/dashboard.php'</script>";
      }
      else

      {
        echo "Profile Not Update";
      }
    }
    else
    {
      echo "invalid format";
    }
    
    
  }
  else
  {
    $hobbies=implode('-',$_POST['hobbies']);
    if($user->update_profile_without_image($_POST,$hobbies))
    {
      echo "<script>alert('Updated Successfully');
      window.location='../view/dashboard.php';</script>";

    }
    
  }
}




?>
<!-- 
if(isset($_POST['change_password']))
{
  $password = $user->fetch_password($_SESSION['id']);
  if($password['password']==md5($_POST['current_password']))
  {
    if(strlen($_POST['new_pass']) >= '8')
    {
      if($_POST['new_pass']==$_POST['c_new_pass'])
      {
        $user->change_password(md5($_POST['new_pass']),$_SESSION['id']);

      }
      else
      {
        echo "<script>alert('New Password Not Matching');</script>";
        echo "<script>window.history.back();</script>";

      }


    }
    else
    {
      echo "<script>alert('Too Short Password');</script>";
    echo "<script>window.history.back();</script>";

    }


  }
  else
  {
    echo "<script>alert('Wrong Current Password');</script>";
    echo "<script>window.history.back();</script>";
  }


}
else
{
  echo "<script>alert('No Password');</script>";
  echo "<script>window.history.back();</script>";
} -->
<?php
// error_reporting(E_ALL & ~E_WARNING);
require_once '../model/User.php';
include_once 'Validation.php';
session_start();

class UserController
{

 
  public static function change_password($data)
  {
  $user = new User();
    $result = $user->change_password($data,$_SESSION['id']);
    if($result==TRUE)
    {
      echo "<script>alert('Password Changed Successfully')</script>";
      echo "<script>window.location='../view/dashboard.php';</script>";
      exit;
    }
    else
    {
      echo "<script>alert('Something Went Wrong')</script>";
      echo "<script>window.location='../view/dashboard.php';</script>";
    }
  }
  public function login($data)
  {
    $user = new User();
  $result = $user->login($data);  
    if(!empty($data))
    {
     session_start();
     $_SESSION['id']=$result['id'];
     $_SESSION['role']=$result['role'];
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

  public function Register($data,$filename)
  {
 
    $user = new User();
    $result = $user->register($data,$filename);
    if($result==false)
    {
      header('location:../view/register.php');
      exit;
    }
    else
    {
         session_start();
         $_SESSION['id']=$result['id'];
         $_SESSION['role']=$result['role'];

         if($_SESSION['role']=='student')
         {
         header('location:../view/dashboard.php');
         }
         else
         {
          header('location:../admin/dashboard_teacher.php');
         }
     
     }
    }
    public function update_profile($data,$hobbies,$filename)
    {
      print_r($data);
      exit;
      $user = new User();
      $result = $user->update_profile($data,$hobbies,$filename);

      print_r($result);
      exit;

    }
    public function update_profile_without_image($data,$hobbies)
    {
  
      $user = new User();
      $result = $user->update_profile_without_image($data,$hobbies);
      if($result==true)
      {
        echo "<script>alert('Updated Successful');
              window.location.replace('../view/dashboard.php');</script>";
            exit();   
      }

    }
}

?>
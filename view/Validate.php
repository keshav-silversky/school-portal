<?php

Class Validate
{


  function role()
  {
    if(is_null($_POST['role']))
    {
      echo "Select Option";
    }
  
  }
  function image()
  {
    if($_FILES['image']['error']=='4')
    {
      echo "Select Image";
    }
  }
  
  
    function fullname()
  {
    $valid_name = "/[a-zA-Z]+$/";
  
    if(preg_match($valid_name,$_POST['fullname'])) // || !empty($_POST['fullname'])
    {
      // echo "Valid Name";
    }
    else
    {
      echo "Please Enter Valid Name";
    }
  
  } // End Valid_fullname Function
  function mob()
  {
    
    if(strlen($_POST['mob']) == 10)
    {
      // echo "Valid";
    }
    else
    {
      echo "Invalid Number";
    }
  } // End Mob function
  function dob()
  {
    if(is_null($_POST['dob']))
    {
      echo "Select Date of Birth";
  
    }
    else
    {
      // var_dump($_POST['dob']);
    }
  
  }
  
  function address()
  {
    if(strlen($_POST['address']) <= 200 && !empty($_POST['address']))
    {
      // echo strlen($_POST['address']);
    }
    else
    {
      echo "Invalid Address";
    }
  } // End Function Address
  
  function gender()
  {
    if(!empty($_POST['gender']))
    {
      // echo "valid";
    }
    else
    {
      echo "Invalid Gender";
    }
  } // End Gender
  
  function password()
  {
    $pass_valid = '/[a-zA-Z0-9@#$_]{8,}$/';
  
    if(strlen($_POST['password']) >= 8)
    {
    if(preg_match($pass_valid,$_POST['password']) && !empty($_POST['password']))
    {
      // echo "valid";
    }
    else
    {
      echo "Invalid Password";
    }
  }
  else
  {
    echo "Too Short Password";
  }
  
  } // end password
  
  function hobbies()
  {
    if(is_null($_POST['hobbies']))
    {
      echo "Select Hobbies";
    }
  }
  function card_detail()
{
  if(strlen($_POST['card_detail'])!='16' || empty($_POST['card_detail']))
  {
    echo "Invalid Card Number";
  }
}
function cvv()
{
  if(strlen($_POST['cvv'])!='3' || empty($_POST['cvv']))
  {
    echo "Invalid CVV";
  }
}
function exp_date()
{
  if(empty($_POST['exp_date']))
  {
    echo "Select Card Expire Date";
  }
}
}
?>
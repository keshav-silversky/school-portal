<?php

Class Validation
{


  function email($email)
  { 
    if(empty($email))
      return "Invalid Email";
    }
  function role($role)
  {
    if(empty($role))
    {
      return "Select Option";
    }
  
  }
  function image($image)
  {
    if($_FILES['image']['error']=='4')
    {
      echo "Select Image";
    }
  }
  
  
    function fullname($fullname)
  {
    $valid_name = "/[a-zA-Z]+$/";
  
    if(preg_match($valid_name,$fullname)) // || !empty($_POST['fullname'])
    {
      // echo "Valid Name";
    }
    else
    {
      return "Please Enter Valid Name";
    }
  
  } // End Valid_fullname Function
  function mob($mob)
  {
    
    if(strlen($mob) != 10)
    {
      return "Invalid Number";
    }
  
  } // End Mob function

  function dob($dob)
  {
    if(empty($dob))
    {
      return "Select Date of Birth";
  
    }
  
  }
  
  function address($address)
  {
    if(!strlen($address) <= 200 && empty($address))
    {
      return "Invalid Address";
    }

  } // End Function Address
  
  function gender($gender)
  {
    if(empty($gender))
    {
      return "Invalid Gender";
    }
  
  } // End Gender
  
  function password($password)
  {
    $pass_valid = '/[a-zA-Z0-9@#$_]{8,}$/';
  
    if(strlen($password) >= 8)
    {
    if(preg_match($pass_valid,$password) && !empty($password))
    {
      // echo "valid";
    }
    else
    {
      return "Invalid Password";
    }
  }
  else
  {
    return "Too Short Password";
  }
  
  } // end password
  
  function hobbies($hobbies)
  {
   if(is_null($hobbies))
   return "Select at least one Hobbies";
  }
  function card_detail($card_detail)
  {
    if(strlen($card_detail)!='16' || empty($card_detail))
    {
      return "Invalid Card Number";
    }
  }
  function cvv($cvv)
  {
    if(strlen($cvv)!='3' || empty($cvv))
    {
      return "Invalid CVV";
    }
  }
  function exp_date($exp_date)
  {
    if(empty($exp_date))
    {
      return "Select Card Expire Date";
    }
  }
  function detail($detail)
  {
    if(strlen($detail) >= 200 || empty($detail))
    {
      return "Invalid Detail";
    }

  } // End Function detail

  function comment($comment)
  {
    if(strlen($comment) >= 200 || empty($comment))
    {
      return "Invalid Comment";
    }

  } // End Function Address


}
?>
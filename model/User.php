<?php

require_once '../model/connection.php';

class User extends Database
{

  public function register($data,$file_save)
  {
  $conn = $this->connection;
    // id	role	image	fullname	email	mob	dob	address	gender	hobbies	password	
    $hobbies = implode('-',$data['hobbies']);
    $password = md5($data['password']);
    $sql = "insert into user(role,image,fullname,email,mob,dob,address,gender,hobbies,password) values ('$data[role]','$file_save','$data[fullname]','$data[email]','$data[mob]','$data[dob]','$data[address]','$data[gender]','$hobbies','$password')";


    if($conn->query($sql))
    {
      $fetch = $conn->query("select id,role from user where email='$data[email]'");
      return $fetch->fetch_assoc(); 
    }
    else
    {
      return false;
    }
  }

  public function Login($data)
  {
    $password=md5($data['password']);
    $conn = $this->connection;
    $sql = "select id,role,image from user where email='$data[email]' and password='$password'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();

  }

  public function GetUserDetail($id)
  {
    $conn=$this->connection;
    $sql = "select * from user where id='$id'";
    $result=$conn->query($sql);
    return $result->fetch_assoc();
    
  }
  public function getStudent()
  {
    $conn=$this->connection;
    $sql="select id,fullname,image from user where role='student'";
    $result = $conn->query($sql);
    if($result)
    {
      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }
  public function fetch_password($id)
  {
    $conn = $this->connection;
    $sql = "select password from user where id='$id'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
  }
  public function change_password($new_pass,$id)
  {
    $conn=$this->connection;
    $sql = "update user set password='$new_pass' where id='$id'";
    if($conn->query($sql))
    {
    return true;
    }
    else
    {
      return false;
    }
  }
  public function update_profile($data,$hobbies,$filename)
  {
    // print_r($data);
    // exit;
    $conn=$this->connection;
    $sql = "update user set image='$filename',fullname='$data[fullname]',dob='$data[dob]',gender='$data[gender]',address='$data[address]',mob='$data[mob]',hobbies='$hobbies' where id='$_SESSION[id]'";
 if($conn->query($sql))
 {
  return true;
 }
  }
  
  public function update_profile_without_image($data,$hobbies)
  {
    $conn=$this->connection;
    $sql = "update user set fullname='$data[fullname]',dob='$data[dob]',gender='$data[gender]',address='$data[address]',mob='$data[mob]',hobbies='$hobbies' where id='$_SESSION[id]'";
 
 if($conn->query($sql))
 {
  return true;
 }
  }

}
// $user = new User();

// $user->register();


?>
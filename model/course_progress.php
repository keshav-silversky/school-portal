<?php
require_once 'connection.php';
session_start();
define("CERTIFICATE","Requested");
class Course_Progress extends Database
{
  public function progress($data)
  {
    $conn=$this->connection;
    $sql="replace into course_progress set student_id='$_SESSION[id]',course_id='$data[course_id]',progress='$data[progress]'";
    try{
      ($conn->query($sql));
      header("location:../view/dashboard.php");
    }
    catch(Exception $e)
    {
      echo "<script>alert('Cannot Update Progress')
      window.location='../view/dashboard.php'</script>";
    }
  }
  public function get_progress($course_id)
  {
    $conn=$this->connection;
    $sql = "select progress from course_progress where student_id='$_SESSION[id]' and course_id='$course_id'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
  }
  public function request_certificate($course_id)
  {
    $conn=$this->connection;
    $value=CERTIFICATE;
    $sql = "update course_progress set certificate='$value' where student_id='$_SESSION[id]' and course_id='$course_id'";
    if($conn->query($sql))
    {
      header('location:../view/dashboard.php');
    }
    else
    {
      echo "<script>alert('Error');
       window.history.back();</script>";
    }
  }

  public function get_certificate($course_id)
  {
    $conn=$this->connection;
    $value=CERTIFICATE;

    $sql = "select p.id,u.fullname,c.coursename,p.progress from course_progress p inner join enrolled e on e.course_id=p.course_id inner join user u on u.id=p.student_id inner join courses c on c.id=p.course_id where c.teacher_id='$_SESSION[id]' and p.student_id=e.student_id and p.progress='100' and p.certificate = '$value' and p.course_id='$course_id'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);

  }
  public function upload_certificate($data,$certificate)
  {
    $conn=$this->connection;
    $sql = "update course_progress set certificate='$certificate' where id='$data[progress_id]'";
    try
    {
      ($conn->query($sql));
     return true;
    }
    catch(Exception $e)
    {
      return false;
    }

  }
}




?>
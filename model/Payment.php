<?php
require_once 'connection.php';
error_reporting(0);
session_start();
class Payment extends Database
{
 
  public function store($data,$filename)
  {
    $conn = $this->connection;
    $sql = "insert into payment (student_id,course_id,card_number,cvv,exp_date,amount,pdf,status) values ('$_SESSION[id]','$data[course_id]','$data[card_detail]','$data[cvv]','$data[exp_date]','$data[amount]','$filename','p')";
    
    if($conn->query($sql))
    {
      return true;
    }
    else

    {
      // echo $conn->error;
      header("location:../view/payment.php?id=$data[course_id]&price=$data[amount]");
    }
  }

  public function view_payment($student_id)
  {
    $conn=$this->connection;
    $sql = "select student_id,course_id,status from payment where student_id='$student_id'";
    $result = $conn->query($sql);

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function select_payment($teacher_id)
  {
    $conn = $this->connection;
    $sql = "select u.fullname,c.coursename,p.pdf,p.created_at,p.id from payment p inner join user u on p.student_id=u.id inner join courses c where c.teacher_id='$_SESSION[id]' and p.course_id=c.id and p.status='p' order by p.id desc";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  public function approve_payment($id)
  {
    $conn=$this->connection;
    $sql = "update payment set status='a' where id='$id'";

    if($conn->query($sql))
    {
   
      header("location:view_payment.php");
    }
    else
    {
      echo "hello";
      exit;
      return "<script>alert('$conn->error')</script>";
    }

  }
  public function reject_payment($id)
{
  $conn = $this->connection;
  $sql = "update payment set status='r' where id='$id'";
  if($conn->query($sql))
  {
    header("location:view_payment.php");
  }
  else
  {
    $conn->error;
  }

}
public function update_payment($data,$filename)
{
  // nsert into payment (student_id,course_id,card_number,cvv,exp_date,amount,pdf,status) values ('$_SESSION[id]','$data[course_id]','$data[card_detail]','$data[cvv]','$data[exp_date]','$data[amount]','as','p')"
  $conn=$this->connection;
  $sql = "update payment set card_number='$data[card_detail]',cvv='$data[cvv]',exp_date='$data[exp_date]',amount='$data[amount]',pdf='$filename',status='p' where student_id='$_SESSION[id]' and course_id='$data[course_id]'";
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
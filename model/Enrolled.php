<?php
include_once 'connection.php';
session_start();
class Enrolled extends Database
{

  // public function enroll_student($student_id,$course_id)
  // {
  //   $conn=$this->connection;
  //   $sql = "insert ignore into enrolled(student_id,course_id) values ('$student_id','$course_id')";
  //   if ($conn->query($sql))
  //   {
  //     header("location:../enroll_course.php?id=$course_id");
  //   }

   
    
  // } // End of enroll_student
  public function enroll_student($student_list,$course_id)
  {
    $conn=$this->connection;
    $sql = "insert ignore into enrolled (student_id,course_id) values ".$student_list;
    try
    {
      $conn->query($sql);
      return true;
    }
    catch(Exception $e)
    {
      return false;
    }
   
    
  } // End of enroll_student

  public function getEnrolled($course_id)
    {
      $conn=$this->connection;
      $sql = "select e.id,r.image,r.fullname as student_name ,t.fullname as teacher_name,c.coursename,c.price,cp.progress from courses c inner join enrolled e on e.course_id=c.id inner join user r on r.id=e.student_id inner join user t on t.id=c.teacher_id left join course_progress cp ON e.student_id = cp.student_id AND e.course_id = cp.course_id where e.course_id='$course_id' order by e.id desc";
      $result = $conn->query($sql);
      
      if($result)
      {
        return $result->fetch_all(MYSQLI_ASSOC);
      }


    } // End of getEnrolled
    public function student_enrolled()
{
  $conn=$this->connection;
  // $sql = "SELECT c.coursename ,e.course_id, c.price, r.fullname FROM enrolled e JOIN courses c ON e.course_id = c.id JOIN user r on r.id=c.teacher_id  WHERE e.student_id = '$_SESSION[id]' order by e.id desc";

  // $sql = "SELECT c.coursename,e.course_id,c.price,r.fullname,p.status from enrolled e inner join courses c on e.course_id = c.id left join payment p on e.course_id = p.course_id inner join user r on r.id=c.teacher_id where e.student_id='$_SESSION[id] order by e.id desc'";

  $sql = "SELECT c.coursename,e.course_id,c.price,r.fullname,p.status,cp.progress,cp.certificate from enrolled e inner join courses c on e.course_id = c.id left join payment p on e.course_id = p.course_id and e.student_id=p.student_id left join course_progress cp on cp.student_id=p.student_id and cp.course_id=p.course_id inner join user r on r.id=c.teacher_id where e.student_id='$_SESSION[id]' order by e.id desc";
  $result=$conn->query($sql);
  if($result)
  {
    return $result->fetch_all(MYSQLI_ASSOC);
  }
} // end student_enrolled

public function ViewClassmates()
{
$conn=$this->connection;
$sql = "select r.image,r.fullname,r.email from user r inner join enrolled e on e.student_id=r.id inner join courses c on c.id=e.course_id where e.course_id='$_GET[id]' and r.id!='$_SESSION[id]'";

$result = $conn->query($sql);

if($result)
{
  return $result->fetch_all(MYSQLI_ASSOC);
}


} // End Of ViewClassmates

public function search_by_student($value)
{
  $conn=$this->connection;
  $sql = "select c.coursename,c.price,u.fullname from courses c inner join enrolled e on e.course_id=c.id inner join user u on u.id=c.teacher_id where c.coursename like '%$value%' and e.student_id='$_SESSION[id]' or u.fullname like '%$value%' and e.student_id='$_SESSION[id]'";
$result = $conn->query($sql);
  if($result)
  {
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  else
  {
    return false;
  }
}

public function search_by_teacher($value)
{
  $conn=$this->connection;
  $sql = "select u.fullname, c.coursename,c.price from courses c left join enrolled e on c.id=e.course_id and c.teacher_id='$_SESSION[id]' left join user u on u.id=e.student_id where c.coursename like '%$value%' and c.teacher_id='$_SESSION[id]' or u.fullname like '%$value%' and u.id=e.student_id ";
  // $sql = "select u.fullname,c.course,c.price from "

$result = $conn->query($sql);
  if($result)
  {
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  else
  {
    return false;
  }
}




} 




?>
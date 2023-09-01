<?php
require_once 'connection.php';
session_start();
class Notice extends Database
{
  public function addNotice($data)
  {
    $conn=$this->connection;

    $sql = "insert ignore into notice(subject,detail,course_id) values ('$data[subject]','$data[detail]','$data[course_id]')";
   
    if($conn->query($sql))
    {
     return true;
    }

  }
  public function viewNotice($id,$course_id)
  {
    $conn=$this->connection;
    $sql = "select n.id,n.subject,n.detail from notice n inner join courses c on n.course_id=c.id where c.teacher_id='$id' and n.course_id='$course_id' order by n.id desc";
    $result = $conn->query($sql);

    if($result)
    {
      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }
  public function deleteNotice($id)
  {
    $conn=$this->connection;
    $sql = "delete from notice where id='$id'";
    if($conn->query($sql))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public function view_notice_by_student($id)
  {
    $conn=$this->connection;
    $sql = "select c.coursename,u.fullname,n.subject,n.detail from notice n inner join payment p on n.course_id=p.course_id inner join courses c on c.id=p.course_id inner join user u on c.teacher_id=u.id where p.student_id='$id' and p.status='a'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}



?>
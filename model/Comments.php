<?php
require_once 'connection.php';
session_start();
class Comments extends Database
{
  // public function __construct($data=NULL)
  // {
  //   if(!is_null($data))
  //   {
  //     add_comment($data);
  //   }
  // }
  public function add_comment($data)
  {
    $conn=$this->connection;
    $sql = "insert into comments(user_id,course_id,comment) values ('$_SESSION[id]','$data[course_id]','$data[comment]')";
    try{
      $conn->query($sql);
      return true;
        // throw new Exception("SomeThing Wrong");
    }
    catch (Exception $e)
    {
      return false;
    } 
 
  }
  public function getComment($course_id)
  {
    $conn=$this->connection;
    $sql = "select cmt.id,r.image,cmt.comment,r.fullname,c.coursename from comments cmt inner join courses c on c.id=cmt.course_id inner join user r on cmt.user_id=r.id where cmt.user_id=r.id and cmt.course_id='$course_id' order by cmt.id desc";
    
    $result = $conn->query($sql);
    if($result)
    {
      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }

  public function deleteComment($id)
  {
    $conn=$this->connection;

    $sql = "delete from comments where id='$id'";
    try
    {
      ($conn->query($sql));
      return true;
    }
    catch(Exception $e)
    {
      echo "Comment Cannot Delete";
      return false;
    }

  }
}



?>
<?php
require_once '../model/Comments.php';

class CommentController
{

  private $comment;
  public function __construct() 
    {
      $this->comment=new Comments();


    }

  public function addComment($data)
  {
  
    $result = $this->comment->add_comment($data);

    if($result==TRUE)
    {
      header("location:./view_comment.php?id=$data[course_id]");
      exit;
    }
    else
    {
      echo "<script>alert('Comment Cannot Added');
      window.location='./view_comment.php?id=$data[course_id]';</script>";
      exit;
    }
  }
  public function deleteComment($data)
  {

 $result = $this->comment->deleteComment($data['id']);
 if($result==TRUE)
 {
  header("location:./view_comment.php?id=$data[course_id]");
  exit;
 }
 else
 {
  echo "<script>alert('Comment Cannot Deleted');
  window.location='./view_comment.php?id=$data[course_id]';</script>";
  exit;
 }

  }
}


?>
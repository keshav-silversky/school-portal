<?php
require_once  'connection.php';
session_start();

class Courses extends Database
{
  public function store($data,$image)
  {
    $conn=$this->connection;
    try
    {
    $sql = "insert into courses(teacher_id,coursename,price,image) values ('$_SESSION[id]','$data[name]','$data[price]','$image')";
    $conn->query($sql);
    return true;
  }
  catch(Exception $e)
  {
    return false;
  }
// end Store Function
  }


public function GetCourseDetail()
{
  $conn=$this->connection;

  try
  {
  $sql = "select id,image,coursename,price from courses where teacher_id='$_SESSION[id]' order by id desc";
  $result = $conn->query($sql);
  
  if($result)
  {
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  else
  {
    throw new exception("No Record Found");
  }
}
catch(Exception $e)
{
  echo $e->getMessage();
}
}

public function GetCourse($course_id)
{
  $conn=$this->connection;

  try
  {
  $sql = "select id,image,coursename,price from courses where teacher_id='$_SESSION[id]' and id='$course_id'";
  $result = $conn->query($sql);
  
  if($result)
  {
    return $result->fetch_assoc();
  }
  else
  {
    throw new exception("No Record Found");
  }
}
catch(Exception $e)
{
  echo $e->getMessage();
}
}


public function delete($course_id)
{
  $conn=$this->connection;

  $sql = "delete FROM courses where id='$course_id' and teacher_id='$_SESSION[id]'";
  if($conn->query($sql))
  {
    return true;
  }
  else
  {
    return false;
  }

} // end of delete

public function getCourseForEdit($id)
{
  $conn=$this->connection;
  $sql = "select coursename,price,image from courses where id='$id'";
  $result = $conn->query($sql);
  if($result)
  {
    return $result->fetch_assoc();
  }
}
public function updateCourse($data,$filename)
{
  $conn=$this->connection;

  $sql = "update courses set coursename='$data[name]',price='$data[price]',image='$filename' where id='$data[id]'";
  if($conn->query($sql))
  {
    return true;
  }

} // end of update course

public function updateCourseWithoutImage($data)
{
  $conn=$this->connection;
  $sql = "update courses set coursename='$data[name]',price='$data[price]' where id='$data[id]'";
  if($conn->query($sql))
  {
    return true;
  }
}




} // End Of Class



?>
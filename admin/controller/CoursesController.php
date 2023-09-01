<?php

include_once '../model/Courses.php';
// include_once '../../controller/Validation.php';

// error_reporting(E_ALL & ~E_WARNING);

// $valid = new Validation();

class CoursesController
{
  public function Add_Course($data,$filename)
  {
    $cors = new Courses();
   $result = $cors->store($data,$filename);
   if($result)
   {
    echo "<script>alert('Course Added Successfully')</script>";
    echo "<script>window.location='./add_course.php'</script>";
    exit;
   }

  }
  public function update_course($data,$filename)
  {
    $cors = new Courses();
    $result = $cors->updateCourse($data,$filename);
    if($result)
    {
     echo "<script>alert('Course Update Successfully')</script>";
     echo "<script>window.location='./add_course.php'</script>";
     exit;
    }
  }


}



?>
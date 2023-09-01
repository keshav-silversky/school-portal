<?php

require_once '../../model/Enrolled.php';

$en = new Enrolled();


if(isset($_POST['enroll_student']))
{

  $student_id = $_POST['student_list'];
  $course_id = $_POST['course_id'];
  
// print_r($student_id);
// print_r($course_id);
// exit;
$string = NULL;
  for($i=0;$i<sizeof($student_id)-1;$i++)
  {
    $string.="('$student_id[$i]','$course_id'),";
    
  }
$string.="('$student_id[$i]','$course_id');";


$result = $en->enroll_student($string,$course_id);
if($result==TRUE)
{
  echo "<script>alert('Student Enrolled Successfully');
  window.location='../add_course.php?id=$course_id'</script>";
}
else
{
  echo "<script>alert('Failed');
  window.location='../enroll_course.php?id=$course_id'</script>";


}



}

?>
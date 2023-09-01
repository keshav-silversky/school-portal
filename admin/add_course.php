<?php

// include_once '../model/User.php';
include_once '../model/Courses.php';
require_once './controller/CoursesController.php';


$course = new CoursesController();
class AddCourse
{
  public function __construct()
  {

    if(isset($_SESSION['id']))
    {
      if($_SESSION['role']!='teacher')
      {
        header('location:../view/dashboard.php');
        exit;
      }
    }
    else
    {
      header('location:../view/login.php');
      exit;
    }
  }
}
$add_course = new AddCourse();
$cors = new Courses();

$data = $cors->GetCourseDetail();

/////////////////////
function name($name)
{
  $valid_name = "/[a-zA-Z]+$/";
  
  if(preg_match($valid_name,$name)) // || !empty($_POST['fullname'])
  {
    // echo "Valid Name";
  }
  else
  {
    return "Please Enter Valid Name";
  }

}
function price ($price)
{
  if(strlen($price)<=0)
  {
    return "Enter Number";
  }
}

if(isset($_POST['course_store']))
{
  $error['name']=name($_POST['name']);
  $error['price']=price($_POST['price']);
 
  
  if($_FILES['image']['error']!=4)
  {
    $filename = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $extension = pathinfo($filename,PATHINFO_EXTENSION);
    $valid_image = array('png','jpg','jpeg');
    $file_save= date("Ymdhis");

    if(empty($error['name']) && empty($error['price']))
    {
    if(in_array($extension,$valid_image)==TRUE)
    {
      move_uploaded_file($tmp_name,'../view/img/'.$file_save.".".$extension);
      $course->add_course($_POST,$file_save.'.'.$extension);
      
    }
    else
    {
     $error['image']="Invalid Image Type";
    }

  }
}
  else
  {
    $error['image']="Select Image";;

  }
 
}

//////////////////////////////




// if(isset($_GET['action']))
// {
//   echo "hello";
//   exit;
// }




/////////////////////////////////////

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="button.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <title>Add Courses</title>
<style>
  tr,td,th
    {
      padding:8px;
      margin:3px;
      text-align:center;
    }
    .btd
    {
      float:right;
      margin-right:50px;
    }
span
{
  color:red;
}
</style>
</head>
<body>
<center>
  <form action="" method="post" enctype="multipart/form-data">

  <table border="2">
    <tr><th colspan="4">ADD COURSE</th></tr>
    <tr><td><?php if(!empty($error['name'])) echo "<span>$error[name]</span>" ?></td><td><?php if(!empty($error['price'])) echo "<span>$error[price]</span>" ?></td><td><?php if(!empty($error['image'])) echo "<span>$error[image]</span>" ?></td></tr>
    <tr><td><input type="text" name="name" class="form-control <?php if(!empty($error['name'])) echo "is-invalid" ?>" placeholder="COURSE NAME"></td>
    <td><input type="number" name="price" class="form-control <?php if(!empty($error['price'])) echo "is-invalid" ?>" placeholder="PRICE"></td>
    <td><input type="file" name="image" class="form-control <?php if(!empty($error['image'])) echo "is-invalid" ?>"></td>
  </tr>
  <tr><th colspan="4"><input type="submit" name="course_store" value="submit" class="btn btn-success"></th></tr>
  </table>
  </form>

  <br>
  <br>
<h3>Show Course</h3>
<a href="dashboard_teacher.php"><button class="btd btn btn-primary">Back To Dashboard</button></a>
  <table class="table">
    <tr><th>Image</th><th>Course Name</th><th>CoursePrice</th><th>Action</th></tr>

  <?php

echo "<pre>";
foreach ($data as $key => $row)
{
  // print_r($data[$i]);
 echo "<tr><td><img src='../view/img/$row[image]' height='50px' width='60px'></td><td>$row[coursename]</td><td>$row[price]</td><td><a href='enroll_course.php?id=$row[id]'><button class='btn btn-success'>Enroll</button></a> <a href='edit_course.php?id=$row[id]'><button class='btn btn-warning'>Edit</button></a> <a href='delete_course.php?id=$row[id]' class='link-light'><button class='btn btn-danger'>DELETE</button> </a> <a href='view_enrolled.php?&id=$row[id]' class='link-light'><button class='btn btn-info'>View</button></a> <a href='view_comment.php?id=$row[id]' class='link-dark'><button class='btn btn-outline-success'>View Comment</button></a> <a href='add_notice.php?id=$row[id]' class='link-dark'><button class='btn btn-outline-danger'>Add Notice</button></a> <a href='upload_certificate.php?id=$row[id]' class='link-dark'><button class='btn btn-outline-primary'>Certificate</button></a></td></tr>";
}


?>


  </table>



</center>



</body>
</html>


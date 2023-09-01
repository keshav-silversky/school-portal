<?php

include_once '../model/Courses.php';
include_once './controller/CoursesController.php';

if($_SESSION['id'])
{
  if($_SESSION['role']!='teacher')
  {
    header("location:../view/dashboard.php");
    exit;
  }

}
else
{
  header("location:../view/login.php");
  exit;
}

$c = new Courses();
$get_course = $c->getCourseForEdit($_GET['id']);
$course = new CoursesController();

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
  if(strlen($price)<=0 || empty($price))
  {
    return "Enter Price";
  }
}

if(isset($_POST['update']))
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
      $course->update_course($_POST,$file_save.'.'.$extension);
      
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





?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <title>Edit Course</title>
  <style>
    a:link, a:visited, a:hover, a:active{
    text-decoration: none;
}
    tr,td,th
    {
      padding:8px;
      margin:3px;
      text-align:center;
    }
    table 
    {
      border:2px solid black;
      border-radius:3px 3px 3px 3px;
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
<br><br>
<table border="2">
  <tr><th colspan="4">EDIT COURSE</th></tr>
  <tr>
    <td><?php if(!empty($error['name'])) echo "<span>$error[name]</span>"; ?></td>
    <td><?php if(!empty($error['price'])) echo "<span>$error[price]</span>"; ?></td>
    <td><?php if(!empty($error['image'])) echo "<span>$error[image]</span>"; ?></td>
</tr>
  <input type="number" name="id" value="<?php echo $_GET['id']; ?>" hidden>
  <tr><td><input type="text" name="name" value="<?php echo $get_course['coursename']; ?>" class="form-control <?php if(!empty($error['name'])) echo "is-invalid" ?>" placeholder="COURSE NAME"></td>
    <td><input type="number" name="price" value="<?php echo $get_course['price']; ?>" class="form-control <?php if(!empty($error['price'])) echo "is-invalid" ?>" placeholder="PRICE"></td>
    <td><input type="file" name="image" class="form-control <?php if(!empty($error['image'])) echo "is-invalid" ?>"></td>
  
  <!-- <tr><td><input type="text" name="name" placeholder="COURSE NAME" value="<?php echo $get_course['coursename']; ?>"></td>
  <td><input type="text" name="price" placeholder="PRICE" value="<?php echo $get_course['price']; ?>"></td>
  <td><input type="file" name="image"></td> -->
</tr>
<tr><th colspan="4"><button type="submit" name="update" value="update_course" class="btn btn-success">Update</button></th></tr>
</table>
</form>
<a href="add_course.php"><button class="btn btn-primary">Add Course</button></a>
      <a href="dashboard_teacher.php"><button class="btn btn-primary">Back To Dashboard</button></a>

  </center>

  
</body>
</html>


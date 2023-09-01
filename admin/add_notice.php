<?php

include_once '../model/notice.php';
include_once '../controller/Validation.php';
include_once './controller/NoticeController.php';
$n = new Notice();
$getnotice = $n->viewNotice($_SESSION['id'],$_GET['id']);
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

$valid=new Validation();
$notice = new NoticeController();

if(isset($_POST['add_notice']))
{

  $error['subject']=$valid->fullname($_POST['subject']);
  $error['detail']=$valid->detail($_POST['detail']);

  if(empty($error['subject']) && empty($error['detail']))
  {
  $notice->addNotice($_POST);
  }

}

?>

<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Notice</title>
    <style>
      span
      {
        color:red;
      }
    </style>
  </head>
  <body>
    <center>

  <h3 class="display-5">+------ Notice ------+</h3>
  <br><br>
<form action="" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <input type="text" name="course_id" value="<?php echo $_GET['id']; ?>" hidden>
    <?php if(!empty($error['subject'])) echo "<span>$error[subject]</span>"; ?>
  <input type="text" class="form-control  <?php if(!empty($error['detail'])) echo "is-invalid"; ?>" name="subject" placeholder="Enter Subject"><br>
  <?php if(!empty($error['detail'])) echo "<span>$error[detail]</span>"; ?>
  <textarea name="detail" class="form-control  <?php if(!empty($error['detail'])) echo "is-invalid"; ?>" id="textarea" placeholder="Enter Notice Details"></textarea>
</div>
  <input type="submit" name="add_notice" value="Submit" class="btn btn-primary">
</form>
<a href="add_course.php"><button class="btn btn-primary">Add Course</button></a>&nbsp;&nbsp;
<a href="dashboard_teacher.php"><button class="btn btn-primary">Back To Dashboard</button></a>

<table class="table">
<tr><th>Subject</th><th>Notice</th><th>Action</th></tr>
<br>  
<?php
foreach($getnotice as $key => $value)
{

  echo "<tr><td>$value[subject]</td><td>$value[detail]</td><td><a href='delete_notice.php?action=delete&id=$value[id]'><button class='btn btn-danger'>Delete</button></a></td></tr>";

}

?>

</table>
  </body>
</html>
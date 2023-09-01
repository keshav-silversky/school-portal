<?php
include_once '../model/Comments.php';
include_once '../controller/Validation.php';
require_once './controller/CommentController.php';

// session_start(); 
if(isset($_SESSION['id']))
{

}
else
{
  header('location:../view/login.php');
  exit;
}
$comment = new Comments();
$cmt = $comment->getComment($_GET['id']);

$valid = new Validation();
$cmt_controller = new CommentController();
$error=NULL;

if(isset($_POST['add_comment']))
{

$error = $valid->comment($_POST['comment']);

if(empty($error))
{

  $cmt_controller->addComment($_POST);
 
}
}

if(isset($_POST['delete']))
{
$cmt_controller->deleteComment($_POST);

}

?>

<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Comments</title>
    <style>
      span
      {
        color:red;
      }
    </style>
  </head>
  <body>
  <center>
      <h5 class="display-6">Add Comment</h5>
    <form action="" method="post">
    <input type="text" name="course_id" value="<?php echo $_GET['id']; ?>" hidden>
</center>
    <?php  if(!empty($error)) echo "<span>$error</span>"; ?>
    <center>
    <textarea class="form-control form-control-lg  <?php  if(!empty($error)) echo "is-invalid"; ?>" name="comment" rows="3" placeholder="Enter Comment"></textarea>
    <br>
       <input type="submit" value="Add Comment" name="add_comment" class="btn btn-outline-success">
    </form>
    <?php 
      if($_SESSION['role']=='teacher')
      {
        echo "<a href='add_course.php'><button class='btn btn-outline-primary'>Add Course</button></a> ";
      }
    ?>
    <!-- <a href="add_course.php"><button class="btn btn-outline-primary">Add Course</button></a>  -->
    <a href="dashboard_teacher.php"><button  class="btn btn-outline-primary">Back To Dashboard</button></a><hr>
   
    <h4 class="display-5 .bg-info text-warning"><b>View Comment</b></h4>

    <table class="table">
    <tr><th>Image</th><th>Name</th><th>Course Name</th><th>Comment</th><th>Action</th></tr>
    <?php
     foreach ($cmt as $key => $value)
      {
        echo "<tr><td><img src='../view/img/$value[image]' height='50px' width='60px'></td><td>$value[fullname]</td><td>$value[coursename]</td><td>$value[comment]</td><td><form action='' method='post'>
        <input type='number' name='id' value='$value[id]' hidden>
        <input type='number' name='course_id' value='$_GET[id]' hidden>
        <input type='submit' name='delete' class='btn btn-danger' Value='DELETE'>
        </td></tr></form>";
      }
      ?>
      </table>
</center>
  </body>
</html>
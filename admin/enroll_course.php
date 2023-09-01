<?php
// require_once '../model/connection.php';
require_once '../model/Courses.php';
require_once '../model/User.php';
// session_start();
if($_SESSION['id'])
{
  if ($_SESSION["role"] !='teacher')
  {
    header('location:dashboard.php');
    exit;
  } 
}
else
{
  header('location:login.php');
  exit;
}

$cors = new Courses();
$user = new User();
$course = $cors->GetCourse($_GET['id']);

$st_list = $user->getStudent();
?>

<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Enroll Student</title>
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
    .error
    {
      color:red;
    }
    option
    {
      text-align:center;
      font-size:24px;
      font-weight:700;
   
    }
  </style>
  </head>
  <body>
    <center>
    <br>
    <h2>Enroll Course To Student</h2>

    <table class="table">
      <tr><th>Course Name</th><th>Image</th><th>Course Price</th></tr>
      <?php 
      echo "<tr><td>$course[coursename]</td><td><img src='../view/img/$course[image]' height='50px' width='60px'></td><td>$course[price]</td></tr>";
      ?>
      <br>
      </table>
      <hr>

      <form action="./controller/EnrolledController.php" method="post">
    <h2>Select Student</h2>
    <input type="text" name="course_id" value="<?php echo $_GET['id']; ?>" hidden>
      <select name="student_list[]" class="form-select" aria-label="Default select example" multiple>
      <?php
  foreach($st_list as $student)
        echo "<option value='$student[id]'>$student[fullname]</option>";
      ?>
      </select>
      <br>
      <input type="submit" class="btn btn-success" name="enroll_student" value="Enroll">
      </form>

      <a href="add_course.php"><button class="btn btn-primary">Add Course</button></a>
      <a href="dashboard_teacher.php"><button class="btn btn-primary">Back To Dashboard</button></a>
    </center>
    
  </body>
</html>







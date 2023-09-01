<?php
include_once '../model/course_progress.php';
error_reporting(E_ALL & ~E_WARNING);

if(isset($_SESSION['id']))
{
  if($_SESSION['role']!='student')
  {
    header('location:dashboard_teacher.php');
    exit;
  }
  else
  {
    $cp = new Course_Progress();

    $current_progress = $cp->get_progress($_GET['id']);


  }
}
else
{
  header('location:login.php');
  exit;
}

if(isset($_POST['submit']))
{
 
  $cp->progress($_POST);
  exit;

}

?>

<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Start Course</title>
    <style>
        body {
  
      background-color: #f9f9f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .slider-container {
      width: 300px;
      position: relative;
    }

    .slider {
      width: 100%;
      appearance: none;
      height: 8px;
      border-radius: 5px;
      background: #ddd;
      outline: none;
    }

    .slider::-webkit-slider-thumb {
      appearance: none;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #007bff;
      cursor: pointer;
      transition: background 0.15s ease-in-out;
    }

    .slider::-moz-range-thumb {
      width: 20px;
      height: 20px;
      border: 0;
      border-radius: 50%;
      background: #007bff;
      cursor: pointer;
      transition: background 0.15s ease-in-out;
    }

    .slider::-ms-thumb {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #007bff;
      cursor: pointer;
      transition: background 0.15s ease-in-out;
    }

    .slider-value {
      position: absolute;
      top: -25px;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      color: #007bff;
      font-weight: bold;
    }

    .slider-value span {
      transform: translateX(-50%);
      position: relative;
    }
      
    </style>
  </head>
  <body>
  
  <center>

  <h4 class="display-4">Course Progress</h4>
  <br>






  <form action="" method="post">
  <div class="slider-container">
 <input type="range" class="slider" id="rangeInput" min="0" max="100" name="progress" value="<?php echo $current_progress['progress']; ?>"> 
 <input type="number" name="course_id" value="<?php echo $_GET['id']; ?>" hidden> 
  <div class="slider-value">
    <span>0</span><span>50</span><span>100</span>
 </div> <br></div><br>
 <input type="submit" name="submit" value="Finish" class="btn btn-success">
</form>







<a href="dashboard.php"><button class="btn btn-primary">Back To Dashboard</button></a>

  </center>



  </body>
  </html>
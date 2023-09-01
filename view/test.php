<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>


  <style>
    .button{

      box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px  13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }
   
  </style>
</head>
<body>
  <form action="" method="post">
  <input type="text" name="name" value="keshav" >
  <input type="submit" name="button" value="enroll">

  <input type="submit" name="button"   value="edit">
  <input type="submit" name="button" class="btn btn-outline-success" value="update">

  </form>

  
  
</body>
</html>

<?php

// print_r($_POST);

switch($_POST['button'])
{
  case 'enroll' : echo "hello";
}
?>
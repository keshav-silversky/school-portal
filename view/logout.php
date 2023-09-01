<?php

// error_reporting(E_ALL & ~E_WARNING);
session_start();
if(isset($_SESSION['id']))
{
session_destroy();
echo "<center>Successfully LogOut<br>";
echo "<a href='login.php'>Back To Login</a>";
}
else
{
  echo "<center>PLEASE LOGIN FIRST <br>";
  echo "<a href='login.php'>Login Here</a><center>";
}

?>
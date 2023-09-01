<?php

print_r($_POST);
var_dump($_POST);


if(isset($_POST['name']))
{
  echo "hello";
}
else
{
  echo "world";
}

?>

<form action="" method="post">
  <input type="text" name="name">
  <input type="submit" name="submit" value="submit">
</form>
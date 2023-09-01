<?php

include_once '../model/payment.php';
$pay = new Payment();

session_start();

if(isset($_SESSION['id']))
{
  if($_SESSION['role']!='teacher')
  {
    header("location:../view/login.php");
    exit;
  }
}
else
{
  header("location:../view/login.php");
  exit;
}


if($_GET['action']=='approve' && isset($_GET['id']))
{
  $pay->approve_payment($_GET['id']);
}

if($_GET['action']=='reject' && isset($_GET['id']))
{
  $pay->reject_payment($_GET['id']);

}


?>
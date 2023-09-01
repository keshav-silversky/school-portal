<?php
include_once '../model/Enrolled.php';

$e = new Enrolled();

if($_GET['search']=='search_by_student')
{
  $search_result = $e->search_by_student($_GET['value']);
// echo "<pre>";
//   print_r($search_result);
//   exit;
}



?>
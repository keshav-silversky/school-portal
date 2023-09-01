<?php
include_once '../model/course_progress.php';

class ProgressController
{
  private $cp;
  public function __construct()
  {
    $this->cp=new Course_Progress();
  }
  public function upload_certificate($data,$filename)
  {
      $result = $this->cp->upload_certificate($data,$filename);
      if($result == TRUE)
      {
        echo "<script>alert('Certificate Uploaded Successfully')
        window.history.back()</script>";
      }
      else
      {
        echo "<script>alert('Failed')
        window.history.back()</script>";
      }
  } 

}


?>
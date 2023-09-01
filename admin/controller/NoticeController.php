<?php

require_once '../model/Notice.php';

$nt = new Notice();

class NoticeController
{
  public function addNotice($data)
  {
    $nt = new Notice();
    $result = $nt->addNotice($data);
    if($result==TRUE)
    {
      header("location:./add_notice.php?id=$data[course_id]");
    }
  }

}



?>
<?php

require_once '../model/Payment.php';
include_once 'Validation.php';

$valid = new Validation();
// $pay = new Payment();

class PaymentController
{
private $pay;
  public function __construct()
  {
    $this->pay = new payment();
  }

  public function payment($data,$filename)
  {

    if($this->pay->store($data,$filename))
    {
      echo "<script>alert('payment Successful');
     window.location='../view/dashboard.php';</script>";
    }
    else
    {
      echo "<script>alert('Something Went Wrong');
      window.location='../view/dashboard.php';</script>";
    }
  }
  public function repayment($data,$filename)
  {
   $result = $this->pay->update_payment($data,$filename);
   if($result==TRUE)
   {
    echo "<script>alert('payment Successful');
    window.location='../view/dashboard.php';</script>";
   }
   else
   {
    echo "<script>alert('Something Went Wrong');
      window.location='../view/dashboard.php';</script>";
   }
  }

}


// if($_POST['submit']=='Payment')
// {



//   $error['fullname']= $valid->fullname($_POST['fullname']);
//   $error['card_detail']=$valid->card_detail($_POST['card_detail']);
//   $error['cvv']=$valid->cvv($_POST['cvv']);
//   $error['exp_date']=$valid->exp_date($_POST['exp_date']);
//   $errorMessage = http_build_query($error);
//   if($_FILES['pdf']['error']!='4')
//   {

//     if(pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION)=='pdf')
//     {
//       if(empty($error['fullname']) && empty($error['card_detail']) && empty($error['cvv']) && empty($error['exp_date']) )
//   {
//     $filesave= date("Ymdhis");
//     move_uploaded_file($_FILES["pdf"]["tmp_name"], "../view/img/".$filesave.'.'.pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION));
//     if($pay->store($_POST,$filesave.'.'.pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION))==TRUE)
//     {
//       echo "<script>alert('payment Successful');
//       window.location='../view/dashboard.php';</script>";
//     }
// else
// {
//   header("location:../view/dashboard.php");
//   exit;
// }
//   }
//   else
//   {
   
//     // echo "<script>alert('Invalid Field Value')</script>";
//   echo "<script>window.location='../view/Payment.php?id=$_POST[course_id]&price=$_POST[amount]&$errorMessage';</script>";
//   exit;
//   }

//     }
//     else
//     {
//       echo "<script>alert('Invalid File Select PDF');
//       window.history.back();</script>";
//       exit;

//     }

//   }
//   else
//   {   
//     echo "<script>alert('Upload PDF');</script>";
//     echo "<script>window.location='../view/Payment.php?id=$_POST[course_id]&price=$_POST[amount]&$errorMessage';</script>";
//     exit;
//   }


//  } // End of Payment



//  if($_POST['submit']=='repayment')
// {

//   foreach ($_POST as $value)
//   {
//     if(empty($value))
//     {
//       echo "<script>alert('Field Cannot Blank');
//       window.history.back();</script>";
//       exit;
//     }
//   }

//   $error['fullname']= $valid->fullname($_POST['fullname']);
//   $error['card_detail']=$valid->card_detail($_POST['card_detail']);
//   $error['cvv']=$valid->cvv($_POST['cvv']);
//   $error['exp_date']=$valid->exp_date($_POST['exp_date']);

//   if($_FILES['pdf']['error']!='4')
//   {

//     if(pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION)=='pdf')
//     {
//       if(empty($error['fullname']) && empty($error['card_detail']) && empty($error['cvv']) && empty($error['exp_date']) )
//   {
//     $filesave= date("Ymdhis");
//     move_uploaded_file($_FILES["pdf"]["tmp_name"], "../view/img/".$filesave.'.'.pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION));
//     if($pay->update_payment($_POST,$filesave.'.'.pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION))==TRUE)
//     {
//       echo "<script>alert('payment Successful');
//       window.location='../view/dashboard.php';</script>";
//     }
// else
// {
//   header("location:../view/dashboard.php");
//   exit;
// }
//   }
//   else
//   {
//     echo "<script>alert('Invalid Field Value');
//   window.location='../view/Payment.php?id=$_POST[course_id]&price=$_POST[amount]';</script>";
//   exit;
//   }

//     }
//     else
//     {
//       echo "<script>alert('Invalid File Select PDF');
//       window.history.back();</script>";
//       exit;

//     }

//   }
//   else
//   {   
//     echo "<script>alert('Upload PDF');
//     window.history.back();</script>";
//     exit;
//   }


//  }


// if($_POST['submit']=='repayment')
// {


//   $error['fullname']= $valid->fullname($_POST['fullname']);
//   $error['card_detail']=$valid->card_detail($_POST['card_detail']);
//   $error['cvv']=$valid->cvv($_POST['cvv']);
//   $error['exp_date']=$valid->exp_date($_POST['exp_date']);


//   if(empty($error['fullname']) && empty($error['card_detail']) && empty($error['cvv']) && empty($error['exp_date']) )
//   {
//     $pay->update_payment($_POST);

//     header("location:../view/dashboard.php");
//   }
//   else

// {

//   header("location:../view/Payment.php?id=$_POST[course_id]&price=$_POST[amount]");
// }


// }

?>


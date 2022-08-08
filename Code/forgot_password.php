<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$token)
{
  require("PHPMailer/src/PHPMailer.php");
  require("PHPMailer/src/SMTP.php");
  require("PHPMailer/src/Exception.php");

  $mail = new PHPMailer(true);

  try {

    //$mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'batch16projectg4@gmail.com';                     //SMTP username
    $mail->Password   = 'vyeuffucmglkyhph';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('batch16projectg4@gmail.com', 'artQuarium');
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset ';
    $mail->Body    = "Click here too reset your password <a href='https://www.artquarium.in/reset.php?email=$email&token=$token'>Reset</a>";

    $mail->send();
    return true;
  }
  catch (Exception $e) {
    return false;
  }
}

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}

if(isset($_POST['sent']))
{
  $email = $_POST['email'];
  $emailquery = "select * from signup where email = '$email'";
  $query = mysqli_query($conn,$emailquery);
  $emailcount = mysqli_num_rows($query);

  if($emailcount)
  {
    $userdata = mysqli_fetch_array($query);
    $username = $userdata['username'];
    $token = $userdata['token'];
    if(sendMail($_POST['email'],$token))
    {
        $_SESSION['status']="Reset link sent to $email. Check into inbox or spam folder.";
    }
  }
  else{
    echo "No email found";
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forgot_Password</title>

    <script>
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">

  </head>

  <style media="screen">

    section {
        background: linear-gradient(to right, transparent 50%, #fff 50%), url('images/img1.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940') no-repeat center;
        background-size: cover;
    }

    h2{
      font-family: 'Alfa Slab One', cursive;
      font-size: 50px;
      color: #00BD56;
      margin-top: 137px;
    }
    .btn{
      border-radius:20px;
    }

    i {
      margin-left: 500px;
      cursor: pointer;
  }

  </style>


  <body>


    <section>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-6 p-5">
              <?php

                if(isset($_SESSION['status'])){
                  ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> <?php   echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php
                  unset($_SESSION['status']);
                }
               ?>
              <h2 class="text-center">artQuarium</h2>
                <h3 class="mt-5 mb-5 text-secondary">Forgot your password?</h3>
                <!--<p class="small">
                    Vestibulum venernatis id ex eu dapibus. Suspendisse sit amet justa leo. Curabitur ornare tacus erat, ac interdum liguta consequat ut. Fusce id tellus ac ante feugiat porta.
                </p>-->

                <form class="mt-3 p-3" action="" method="post">
              <div class="row">

                <div class="mb-3 col-md-12">
                  <label class="mb-3" for="">Email</label>
                  <input type="email" name="email" value="" class="form-control" required>
                </div>

                <div class="mb-4 col-md-12 text-center">
                  <button class="btn btn-success d-grid gap-2 col-6 mx-auto mt-4" type="sent" name="sent" value="">Send Mail</button>
                </div>


                 <p class="text-center mt-2 text-secondary">After resetting your password you can <a href="Login.php">Login</a></p>

              </div>


            </form>
            </div>
        </div>
    </div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>

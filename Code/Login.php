<?php
session_start();

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}
if(isset($_POST['login']) && $_POST['g-recaptcha-response'] != "")
{
  $secret = '6LceZkkgAAAAADe_g6YznuedG_Kw8U_y-JJYwIfz';
  $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
  $responseData = json_decode($verifyResponse);
  $email= $_POST['email'];
  $password = $_POST['password'];
  $query = "select * from signup where email='$email'";
  $result = mysqli_query($conn,$query);

  if($result)
  {
    if(mysqli_num_rows($result)==1)
    {
      $result_fetch = mysqli_fetch_assoc($result);
      $db_pass = $result_fetch['password'];
      if($result_fetch['status']=='active')
      {
        $pass_decode = password_verify($password,$db_pass);
        if($pass_decode  && $responseData->success)
        {
          $_SESSION['user_name'] = $result_fetch['username'];
          header('Location: otpnum.php');
        }
        else{
          $_SESSION['status']="Enter the correct details.";
        }
      }
      else
      {
        $_SESSION['status']="Email not verified, Please verify.";
      }
    }
    else{
      $_SESSION['status']="Email not Registered.";
    }
  }

}
 mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>

    <script>
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
      margin-top: 96px;
    }
    .btn{
      border-radius:20px;
    }

    i {
      margin-left: 500px;
      cursor: pointer;
  }

  html {
    user-select: none;
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
                <h3 class="mt-4 mb-4">Sign in</h3>
                <!--<p class="small">
                    Vestibulum venernatis id ex eu dapibus. Suspendisse sit amet justa leo. Curabitur ornare tacus erat, ac interdum liguta consequat ut. Fusce id tellus ac ante feugiat porta.
                </p>-->

                <form class="mt-2 p-3 from" action="Login.php" method="post"  onsubmit="return validation()">
              <div class="row">

                <div class="mb-3 col-md-12">
                  <label class="mb-3" for="">Email</label>
                  <input type="email" name="email" value="" class="form-control" id="email" autocomplete="off">
                  <span id="ema" class="text-danger font-weght-bold"></span>
                </div>

                <div class="mb-3 col-md-12">
                  <label class="mb-3" for="password">Password</label>
                    <input type="password" name="password" value="" class="form-control" id="password" autocomplete="off">
                    <span id="pass" class="text-danger font-weght-bold"></span>
                </div>

                <div class="g-recaptcha" data-sitekey="6LceZkkgAAAAAGJJ8K4cSJymCLf2xKZKAFL0--e3"></div>
              <br/>
              <div>
                <br>
              </div>

                <a href="forgot_password.php" class="mb-3">Forgot Password?</a>

                <div class="mb-2 col-md-12 text-center">
                  <button class="btn btn-success d-grid gap-2 col-6 mx-auto" id ="login" type="login" name="login" value="">Login</button>
                </div>


                 <p class="text-center mt-3 text-secondary">If you are a new user, Please <a href="Signup.php">Register Now</a></p>

              </div>
            </form>
            </div>
        </div>
    </div>
</section>



<script type="text/javascript">
  function validation() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (email == '') {
      document.getElementById('ema').innerHTML = "Please fill the Email field";
      return false;
    }

    if (email.indexOf('@') <= 0) {
      document.getElementById('ema').innerHTML = "Invalid @ position";
      return false;
    }

    if ((email.charAt(email.length - 4) != '.') && (email.charAt(email.length - 3) != '.')) {
      document.getElementById('ema').innerHTML = "Invalid . position";
      return false;
    }

    if (password == '') {
      document.getElementById('pass').innerHTML = "Please fill the Password field";
      return false;
    }

    if ((password.length <= 3) || (password.length > 20)) {
      document.getElementById('pass').innerHTML = "password length should be between 5 and 20";
      return false;
    }


}

</script>



  </body>
</html>

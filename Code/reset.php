<?php
session_start();
ob_start();
$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}


if(isset($_POST['submit']))
{
  if(isset($_GET['token']))
  {
    $token = $_GET['token'];
    $password = $_POST['password'];
    $confpass = $_POST['confpass'];

    $pass = password_hash($password,PASSWORD_BCRYPT);
    $cpass = password_hash($confpass,PASSWORD_BCRYPT);

    if($password === $confpass)
    {

      $updatequery = " update signup set password = '$pass', confpass = '$cpass' where token = '$token' ";
      $iquery = mysqli_query($conn,$updatequery);
      if($iquery)
      {
        $_SESSION['status'] = "Your password has been updated.";
      }
      else {
        $_SESSION['status'] = "Your password is not updated.";
        header('location:reset.php');
      }
    }
  else{
    $_SESSION['status'] = " Password and Confirm Password is not matching.";
  }

  }
  else {
    $_SESSION['status'] = "No token found.";
  }
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reset_Password</title>

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
      margin-top: 60px;
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
                <h3 class="mt-5 mb-4 text-secondary">Forgot your password?</h3>

                <form class="mt-2 p-3" action="" method="post">
                <div class="row">

                    <div class="mb-3 col-md-12">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="" class="form-control" id="pass" oninput="validate() ">
                        <!-- <span id="pass" class="text-danger font-weight-bold"></span> -->
                        <i class="fa-solid fa-eye-slash"></i>
                        <ul>
                          <li id="len">Password should be atleast 8 Characters</li>
                          <li id="cp">Atleast 1 Capital Letter</li>
                          <li id="sm">Atleast 1 Small Letter</li>
                          <li id="nm">Atleast 1 Numeric</li>
                          <li id="sp">Atleast 1 Special Symbol</li>
                        </ul>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="">Confirm Password</label>
                        <input type="password" name="confpass" value="" class="form-control" id="pass2" oninput="conform()">
                        <!-- <span id="pass2" class="text-danger font-weight-bold"></span> -->
                    </div>
    
                    <div class="mb-3 col-md-12 text-center">
                        <button class="btn btn-success d-grid gap-2 col-6 mx-auto" id="submit" type="submit" name="submit" value="">Reset my password</button>
                    </div>


                    <p class="text-center mt-3 text-secondary">After resetting your password you can <a href="Login.php">Login</a></p>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    function validate() {
      var password = document.getElementById('pass').value;
      var password2 = document.getElementById('pass2').value;

      var cp = document.getElementById("cp");
      var sm = document.getElementById("sm");
      var nm = document.getElementById("nm");
      var sp = document.getElementById("sp");
      var len = document.getElementById("len");

      if (password.length < 8) {
        len.style.color = "red";
      }
      else{
        len.style.color = "green";
      }

      if(password.match(/[0-9]/)){
        nm.style.color = "green";
      }
      else{
        nm.style.color = "red";
      }

      if(password.match(/[a-z]/)){
        sm.style.color = "green";
      }
      else{
        sm.style.color = "red";
      }

      if(password.match(/[A-Z]/)){
        cp.style.color = "green";
      }
      else{
        cp.style.color = "red";
      }

      if(password.match(/[!\@\#\$\%\*\^\&\_\+\-\,\?\.\>\<]/)){
        sp.style.color = "green";
      }
      else{
        sp.style.color = "red";
      }
    }

    function conform(){
      var password = document.getElementById('pass').value;
      var password2 = document.getElementById('pass2').value;
      if(password == password2){
        document.getElementById("nm").style.display = "none";
        document.getElementById("sm").style.display = "none";
        document.getElementById("cp").style.display = "none";
        document.getElementById("sp").style.display = "none";
        document.getElementById("len").style.display = "none";
      }
      else{
        document.getElementById("nm").style.display = "block";
        document.getElementById("sm").style.display = "block";
        document.getElementById("cp").style.display = "block";
        document.getElementById("sp").style.display = "block";
        document.getElementById("len").style.display = "block";
      }
    }

  </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


  </body>
</html>

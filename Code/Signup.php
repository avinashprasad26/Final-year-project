<?php
session_start();

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}

if(isset($_POST['button']) && $_POST['g-recaptcha-response'] != "")
{

  $secret = '6LceZkkgAAAAADe_g6YznuedG_Kw8U_y-JJYwIfz';
  $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
  $responseData = json_decode($verifyResponse);
  $email = $_POST['email'];
  $pno = $_POST['pno'];
  $pass = $_POST['password'];
  $cpass = $_POST['confpass'];
  $password = password_hash($pass,PASSWORD_BCRYPT);
  $confpass = password_hash($cpass,PASSWORD_BCRYPT);
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $file = $_FILES['file'];

  $filename = $file['name'];
  $fileerror = $file['error'];
  $filetmp = $file['tmp_name'];
  
  $filesize = $file['size']/(1024*1024);

  $fileext = explode('.',$filename);
  $filecheck = strtolower(end($fileext));
  $fileextstored = array('png' ,'jpg','jpeg' );
  
  if($filesize > 1){
        echo"<script>alert('Image size is greater than 1MB');</script>";
        exit();
    }

  $token = bin2hex(random_bytes(15));

  $email_query="select * from signup where email = '$email'";
  $username_query="select * from signup where username = '$username'";
  $pno_query="select * from signup where pno = '$pno'";
  $email_query_run = mysqli_query($conn,$email_query);
  $usename_query_run = mysqli_query($conn,$username_query);
  $pno_query_run = mysqli_query($conn,$pno_query);
  if(mysqli_num_rows($email_query_run)>0){
    $_SESSION['status'] = "Email already exists.";
  }
  else if(mysqli_num_rows($usename_query_run)>0){
    $_SESSION['status'] = "Username already exists.";
  }
  else if(mysqli_num_rows($pno_query_run)>0){
    $_SESSION['status'] = "Phone number already exists.";
  }
  else
  {

    if($pass === $cpass){

      if(in_array($filecheck,$fileextstored)  && $responseData->success){

        $destinationfile = 'upload/'.$filename;
        move_uploaded_file($filetmp,$destinationfile);

          $query = "insert into signup(email,pno,password,confpass,dob,gender,fname,lname,username,token,status,image_path) values('$email','$pno','$password','$confpass','$dob','$gender','$fname','$lname','$username','$token','active','$destinationfile')";

          $_SESSION['user_name']=$username;
          $_SESSION['avatar']=$destinationfile;

          if(mysqli_query($conn,$query))
          {

              $_SESSION['status']="Successfully Registered.";
              //header('Location: success.html');
          }

          else{
              echo "Error: " .$sql."".mysqli_error($conn);
            }
      }
      else{
        $_SESSION['status'] = " Please upload only JPG, PNG or JPEG image. ";
      }

      }
      else{
          $_SESSION['status']="Password and Confirm Password does not Match.";
      }
    }

}


  mysqli_close($conn);

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>SignUp</title>
  <link rel="stylesheet" href="Signup.css">


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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>


<style media="screen">
  section {
    background: linear-gradient(to right, transparent 50%, #fff 50%), url('images/img1.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940') no-repeat center;
    background-size: cover;
  }

  h2 {
    font-family: 'Alfa Slab One', cursive;
    font-size: 50px;
    color: #00BD56;
  }

  .btn {
    border-radius: 20px;
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
          <h3>Create an Account</h3>

          <form class="mt-0 p-3 form" action="" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="row">

              <div class="mb-3 col-md-12">
                <label for="">Email</label>
                <input type="text" name="email" value="" class="form-control" id="email" oninput="CheckEmail(document.getElementById('email').value)" required>
                <span id="ema" class=" font-weight-bold"></span>
              </div>

              <div class="mb-3 col-md-12">
                <label for="">Mobile Number</label>
                <input type="tel" name="pno" value="" class="form-control" id="mobnumber" autocomplete="off" required>
                <span id="mob" class="text-danger font-weight-bold"></span>
              </div>

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
              </div>

              <div class="mb-3 col-md-12">
                <label for="">Date of Birth</label>
                <input type="date" name="dob" value="" class="form-control" id="dob" autocomplete="off" required>
              </div>

              <div class="mb-3 col-md-12">
                <label for="">Gender</label>
                <select id="gender" name="gender" class="form-select" aria-label="Default select example" required>
                  <option selected>-----</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>

              <div class="mb-3 col-md-12">
                <label for="">First Name</label>
                <input id="fname" type="text" name="fname" value="" class="form-control" autocomplete="off" required>
              </div>

              <div class="mb-3 col-md-12">
                <label for="">Last Name</label>
                <input id="lname" type="text" name="lname" value="" class="form-control" autocomplete="off" required>
              </div>

              <div class="mb-3 col-md-12">
                <label for="">Username</label>
                <input type="text" name="username" value="" class="form-control" id="username" autocomplete="off" required>
                <span id="usern" class="text-danger font-weight-bold"></span>
              </div>

              <div class="mb-3 col-md-12">
                <label for="">Profile Image (size should be less than 1MB)</label>
                <input type="file" name="file" value="" class="form-control" id="username" autocomplete="off" required>
                <span id="" class="text-danger font-weight-bold"></span>
              </div>

              <div class="g-recaptcha" data-sitekey="6LceZkkgAAAAAGJJ8K4cSJymCLf2xKZKAFL0--e3"></div>
              <br/>
              <div>
                <br>
              </div>
              
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">I have read and agree to the website <a href="terms&conditions.html">terms and conditions </a> and <a href="privacypolicy.html"> privacy policy</a></label>
              </div>

              <div class="mb-1 col-md-12 text-center">
                <button class="btn btn-success d-grid gap-2 col-6 mx-auto" id="register" type=" button" name="button" value="">Create Account</button>
              </div>
              <p class="text-center mt-3 text-secondary">If you have account, Please <a href="Login.php">Login Now</a></p>
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

    function ValidateEmailAddress(emailString) {
      var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	    return !!emailString && typeof emailString === 'string' && emailString.match(emailRegex);
    }

    function CheckEmail(emailString)
    {
      //get result as true/false
      var Result= ValidateEmailAddress(emailString);

	    if(Result)
	    {
	      document.getElementById("ema").innerHTML="Valid Email Id";
      }
      else
      {
		    document.getElementById("ema").innerHTML="Not a Valid Email Id";
	    }
    }

  </script>

</body>
</html>

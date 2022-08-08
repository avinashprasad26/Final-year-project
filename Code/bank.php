<?php
session_start();
$username = $_SESSION['user_name'];

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}

$usernamequery="select * from signup where username = '$username' ";
$usernamedata=mysqli_query($conn,$usernamequery);
$arrusernamedata=mysqli_fetch_array($usernamedata);
$idd = $arrusernamedata['idd'];

if(isset($_POST['button'])){
    
    $bankname = $_POST['bankname'];
    $accno = $_POST['accno'];
    $confaccno = $_POST['confaccno'];
    $ifsc = $_POST['ifsc'];
    $holdername = $_POST['holdername'];
    $query="INSERT INTO bankdetails(bankname, accno, confaccno, ifsc, holdername, seller_id) VALUES ('$bankname','$accno','$confaccno','$ifsc','$holdername','$idd')";
   
    if($accno == $confaccno){
        if(mysqli_query($conn,$query)){
            echo"<script>alert('Bank Details Inserted Successfully.');</script>";
        }
        else{
              echo "Error: " .$sql."".mysqli_error($conn);
            }
    }
    else{
        echo"<script>alert('Account No. and Confirm Account No. does not match.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <script>
    if(window.history.replaceState){
      window.history.replaceState(null,null,window.location.href);
    }
  </script>
  <meta charset="utf-8">
  <title>Bank_details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>


  <header id="header">
    <!--Navigation starts -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">artQuarium</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav m-auto font-rubik">
          <li class="nav-item">
            <a class="nav-link" href="#">Bank Details</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>


  <section>
    <div class="container col-lg-6 border shadow bg-light mt-5">
      <form action="" method="post">
        <h5 class="text-center mt-2">Enter your Bank Details</h5>
        <div class="mb-3 col-lg-12">
          <label for="exampleInputEmail1" class="form-label">Bank Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="bankname" value="" placeholder="Enter your bank name" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3 col-lg-12">
          <label for="exampleInputEmail1" class="form-label">Account Number</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="accno" value="" placeholder="Account Number" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3 col-lg-12">
          <label for="exampleInputEmail1" class="form-label">Confirm Account Number</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="confaccno" value="" placeholder=" Re-enter Account Number" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3 col-lg-12">
          <label for="exampleInputEmail1" class="form-label">IFSC Code</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="ifsc" value="" placeholder="IFSC Code" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3 col-lg-12">
          <label for="exampleInputPassword1" class="form-label">Account Holder Name</label>
          <input type="text" class="form-control" name="holdername" value="" placeholder="Enter the name on your card" id="exampleInputPassword1" required>
        </div>

        <!--<button class="btn btn-primary mb-3" type="button" name="button" value="">Submit</button>-->
        <input type="submit" class="btn btn-primary mb-3" name="button" value="Submit">
      </form>

    </div>
  </section>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

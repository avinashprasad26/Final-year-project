<?php
session_start();
$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}

$username = $_SESSION['user_name'];

$pno_query = "select * from signup where username = '$username'";
$pno_querys = mysqli_query($conn,$pno_query);
$pno_data=mysqli_fetch_array($pno_querys);
$num = $pno_data['pno'];

$otp = rand(11111,99999);
$conf_otp = $otp;

if(isset($_POST['send'])){

    $fields = array(
        "variables_values" => "$otp",
        "route" => "otp",
        "numbers" => "$num",
    );
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($fields),
      CURLOPT_HTTPHEADER => array(
        "authorization: GWD31g0IwyxZ6pT2UiYLmOutrReXEV9hz7aCHlonN5vSJjP8FKgqZEzsBUb03OlyXeu6JMhPvi5Vm1tr",
        "accept: */*",
        "cache-control: no-cache",
        "content-type: application/json"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      //echo $response;
      $data = json_decode($response);
      $sts = $data -> return;
      if($sts == false){
        echo"<script>alert('OTP not sent.');</script>";
      }
      else{
        $query1 = "insert into otp(otpnum, mobilenum) values($otp,$num)";
        $queryrun = mysqli_query($conn,$query1);
        echo"<script>alert('OTP sent to your registered number.');</script>";
      }
    }
}

if(isset($_POST['verify'])){
    $otpnums = $_POST['otpnum'];
    //echo"$otpnums";

    $query2 = "select * from otp where mobilenum = '$num' ";
    $otp_q = mysqli_query($conn,$query2);
    while($qs=mysqli_fetch_assoc($otp_q)){
        $o = $qs['otpnum'];
        if($otpnums === $o){
            header('Location: main_wall.php');
        }
    }
    
}

 mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>OTP Verifivation</title>

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

      .content{
        max-width: 500px;
        margin: auto;
        
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

    <div class="container ">
        <div class="row">
            <div class="col-sm-6 content">
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

                <form class="mt-2 p-3 from" action="" method="post">
                    <div class="row">

                        <div class="mb-3 col-md-12">
                            <label class="mb-3" for="password">Mobile Number </label>
                            <input type="text" name="num" value="<?php echo $num;?>" class="form-control" id="num" autocomplete="off">
                            <span id="num" class="text-danger font-weght-bold"></span>
                        </div>

                        <br>
                    </div>

                    <div class="mb-2 col-md-12 text-center">
                        <button class="btn btn-success d-grid gap-2 col-6 mx-auto" id ="send" type="send" name="send" value="">Send</button>
                    </div>                 

                
                </form>
                <form class="mt-2 p-3 from" action="" method="post">
                    <div class="row">

                        <div class="mb-3 col-md-12">
                            <label class="mb-3" for="password">Enter OTP </label>
                            <input type="text" name="otpnum" value="" class="form-control" id="otpnum" autocomplete="off">
                            <span id="otpnum" class="text-danger font-weght-bold"></span>
                        </div>

                        <br>
                    </div>

                    <div class="mb-2 col-md-12 text-center">
                        <button class="btn btn-success d-grid gap-2 col-6 mx-auto" id ="verify" type="verify" name="verify" value="">Verify</button>
                    </div>                 

                
                </form>
            </div>
        </div>
    </div>
</section>

</body>
</html>

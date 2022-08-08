<?php

session_start();

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}
$ids=$_SESSION['user_name'];

$usernamequery="select * from signup where username = '$ids' ";
$usernamedata=mysqli_query($conn,$usernamequery);
$arrusernamedata=mysqli_fetch_array($usernamedata);
$idd = $arrusernamedata['idd'];
//echo"$idd";

$select_cart = mysqli_query($conn,"select * from cart where user_id = '$idd'");


// $select_quantity = mysqli_query($conn,"select s.quantity from sell as s,cart as c where c.name = ''   ");

$subtotal=0;
$total=0;

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
  <title>checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/8549de214a.js" crossorigin="anonymous"></script>

</head>

<style media="screen">
  .btn {
    float: right;
    border-radius: 30px;
    width: 150px;
  }
</style>

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
          <!---<li class="nav-item">
                    <a class="nav-link" href="#">Category</a>
                  </li>--->
        </ul>
      </div>
    </nav>
  </header>
  <!--Navigation ends -->

  <section class="checkout">
    <div class="container mt-5">
      <form method="post" action="pay.php">
        <!-- <div class="row"> -->

        <div class="bg-light p-2 border">
          <!-- <form> -->
            <h6 class="mb-5 " style="text-align: center;">Your order summary</h6>
            <div class="details">
              <div class="row">
                    <div class="col-lg-9">
                        <h6 class="text-secondary">PRODUCT DETAILS</h6>
                    </div>
                    <div class="col-lg-3">
                        <h6 class="text-secondary">SUBTOTAL</h6>
                    </div>
              </div>
              <hr>


                <div class="row">
                    <?php
                     while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    ?>

                    <div class="col-3 mb-3">
                        <img src="<?php echo $fetch_cart['image']; ?>" style="width: 100px; height: 70px;" alt="">
                    </div>
                    <div class="col-lg-2">
                        <h6>Name: <?php echo $fetch_cart['name']; ?></h6>
                    </div>
                    <div class="col-lg-2">
                        <input type="hidden" name="quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                        <h6 ><?php echo "Qty: ".$fetch_cart['quantity']; ?><input type="hidden" class="iquantity" value="<?php echo $fetch_cart['quantity']; ?>"></h6>
                    </div>
                    <div class="col-lg-2">
                        <h6><?php echo "₹ ".$fetch_cart['price']; ?><input type="hidden" class="iprice" value="<?php echo $fetch_cart['price']; ?>"></h6>
                    </div>
                    <div class="col-lg-3">
                        <h6 class='itotal'></h6>
                    </div>

                     <?php
                        }
                    ?>

                </div>
                <hr>

                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="bottom text-center ms-5 mb-3" style="width: 25rem;">
                            <div class="card-body text-center" >
                                <p class="card-text text-secondary" style="text-align: center;">SHIPPING : Free Shipping</p>
                                <h5 class="card-title" id="gtotal" style="text-align: center;"> </h5>
                            </div>
                        </div>
                    </div>
                    

                    
                        <div class="row justify-content-md-center" style="text-align: center;" >
                            
                                <div class=" card border-black bg-light text-center ms-3 mb-3" style="width: 30rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Credit Card/Debit Card/NetBanking</h5>
                                        <p class="card-text text-secondary">Cards, Netbanking, Wallet & UPI</p>
                                        <div class="mb-3 mt-3 bg-grey">
                                            <h6 class="card-header d-flex bg-white border justify-content-between align-items-center">
                                            Pay securely by Credit or Debit card or Internet Banking through Razorpay.</h6>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                            <label class="form-check-label" for="exampleCheck1">I have read and agree to the website <a href="#">terms and conditions</a></label>
                                        </div>
                                        <!-- <div class="row justify-content-md-center">
                                            <button type="submit" class="btn me-5 mt-3 btn-success" name="button" value="">Place order</button>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                            <button type="submit" class="btn me-5 mt-3 btn-success" name="button" value="">Place order</button>
                                        </div>
                                <!-- <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy.</a></p> -->
                        </div>
                </div>
            </div>
          <!-- </form> -->
        </div>
        
        
      </form>
    </div>
  </section>

<script>
  function checkdelete()
  {
    return confirm('Are you sure you want to delete');
  }
</script>

<script>
  var gt=0;
  var iprice = document.getElementsByClassName('iprice');
  var iquantity = document.getElementsByClassName('iquantity');
  var itotal = document.getElementsByClassName('itotal');
  var gtotal = document.getElementById('gtotal');
  var rupee = "₹ ";
  var grand = "Grand Total : ";

  function subTotal(){
    gt=0;
    for (i = 0; i < iprice.length; i++) {
      itotal[i].innerText = rupee.concat((iprice[i].value)*(iquantity[i].value));
      gt = gt + (iprice[i].value)*(iquantity[i].value);

    }
    gtotal.innerText = grand.concat(rupee,gt);
  }

  subTotal();

</script>
</body>

</html>

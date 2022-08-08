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

// $showquery="select * from sell where username!='$ids'";
// $showdata=mysqli_query($conn,$showquery);
// $rows=mysqli_fetch_array($showdata);
// $sell_id = $rows['id'];
// echo "$sell_id";
//echo"$sell_id";

$select_cart = mysqli_query($conn,"select * from cart where user_id = '$idd'");


// $select_quantity = mysqli_query($conn,"select s.quantity from sell as s,cart as c where c.name = ''   ");

$subtotal=0;
$total=0;

if(isset($_POST['button']))
{
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $country = $_POST['country'];
  $street_address = $_POST['street_address'];
  $town = $_POST['town'];
  $state = $_POST['state'];
  $pincode = $_POST['pincode'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $notes = $_POST['notes'];

  $query = "insert into person_order_details(fname,lname,country,street_address,town,state,pincode,phone,email,notes,username,user_id) values('$fname','$lname','$country','$street_address','$town','$state','$pincode','$phone','$email','$notes','$ids','$idd')";
  if(mysqli_query($conn,$query))
  {
    $query3 = "select * from person_order_details where username = '$ids'";
    $podid=mysqli_query($conn,$query3);
    $podids=mysqli_fetch_array($podid);
    $p_o_d_id = $podids['id'];
    
    $query2 = "insert into order_details(name,sell_id,user_id,quantity,price,p_o_d_id) values(?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn,$query2);
    if($stmt){
    mysqli_stmt_bind_param($stmt,"siiiii",$name,$sell_id,$user_id,$quantity,$price,$p_o_d_id);
    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        $sell_id = $fetch_cart['sell_id'];
        $user_id = $fetch_cart['user_id'];
        $name = $fetch_cart['name'];
        $quantity = $fetch_cart['quantity'];
        $price = $fetch_cart['price'];
        mysqli_stmt_execute($stmt);
      }
      echo "<script>alert('Ready for Payment ');</script>";
    }
    else{
      echo "<script>alert('SQL Query Prepare Error');</script>";
    }
    header('Location: http://artquarium.in/ordercontinue.php');
    // echo "<script>alert('Order placed');</script>";
  }
  else{
    echo "Error: " .$sql."".mysqli_error($conn);
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
      <form method="post" action="">


      <div class="row">
        <div class="col-lg-6 bg-light me-5 border">
          <form>
            <h6 class="mt-3">Billing details</h6>

            <div class=" row mb-3">
              <div class="col-6">
                <label for="" class="form-label">First Name</label >
                <input type="text" class="form-control" name="fname" value="" required>
              </div>
              <div class="col-6">
                <label for="" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" value="" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Country : </label>
              <select class="form-select" name="country" aria-label="Default select example" required>
                <option selected>-----</option>
                <option value="India">India</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Street address</label>
              <input type="text" class="form-control" placeholder="House number and street name" id="exampleInputPassword1" name="street_address" value="" required>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Town / City</label>
              <input type="text" class="form-control" placeholder="" id="exampleInputPassword1" name="town" value="" required>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">State</label>
              <input type="text" class="form-control" placeholder="" id="exampleInputPassword1" name="state" value="" required>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Pincode</label>
              <input type="text" class="form-control" placeholder="" id="exampleInputPassword1" name="pincode" value="" required>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Phone</label>
              <input type="text" class="form-control" placeholder="" id="exampleInputPassword1" name="phone" value="" required>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Email address</label>
              <input type="text" class="form-control" id="exampleInputPassword1" name="email" value="" required>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Order notes</label>
              <textarea class="form-control" placeholder="Notes about your order, e.g. special notes for delivery." id="textAreaExample2" name="notes" rows="5" required></textarea>
            </div>


          </form>
        </div>
        <!--form1 ends-->

        <div class="col-md-5 bg-light p-2 border">
          <form>
            <h6 class="mb-5">Your order</h6>
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
                if(mysqli_num_rows($select_cart)>0){
                  while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                ?>

                <div class="col-lg-1">
                  <a href="delete.php?id=<?php echo $fetch_cart['id']; ?>" onclick="return checkdelete()"><i class="fa fa-times" aria-hidden="true"></i></a>
                </div>
                <div class="col-3 mb-3">
                  <img src="<?php echo $fetch_cart['image']; ?>" style="width: 60px; height: 60px;" alt="">
                </div>
                <div class="col-lg-2">
                  <h6>Name: <?php echo $fetch_cart['name']; ?></h6>
                </div>
                <div class="col-lg-1">
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
            }
            else{
              echo "<script>alert('Your cart is empty.');</script>";
            }
                ?>

              </div>
              <hr>

              <div class="bottom text-center ms-5 mb-3" style="width: 25rem;">
                <div class="card-body text-center" >
                  <!-- <p class="card-text text-secondary">SUBTOTAL : </p> -->
                  <p class="card-text text-secondary">SHIPPING : Free Shipping</p>
                  <h5 class="card-title" id="gtotal"> </h5>
                </div>
              </div>


              <!--<div class="row">-->
              <!--  <div class="col-lg-12">-->
              <!--    <div class=" card border-black bg-light text-center ms-3 mb-3" style="width: 30rem;">-->
              <!--      <div class="card-body">-->
              <!--        <h5 class="card-title">Credit Card/Debit Card/NetBanking</h5>-->
              <!--        <p class="card-text text-secondary">Cards, Netbanking, Wallet & UPI</p>-->

              <!--        <div class="mb-3 mt-3 bg-grey">-->
              <!--          <h6 class="card-header d-flex bg-white border justify-content-between align-items-center">-->
              <!--            Pay securely by Credit or Debit card or Internet Banking through Razorpay.-->
              <!--        </div>-->

              <!--      </div>-->
              <!--    </div>-->

              <!--    <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy.</a></p>-->
              <!--  </div>-->
              <!--</div>-->


              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">I have read and agree to the website <a href="terms&conditions.html">terms and conditions </a> and <a href="privacypolicy.html"> privacy policy</a></label>
              </div>

              <!-- <button type="button" class="btn me-5 btn-success " name="button" value="">Continue</button> -->


            </div>
          </form>
        </div>

        <button type="submit" class="btn me-5 mt-3 btn-success" name="button" value="">Continue</button>
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

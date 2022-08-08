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
$nam="";

if(isset($_POST['mod_quantity']))
{
  $qty = $_POST['mod_quantity'];
  $id = $_POST['quantity_id'];
  //echo "$id";
  $udatequantityquery = mysqli_query($conn,"update cart set quantity='$qty' where id = '$id'");

}

// $cartquantitylimit =  "SELECT sell.quantity FROM sell JOIN cart ON sell.id=cart.sell_id AND cart.name= sell.title";
// $run = mysqli_query($conn,$cartquantitylimit);
// $runs=mysqli_fetch_array($run);
// $maxquantity = $runs['quantity'];
// echo "$maxquantity";
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
  <title>cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://kit.fontawesome.com/8549de214a.js" crossorigin="anonymous"></script>
</head>

<style media="screen">
  .btn1 {
    width: 250px;
    border-radius: 30px;
  }


  .bottom {
    margin: auto;
  }

  .font-rale {
    font-family: "Raleway", cursive;
  }

  .button {
    float: right;
    width: 80px;
    border-radius: 30px;
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

        <!-- <form action="#" class="font-size-14 font-rale">
          <a href="#" class="py-2 rounded-pill color-primary-bg">
            <span class="font-size-16 px-2 text-white"><i class="fas fa-regular fa-heart"></i></span>
            <span class="px-3 py-2 rounded-pill text-dark bg-light">0</span>
          </a>
        </form> -->

        <form action="#" class="font-size-14 font-rale">
          <?php
            $select_rows = mysqli_query($conn,"select * from cart where user_id = '$idd'") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);
          ?>
          <a href="cart.php" class="py-2 rounded-pill color-primary-bg" >
            <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
            <span class="px-3 py-2 rounded-pill text-dark bg-light"><?php echo $row_count; ?></span>
          </a>
        </form>
      </div>
    </nav>
  </header>
  <!--Navigation ends -->

<!--form starts-->
  <section class="cart_form">
    <h1 class="mt-3 ms-5 text-center">Cart</h1>
    <div class="container col-lg-9 border bg-white shadow mt-3">
      <div class="col-lg-12">

        <!-- <form action="" method="post"> -->
          <!--form-top-part starts-->
          <div class="mb-3 mt-3">
            <h5 class="card-header d-flex bg-white border justify-content-between align-items-center">
              <!-- <i class="fa fa-check-square" aria-hidden="true"></i> -->
              "There is no greater compliment than having people buy our art."
              <a href="buy.php"><button type="button" class="btn btn-lg btn-success">Continue shopping</button></a>
          </div>
          <!--form-top-part ends-->


          <!--table-part starts-->
          <div class="detail mt-5">
            <div class="row">
              <div class="col-lg-1">
                <h6 class="text-secondary">ACTION</h6>
              </div>
              <div class="col-lg-3">
                <h6 class="text-secondary">PICTURE</h6>
              </div>
              <div class="col-lg-2">
                <h6 class="text-secondary">PRODUCT</h6>
              </div>
              <div class="col-lg-2">
                <h6 class="text-secondary">PRICE</h6>
              </div>
              <div class="col-lg-1">
                <h6 class="text-secondary">QUANTITY</h6>
              </div>
               <div class="col-lg-1">
                <h6 class="text-secondary"></h6>
              </div>
              <div class="col-lg-2">
                <h6 class="text-secondary">SUBTOTAL</h6>
              </div>
            </div>
            <hr>



            <div class="row">

              <?php
              if(mysqli_num_rows($select_cart)>0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                  // $subtotal = number_format($fetch_cart['quantity'] * $fetch_cart['price']);
                  //
                  //
                  // $total = $total +($fetch_cart['quantity'] * $fetch_cart['price']);
                  //echo "$total";

              ?>
        <!-- <form action="" method="post"> -->
              <div class="col-lg-1">
                <a href="delete.php?id=<?php echo $fetch_cart['id']; ?>" onclick="return checkdelete()"><i class="fa fa-times" aria-hidden="true"></i></a>
              </div>
              <div class="col-lg-3 mb-3">
                <img src="<?php echo $fetch_cart['image']; ?>" style="width: 130px; height: 100px;" alt="">
              </div>
              <div class="col-lg-2">
                <h6><?php echo $fetch_cart['name']; ?></h6>

              </div>
              <div class="col-lg-2">
                <h6><?php echo "₹ ".$fetch_cart['price']; ?><input type="hidden" class="iprice" value="<?php echo $fetch_cart['price']; ?>"></h6>
              </div>

                <div class="col-lg-1">
                  <form action="cart.php" method="post">
                    <?php
                    $nam = $fetch_cart['name'];

                    $maxlimit =  "SELECT sell.quantity FROM sell JOIN cart ON sell.title='$nam'";
                    $run = mysqli_query($conn,$maxlimit);
                    $runs=mysqli_fetch_array($run);
                    $maxquantity = $runs['quantity'];

                    ?>
                    <input type="hidden" name="quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input class="form-control iquantity" onchange='this.form.submit();' type="number" id="quantity" min="1" max="<?php echo $runs['quantity']; ?>" style="width: 80px;" name="mod_quantity" value="<?php echo $fetch_cart['quantity']; ?>" placeholder="0"/>
                    <!-- <input onClick="window.location.reload(true)"/> -->
                  </form>
              </div>

               <div class="col-lg-1">
                 <a onClick="window.location.reload(true)"><img src="images/upload.png" alt="upload" style="width:25px; height:25px;"></a>
                 <!-- <i class="fa-regular fa-arrow-up-from-square" ></i> -->
                 <!-- <i class="fas fa-solid fa-arrows-rotate " onClick="window.location.reload(true)"></i> -->
            </div>


            <div class="col-lg-2">
                <h6 class='itotal'></h6>
            </div>
        <!-- </form> -->
              <br /><br />
              <?php
            }
          }
          else{
            echo "<script>alert('Your cart is empty.');</script>";
          }
              ?>

            </div>

            <hr>
            <!-- <a href="" class="btn button btn-success">Update</a> -->


          </div>
          <!--table-part starts-->



          <div class="bottom text-center mb-3" style="width: 18rem;">
            <div class="card-body">
              <!-- <p class="card-text text-secondary">SUBTOTAL : </p> -->
              <p class="card-text text-secondary">SHIPPING : Free Shipping </p>
              <h5 class="card-title" id="gtotal" >  </h5>
              <a href="checkout.php" class="btn btn1  btn-success">Proceed to checkout</a>
            </div>
          </div>


        <!-- </form> -->

      </div>
    </div>
  </section>
  <!--form starts-->
  <script>
    function checkdelete()
    {
      return confirm('Are you sure you want to delete');
    }

    function refreshPage(){
      window.location.reload();
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

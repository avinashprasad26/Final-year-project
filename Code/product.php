<?php
session_start();
$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}

$ids=$_SESSION['user_name'];
$idd=$_SESSION['user_id'];

$ids=$_GET['id'];
$username = $_GET['username'];

$showquery="select * from sell where id='$ids'";
$showdata=mysqli_query($conn,$showquery);
$arrdata=mysqli_fetch_array($showdata);
$sell_id = $arrdata['id'];

$usernamequery="select * from signup where username = '$username' ";
$usernamedata=mysqli_query($conn,$usernamequery);
$arrusernamedata=mysqli_fetch_array($usernamedata);

if(isset($_POST['add_to_cart']))
{

  $name = $_POST['title'];
  $price = $_POST['price'];
  $quantity = 1;
  $image = $_POST['image'];


  $select_cart = mysqli_query($conn,"select * from cart where name = '$name'");
  if(mysqli_num_rows($select_cart)>0){
    echo"<script>alert('Art already added to cart');</script>";
  }
  else{
    $query = "insert into cart(sell_id, user_id,name,price,quantity,image) values('$sell_id','$idd','$name','$price','$quantity','$image')";
    if(mysqli_query($conn,$query)){
      echo"<script>alert('Art added to the cart');</script>";
    }
    else{
      echo"<script>alert('Art not added to the cart');</script>";
    }
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
  <title>product description</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

</head>

<style media="screen">
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  .row {
    background: white;
    border-radius: 30px;
    box-shadow: 2px 2px 8px;
  }

  #product_view {
    margin-top: 50px;
  }

  .product_view img {
    border-top-left-radius: 30px;
    border-bottom-left-radius: 30px;
  }

  .btn {
    border-radius: 20px;
    width: 180px;
    padding: 10px;
  }

  .magnifying_area {
    overflow: hidden;
    position: relative;
    display: flex;
  }

  .magnifying_img {
    transform: translate(-50%, -50%);
    position: fixed;
    pointer-events: none;
  }

  input[type="number"] {
    -webkit-appearance: textfield;
    -moz-appearance: textfield;
    appearance: textfield;
  }

  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
  }

  .number-input {
    border-radius: 30px;
    border: 2px solid #ddd;
    display: inline-flex;
  }

  .number-input,
  .number-input * {
    box-sizing: border-box;
  }

  .number-input button {
    outline: none;
    -webkit-appearance: none;
    background-color: transparent;
    border: none;
    align-items: center;
    justify-content: center;
    width: 3rem;
    height: 3rem;
    cursor: pointer;
    margin: 0;
    position: relative;
  }

  .number-input button:after {
    display: inline-block;
    position: absolute;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: '\f077';
    transform: translate(-50%, -50%) rotate(180deg);
  }

  .number-input button.plus:after {
    transform: translate(-50%, -50%) rotate(0deg);
  }

  .number-input input[type=number] {
    font-family: sans-serif;
    max-width: 5rem;
    padding: .5rem;
    border: solid #ddd;
    border-width: 0 2px;
    font-size: 2rem;
    height: 3rem;
    font-weight: bold;
    text-align: center;
  }

  .specification {
    padding: 100px;
  }

.artist {
  padding-right: 60px;
  padding-left: 60px;
  text-align: left;
}

</style>

<body>

  <header id="header">
    <!-- Primary Navigation -->
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
          <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
            <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
            <span class="px-3 py-2 rounded-pill text-dark bg-light"><?php echo $row_count; ?></span>
          </a>
        </form>
      </div>
    </nav>
  </header>


  <section class="product_view py-5 bg-light">
    <div class="container">
      <div class="row g-0">
        <div class="col-lg-5"   id="magnifying_are">
          <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="<?php echo $arrdata['image'] ?>" class="d-block" id="magnifying_im" style="height: 530px; width: 550px;" alt="...">
              </div>
              <div class="carousel-item">
                <img src="images/Bluepottery1.jpg" class="d-block" style="height: 530px; width: 550px;" alt="...">
              </div>
              <div class="carousel-item">
                <img src="images/Bluepottery2.jpg" class="d-block" style="height: 530px; width: 550px;" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>




        <div class="col-lg-7 py-5 text-center">
          <form class="" action="" method="post">
          <h2 class="text-center"><?php echo $arrdata['title']." artwork by ".$arrdata['name'] ?></h2>
          <h4><span><?php echo "₹ ".$arrdata['price'] ?></span></h4>
          <!-- <div class="number-input">
            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
            <input class="quantity" min="0" name="quantity" value="1" type="number">
            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
          </div> -->
          <!---<button type="button" type="number" class="btn btn-outline-secondary">Secondary</button>--->
          <input type="hidden" name="title" value="<?php echo $arrdata['title']; ?>">
          <input type="hidden" name="price" value="<?php echo $arrdata['price']; ?>">
          <input type="hidden" name="image" value="<?php echo $arrdata['image'];?>">
          <input type="hidden" name="sell_id" value="<?php echo $arrdata['id'];?>">
          <input type="submit" class="btn btn-success" value="Add to cart" name="add_to_cart">

          <div class="specification col-lg-12 py-4">
            <h5>Specification</h5> <hr>
            <h6 class="text-secondary">Type : <?php echo $arrdata['arttype'] ?>  </h6>
            <h6 class="text-secondary">Material : <?php echo $arrdata['material'] ?> </h6>
            <h6 class="text-secondary">Provenance : <?php echo $arrdata['provenance'] ?> </h6>
            <h6 class="text-secondary">Availability: <?php echo $arrdata['quantity'] ?> </h6>

            <div class="col-lg-12 artist">
              <div class="card">
  <div class="card-body">
      <img src="<?php echo $arrusernamedata['image_path'] ?>" class="rounded-circle col-lg-8" style="width: 50px; height: 50px;" alt="">
      <span class="text-center"><?php echo $arrdata['name'] ?></span>
  </div>
</div>


            </div>

          </div>
        </form>
        </div>


      </div>

    </div>

  </section>



<script type="text/javascript">

var magnifying_area = document.getElementById("magnifying_area");
var magnifying_img = document.getElementById("magnifying_img");

magnifying_area.addEventListener("mousemove", function(){
  clientX = event.clientX - magnifying_area.offsetLeft
  clientY = event.clientY - magnifying_area.offsetTop

  mWidth = magnifying_area.offsetWidth
  mHeight = magnifying_area.offsetHeight

  clientX = clientX / mWidth*100
  clientY = clientY / mHeight*100

  magnifying_img.style.transform = 'translate(-'+clientX+'%,-'+clientY+'%) scale(2)'
});

magnifying_area.addEventListener("mouseleave", function(){
  magnifying_img.style.transform = 'translate(-50%, -50%) scale(1)'
});

</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

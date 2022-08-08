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
//echo"$ids";
$showquery="select * from sell where arttype = 'Wood_crafts' and username!='$ids'";
$showdata=mysqli_query($conn,$showquery);

if(isset($_POST['add_to_cart']))
{

  $sell_id = $_POST['sell_id'];
  //$user_id = $_POST['sell_id'];
  $name = $_POST['title'];
  $price = $_POST['price'];
  $quantity = 1;
  $image = $_POST['image'];


  $select_cart = mysqli_query($conn,"select * from cart where user_id = '$idd' and name = '$name'");
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
  <title>Wood</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">

</head>

<style media="screen">
  h1 {
    text-align: center;
    font-family: 'Oswald', sans-serif;
    font-size: 60px;
  }

  .card-text {
    color: green;
    font-weight: bolder;
  }

  .btn {
    outline: 0;
    display: inline-block;
    padding: 8px;
    text-align: center;
    cursor: pointer;
    width: 100%;
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
          <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">Sort by -- </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <li><button class="dropdown-item" type="button">Sort by latest</button></li>
              <li><button class="dropdown-item" type="button">Sort by popularity</button></li>
              <li><button class="dropdown-item" type="button">Sort by price: low to high</button></li>
              <li><button class="dropdown-item" type="button">Sort by price: high to low</button></li>
            </ul>
          </div>
          <!---<li class="nav-item">
              <a class="nav-link" href="#">Category</a>
            </li>--->
        </ul>


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


  <section id="middle">
    <div class="container">
      <h1>Wood crafts</h1>
      <div class="row">
        <?php
        while($rows=mysqli_fetch_array($showdata)) {
          ?>
        <div class="col-3">
          <form class="" action="" method="post">
          <div class="card border-dark shadow text-center" style="width: 18rem;">
            <a href="product.php?id=<?php echo $rows['id']; ?>&username=<?php echo $rows['username']; ?>" target="_blank" rel="noopener">
              <img class="card-img-top" alt="..." width="220" height="250" border="0" align="center" src="<?php echo $rows['image'] ?>" /></a>
            <div class="card-body">
              <h5 class="card-title"><?php echo $rows['title']." artwork by ".$rows['name'] ?></h5>
              <p class="card-text"><span><?php echo "₹ ".$rows['price'] ?></span></p>
              <input type="hidden" name="title" value="<?php echo $rows['title']; ?>">
              <input type="hidden" name="price" value="<?php echo $rows['price']; ?>">
              <input type="hidden" name="image" value="<?php echo $rows['image'];?>">
              <input type="hidden" name="sell_id" value="<?php echo $rows['id'];?>">
              <!-- <button type="button" class="btn btn-warning" name="button" value="">Add to cart</button> -->
              <input type="submit" class="btn btn-warning" value="Add to cart" name="add_to_cart">
            </div>
          </div>
          </form>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

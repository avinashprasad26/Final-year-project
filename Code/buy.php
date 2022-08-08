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

$select_rows = mysqli_query($conn,"select * from cart where user_id = '$idd'") or die('query failed');
$row_count = mysqli_num_rows($select_rows);

$query_order = "select sell.title,sell.name,sell.price,sell.image from sell where sell.title in (SELECT order_details.name FROM order_details GROUP BY order_details.name HAVING COUNT(*)>1) ";
$querys_order=mysqli_query($conn,$query_order);
// $query_count = mysqli_num_rows($querys_order);
// if($query_count>0){
//     echo"<script>alert('$query_count');</script>";
// }
//$querydata = mysqli_fetch_assoc($querys_order);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buy</title>

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Owl-carousel CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

  <!-- font awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

  <!-- Custom CSS file -->
  <link rel="stylesheet" href="style.css">
</head>

<style media="screen">
  @import url("https://fonts.googleapis.com/css2?family=Baloo+Thambi+2&family=Raleway&family=Rubik&display=swap");

  /*              Sass Template           */
  /*  global classes  */
  button,
  button:focus {
    outline: none !important;
    box-shadow: none !important;
  }

  /* typography classes */
  .font-baloo {
    font-family: "Baloo Thambi 2", cursive;
  }

  .font-rale {
    font-family: "Raleway", cursive;
  }

  .font-rubik {
    font-family: "Rubik", cursive;
  }

  .font-size-12 {
    font-size: 12px;
  }

  .font-size-14 {
    font-size: 14px;
  }

  .font-size-16 {
    font-size: 16px;
  }

  .font-size-20 {
    font-size: 20px;
  }

  /* Color Template  */
  .color-primary {
    color: #003859;
  }

  .color-primary-bg {
    background: #003859;
  }

  .color-second {
    color: #00A5C4;
  }

  .color-second-bg {
    background: #00A5C4;
  }

  .color-yellow {
    color: #FFD289;
  }

  .color-yellow-bg {
    background: #FFD289;
  }

  /*  top sale template   */
  #top-sale .owl-carousel .item .product a {
    overflow: hidden;
  }

  #top-sale .owl-carousel .item .product img {
    transition: transform 0.5s ease;
  }

  #top-sale .owl-carousel .item .product img:hover {
    transform: scale(1.1);
  }

  #top-sale .owl-carousel .owl-nav button {
    position: absolute;
    top: 30%;
    outline: none;
  }

  #top-sale .owl-carousel .owl-nav button.owl-prev {
    left: 0;
  }

  #top-sale .owl-carousel .owl-nav button.owl-prev span,
  #top-sale .owl-carousel .owl-nav button.owl-next span {
    font-size: 35px;
    color: #003859;
    padding: 0 1rem;
  }

  #top-sale .owl-carousel .owl-nav button.owl-prev span {
    margin-left: -4rem;
  }

  #top-sale .owl-carousel .owl-nav button.owl-next {
    right: 0;
  }

  #top-sale .owl-carousel .owl-nav button.owl-next span {
    margin-right: -4rem;
  }

  /*   Special Price Section Template */
  #special-price .grid .grid-item {
    margin-right: 1.2rem;
    margin-top: 1rem;
  }

  .card-img-top {
    height: 250px;
    width: 271px;
    transition: transform 2s, filter 1.5s ease-in-out;
    transform-origin: center center;
    filter: brightness(50%);
  }

  .card-img-top:hover {
    filter: brightness(100%);
    transform: scale(1.1);
  }

  .card-title {
    font-weight: bolder;
  }
  
  .img-fluid{
      height: 180px;
      width: 1px;
  }

  /*# sourceMappingURL=style.css.map */
</style>

<body>

  <!-- start #header -->
  <header id="header">
    <!--<div class="strip d-flex justify-content-between px-4 py-1 bg-light">
                <p class="font-rale font-size-12 text-black-50 m-0">Jordan Calderon 430-985 Eleifend St. Duluth Washington 92611 (427) 930-5255</p>
                <div class="font-rale font-size-14">
                    <a href="#" class="px-3 border-right border-left text-dark">Login</a>
                    <a href="#" class="px-3 border-right text-dark">Whishlist (0)</a>
                </div>
            </div>-->

    <!-- Primary Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">artQuarium</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav m-auto font-rubik">
          <li class="nav-item active">
            <a class="nav-link" href="my_order.php">My Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="paymentdetails.php">My Payments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Cart</i></a>
          </li>

          <!--<li class="nav-item">-->
          <!--  <a class="nav-link" href="#">Category <i class="fas fa-chevron-down"></i></a>-->
          <!--</li> -->-->

        </ul>
        <form action="#" class="font-size-14 font-rale">
          <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
            <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
            <span class="px-3 py-2 rounded-pill text-dark bg-light"><?php echo $row_count; ?></span>
          </a>
        </form>
      </div>
    </nav>
    <!-- !Primary Navigation -->

  </header>
  <!-- !start #header -->

  <!-- start #main-site -->
  <main id="main-site">

    <!-- Top Sale -->
    <section id="special-price">
        <div class="container"><br><br>
            <h3 class="font-rubik font-size-30">Featured Arts</h3>
            <hr>
            <div class="row">
                
                <?php 
                    while($querydata = mysqli_fetch_assoc($querys_order)){
                ?>
                <div class="col-3">
                    <div class="card border-dark text-center" style="width: 17rem;">
                        <img src="<?php echo $querydata['image'];?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $querydata['title']." by ".$querydata['name'];?></h5>
                            <p class="card-text"><?php echo "₹ ".$querydata['price'];?></p>
                            <!--<a href="cart.php" class="btn btn-warning">Add to Cart</a>-->
                            <!--<input type="submit" class="btn btn-warning" value="Add to cart" name="add_to_cart">-->
                        </div>
                    </div>
                </div>
                
                <?php
                    }
                ?>
            </div>
        </div>
      <br>
    </section>

    <!-- !Top Sale -->

    <!-- Special Price -->
    <section id="special-price">
      <div class="container">
        <h3 class="font-rubik font-size-30">Categories</h3>
        <hr>
        

        <div class="row">
          <div class="col-3">
            <div class="card border-dark text-center" style="width: 17rem;">
              <img src="images/stone.jpeg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Stone crafts</h5>
                <p class="card-text">In India stone craft is practiced through exquisite figures that are carved in relief with details engraved in fine lines and intricate works.</p>
                <a href="stone_crafts.php" class="btn btn-warning">Check more</a>
              </div>
            </div>
          </div>

          <div class="col-3">
            <div class="card border-dark text-center" style="width: 17rem;">
              <img src="images/needle.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Needlework</h5>
                <p class="card-text">Needlework is decorative sewing and textile arts handicrafts. It may include related textile crafts such as crochet, worked with a hook, tatting, and shuttle.</p>
                <a href="needle_work.php" class="btn btn-warning">Check more</a>
              </div>
            </div>
          </div>

          <div class="col-3">
            <div class="card border-dark text-center" style="width: 17rem;">
              <img src="images/house.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Houseware</h5>
                <p class="card-text">Housewares are equipment used in home, includes decorative home products for kitchen, picture frames, crystal, silver and framed art.</p>
                <a href="houseware.php" class="btn btn-warning">Check more</a>
              </div>
            </div>
          </div>

          <div class="col-3">
            <div class="card border-dark text-center" style="width: 17rem;">
              <img src="images/ceramic.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Ceramics and glass crafts</h5>
                <p class="card-text">Ceramic art is art made from ceramic materials. It may take forms including artistic pottery, tableware, tiles, sculpture.</p>
                <a href="ceramics.php" class="btn btn-warning">Check more</a>
              </div>
            </div>
          </div>
        </div>



        <div class="row" style="margin-top:20px;">
          <div class="col-3">
            <div class="card border-dark text-center" style="width: 17rem;">
              <img src="images/wood.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Wood crafts</h5>
                <p class="card-text">woodcraft denotes skills and experience in matters relating to living and thriving in the woods such as hunting, fishing, and camping whether on a short or long-term basis.</p>
                <a href="wood.php" class="btn btn-warning">Check more</a>
              </div>
            </div>
          </div>

          <div class="col-3">
            <div class="card border-dark text-center" style="width: 17rem;">
              <img src="images/paint.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Paintings</h5>
                <p class="card-text">Painting is the practice of applying paint, pigment, color to a solid surface. The medium is commonly applied to the base with a brush, knives, sponges, and airbrushes.</p>
                <a href="painting.php" class="btn btn-warning">Check more</a>
              </div>
            </div>
          </div>

          <div class="col-3">
            <div class="card border-dark text-center" style="width: 17rem;">
              <img src="images/carving.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Carving</h5>
                <p class="card-text">Carving is the act of using tools to shape something from a material by scraping away portions it. It means for making stone or wooden sculpture by using clay and melted glass.</p>
                <a href="carving.php" class="btn btn-warning">Check more</a>
              </div>
            </div>
          </div>
        </div>


      </div>
      </div>
      <br>
    </section>
  </main>
  <!-- !start #main-site -->

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!-- Owl Carousel Js file -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

  <!--  isotope plugin cdn  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha256-CBrpuqrMhXwcLLUd5tvQ4euBHCdh7wGlDfNz8vbu/iI=" crossorigin="anonymous"></script>

  <!-- Custom Javascript -->
  <script src="buy.js"></script>
</body>
</html>

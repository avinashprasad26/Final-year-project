<?php
session_start();
if(!isset($_SESSION['user_name'])){
  header('location:Login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </head>

  <style media="screen">

    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    *{
      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    .header{
      background-image: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)), url("images/view.gif");
      width: 100%;
      height: 100vh;
      background-position: center;
      background-size: cover;
      position: relative;
    }

    .wave{
      position: absolute;
      bottom: 0px;
    }

    .navbar-brand{
      color: var(--main-color) !important;
    }

    .act{
      color: var(--main-color) !important;
      border-bottom: 1px solid var(--main-color);
    }

    .navbar ul li a:hover{
      color: var(--main-color) !important;
      border-bottom: 1px solid var(--main-color);
    }

    .middle{
      height: 80vh;
      width: 80%;
      display: flex;
      justify-content: start;
      align-items: center;
    }

    .middle h1{
      font-size: 70px;
    }

    :root{
      --main-color: #f0b30f;
    }

    .theme-text{
      color: var(--main-color);
    }

    .btn{
      color: white;
      border-radius: 20px;
    }

    .btn:hover {

    background-color: var(--main-color);
    }

  </style>

  <body>
    <section class="header">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">artQuarium</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link act" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Wall.php">Social</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="buy.php">Buy</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sell.php">Sell</a>
        </li>
        <li class="nav-item">
          <button type="button" class="btn btn-outline-primary" onclick="window.location.href = 'logout.php';">
       Log Out</button>
        </li>
      </ul>

    </div>
  </div>
</nav>






        <div class="middle">
          <h1 class="text-white fw-bold display-3">welcome <span class="theme-text">  <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} ?></span> to artQuarium</h1>

        </div>

      </div>

      <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
           <path fill="#fff" fill-opacity="1"
               d="M0,192L60,181.3C120,171,240,149,360,133.3C480,117,600,107,720,106.7C840,107,960,117,1080,122.7C1200,128,1320,128,1380,128L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
           </path>
       </svg>

    </section>

  </body>
</html>

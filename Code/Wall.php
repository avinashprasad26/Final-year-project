<?php

session_start();

require 'ajax.php';

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}
$ids=$_SESSION['user_name'];

$showquery="select * from signup where username='$ids'";
$showdata=mysqli_query($conn,$showquery);
$rows=mysqli_fetch_array($showdata);
$userid = $rows['idd'];

$querys = "SELECT post.id,post.user_name,post.post_img,post.post_text,post.created_at,signup.fname,signup.lname,signup.username,signup.image_path FROM post JOIN signup ON signup.username=post.user_name ORDER BY post.id DESC";
$run = mysqli_query($conn,$querys);
//$arrayrows = mysqli_fetch_all($run);

$current_user = $_SESSION['user_name'];
$postquery="SELECT * FROM signup WHERE username != '$current_user' ";
$postrun = mysqli_query($conn,$postquery);


mysqli_close($conn);

if(!isset($_SESSION['user_name'])){
  header('location:Login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="bootstrap/icons/bootstrap-icons.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
    

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wall</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border">
        <div class="container col-9 d-flex justify-content-between">
            <div class="d-flex justify-content-between col-8">
                <a class="navbar-brand" href="Wall.php">
                <span class="navbar-brand mb-0 h1">postQuarium</span>

                </a>

                <!--<form class="d-flex">-->
                <!--    <input class="form-control me-2" type="search" placeholder="looking for someone.."-->
                <!--        aria-label="Search">-->

                <!--</form>-->

            </div>


            <ul class="navbar-nav  mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link text-dark" href="Wall.php"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark"  href="post.php"><i class="bi bi-plus-square-fill"></i></a>
                </li>
                <!--<li class="nav-item">-->
                <!--    <a class="nav-link text-dark" href="#"><i class="bi bi-bell-fill"></i></a>-->
                <!--</li>-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $rows['image_path'] ?>" alt="" width="30" height="30" class="rounded-circle border">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="edit_profile.php">My Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>

            </ul>


        </div>
    </nav>
    <div class="container col-9 rounded-0 d-flex justify-content-between">
        <div class="" style="width:800px; margin:auto;">
          <?php
          while($arrayrows = mysqli_fetch_assoc($run)) {
            ?>
            <div class="card mt-4">
                <div class="card-title d-flex justify-content-between  align-items-center">

                    <div class="d-flex align-items-center p-2">
                        <img src="<?php echo $arrayrows['image_path'] ?> " alt="" height="40" class="rounded-circle border">&nbsp;&nbsp;
                        <a href="" style="text-decoration:none; color:black;"><h6 style="margin: 0px;"><?php echo $arrayrows['fname']." ".$arrayrows['lname'] ?></h6></a>
                    </div>
                    <div class="p-2">
                        <i class="bi bi-three-dots-vertical"></i>
                    </div>
                </div>
                <img src="<?php echo $arrayrows['post_img'] ?>" class="" alt="..." >
                <h4 style="font-size: x-larger" class="p-2 border-bottom"><i class="bi bi-heart like_btn" data-user='<?php echo $userid;?>' data-post='<?php echo $arrayrows['id'];?>'></i>
    
                    &nbsp;&nbsp;<i class="bi bi-chat-left"></i>
                </h4>

                <?php

                if($arrayrows['post_text']){
                  ?>

                  <div class="card-body">
                      <?php echo $arrayrows['post_text'] ?>
                  </div>

                  <?php
                }
                ?>



                <div class="input-group p-2 border-top">
                    <input type="text" class="form-control rounded-0 border-0" placeholder="say something.."
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary rounded-0 border-0" type="button"
                        id="button-addon2">Post</button>
                </div>

            </div>

          <?php
          }
           ?>




        </div>

        
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $(".followbtn").click( function() {
            var user_id_v = $(this).data("user");
            var button = this;
            $(button).attr('disabled',true);
            // $(this).text(user_id);
            $.ajax({
                url: 'ajax.php?follow',
                method: 'post',
                dataType: 'json',
                data: {user_id: user_id_v},
                success: function(response){
                    if(response.status){
                        $(button).data('user',0);
                        $(button).html('<i class="bi bi-check-circle-fill"></i> Followed');
                    }
                    else{
                        $(button).attr('disabled',false);
                    }
                }
            });
        });
    </script>
    <script>
         $(".like_btn").click( function() {
             var user_id_v = $(this).data("user");
             var post_id_v = $(this).data("post");
             var button = this;
             $(button).attr('disabled',true);
             //$(this).text(post_id_v);

            $.ajax({
                url: 'ajax.php?like',
                method: 'post',
                dataType: 'json',
                data: {user_id: user_id_v ,post_id: post_id_v},
                success: function(response){
                    if(response.status){
                        $(button).attr('disabled',false);
                        $(button).attr('class','bi bi-heart-fill unlike_btn');
                        button = null;
                    else{
                        $(button).attr('disabled',false);
                    }
                }
            });
        });
    </script>
    //     <script>
    //      $(".unlike_btn").click( function() {
    //          var user_id_v = $(this).data("user");
    //          var post_id_v = $(this).data("post");
    //          var button = this;
    //          $(button).attr('disabled',true);
    //          //$(this).text(post_id_v);

    //         $.ajax({
    //             url: 'ajax.php?unlike',
    //             method: 'post',
    //             dataType: 'json',
    //             data: {user_id: user_id_v ,post_id: post_id_v},
    //             success: function(response){
    //                 if(response.status){
    //                     $(button).attr('disabled',false);
    //                     $(button).attr('class','bi bi-heart like_btn');
    //                     button=null;
    //                 }
    //                 else{
    //                     $(button).attr('disabled',false);
    //                 }
    //             }
    //         });
    //     });
    // </script>
</body>

</html>

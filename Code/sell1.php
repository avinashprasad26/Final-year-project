<?php

session_start();
$username = $_SESSION['user_name'];

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}
if(isset($_POST['submit']))
{
  //echo"$username";

  $artist = $_POST['artist'];
  $year = $_POST['year'];
  $title = $_POST['title'];
  $material = $_POST['material'];
  $height = $_POST['height'];
  $width = $_POST['width'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $type = $_POST['type'];
  $city = $_POST['city'];
  $provenance = $_POST['provenance'];
  $file = $_FILES['file'];

  $filename = $file['name'];
  $fileerror = $file['error'];
  $filetmp = $file['tmp_name'];

  $fileext = explode('.',$filename);
  $filecheck = strtolower(end($fileext));
  $fileextstored = array('png' ,'jpg','jpeg' );

  $address = $_POST['address'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];



  if(in_array($filecheck,$fileextstored)){

        $destinationfile = 'artist/'.$filename;
        move_uploaded_file($filetmp,$destinationfile);

        $query = "insert into sell(name, year, title, material, height, width,price,quantity,arttype, city, provenance, image, address, email, phone, username) values('$artist','$year','$title','$material','$height','$width','$price','$quantity','$type','$city','$provenance','$destinationfile','$address','$email','$phone','$username')";
        if(mysqli_query($conn,$query))
        {
              echo"<script>alert('Successfully Submitted Artwork');</script>";
              //header('Location: sell.php');
        }
        else{
              echo "Error: " .$sql."".mysqli_error($conn);
            }
      }
      else{
        echo"<script>alert('Welcome to sell dashboard');</script>";
      }

}
  mysqli_close($conn);

 ?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Sell Form</title>

  <script>
    if(window.history.replaceState){
      window.history.replaceState(null,null,window.location.href);
    }
  </script>

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel="stylesheet" href="style.css">
</head>

<style media="screen">

body {
  background-image: url("images/rm.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}

  .btn-outline-dark{
    border-radius: 20px;
  }

  .content{
    margin-top: 5px;
  }
</style>

<body>


<div class="content">
  <div class="content__inner">

    <div class="container overflow-hidden shadow">
      <div class="multisteps-form">
        <div class="row">
          <div class="col-12 col-lg-12 ml-auto mr-auto mb-2">
            <div class="multisteps-form__progress">
              <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">Artwork Details</button>
              <button class="multisteps-form__progress-btn" type="button" title="Address">Upload Photos</button>
              <button class="multisteps-form__progress-btn" type="button" title="Order Info">Contact Information</button>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-12 m-auto">
            <form action="" method="post" class="multisteps-form__form" enctype="multipart/form-data">
              <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                <h3 class="multisteps-form__title text-center">Tell us about your artwork</h3>
                <div class="multisteps-form__content">

                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6">
                      <label for="">ARTIST</label>
                      <input class="multisteps-form__input form-control" id="artist" name="artist" value="" type="text" placeholder="Enter Full Name" onkeyup="isEmpty()"/>
                    </div>
                    <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                      <label for="">YEAR</label>
                      <input class="multisteps-form__input form-control" id="year" name="year" value="" type="text" placeholder="YYYY" onkeyup="isEmpty()"/>
                    </div>
                  </div>

                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6">
                      <label for="">TITLE</label>
                      <input class="multisteps-form__input form-control" id="title" name="title" value="" type="text" placeholder="Add Title or write 'unknown'" onkeyup="isEmpty()"/>
                    </div>
                    <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                      <label for="">MATERIALS</label>
                      <input class="multisteps-form__input form-control" id="material" name="material" value="" type="text" placeholder="Add materials" onkeyup="isEmpty()"/>
                    </div>
                  </div>

                  <div class="form-row mt-4">
                    <div class="col-6 col-sm-3 mt-4 mt-sm-0">
                      <label for="">HEIGHT (in cm)</label>
                      <input class="multisteps-form__input form-control" id="height" name="height" value="" type="number" placeholder="height" onkeyup="isEmpty()"/>
                    </div>
                    <div class="col-6 col-sm-3 mt-4 mt-sm-0">
                      <label for="">WIDTH (in cm)</label>
                      <input class="multisteps-form__input form-control" id="width" name="width" value="" type="text" placeholder="width" onkeyup="isEmpty()"/>
                    </div>
                    <div class="col-6 col-sm-3 mt-4 mt-sm-0">
                      <label for="">PRICE</label>
                      <input class="multisteps-form__input form-control" type="number" id="price" name="price" value="" placeholder="₹" onkeyup="isEmpty()"/>
                    </div>
                    <div class="col-6 col-sm-3 mt-4 mt-sm-0">
                      <label for="">QUANTITY</label>
                      <input class="multisteps-form__input form-control" type="number" id="quantity" name="quantity" value="" placeholder="quantity" onkeyup="isEmpty()"/>
                    </div>
                  </div>

                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6">
                      <label for="">TYPE OF ART WORK</label>
                      <select class="multisteps-form__input form-control" id="type" name="type" value class="form-select" aria-label="Default select example" onkeyup="isEmpty()">
                        <option selected id="type" onkeyup="isEmpty()">-----</option>
                        <option value="Stone_crafts" id="type" onkeyup="isEmpty()">Stone crafts</option>
                        <option value="Needlework" id="type" onkeyup="isEmpty()">Needlework</option>
                        <option value="Houseware" id="type" onkeyup="isEmpty()">Houseware</option>
                        <option value="Ceramics_and_glass_crafts" id="type" onkeyup="isEmpty()">Ceramics and glass crafts</option>
                        <option value="Wood_crafts" id="type" onkeyup="isEmpty()">Wood crafts</option>
                        <option value="Paintings" id="type" onkeyup="isEmpty()">Paintings</option>
                        <option value="Carving" id="type" onkeyup="isEmpty()">Carving</option>
                      </select>
                    </div>
                    <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                      <label for="">CITY</label>
                      <input class="multisteps-form__input form-control" type="text" id="city" name="city" value="" placeholder="Enter City Where Artwork Located" onkeyup="isEmpty()"/>
                    </div>
                  </div>

                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-12">
                      <label for="">PROVENANCE</label>
                      <input class="multisteps-form__input form-control" id="provenance" type="text" name="provenance" value="" placeholder="Describe How You Accuried the Work" onkeyup="isEmpty()"/>
                    </div>
                  </div>

                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary ml-auto js-btn-next" id="btn1" type="button" title="Next" disabled>Next</button>
                  </div>

                </div>
              </div>


  <!--2nd  part of the form -->

              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Upload photos of your artwork</h3>
                <p class="text-secondary">To evaluate your submission faster, please upload high-quality photos of the work's front and back.</p>
                <div class="multisteps-form__content">
                  <h4>Drag and drop photos here</h4>
                  <p class="text-secondary">Files supported: JPG, JPEG, PNG</p>
                    <div class="mb-1 col-md-12 text-center">
                      <input class="form-control" type="file" name="file" value="" id="select_post_image">
                      <!--<button class="btn btn-outline-dark d-grid gap-2 col-6 mx-auto"" type=" button" name="button" value="">Add Photo</button>-->
                    </div>
                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                    <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>

                  </div>
                </div>
              </div>


 <!---3rd part of the form--->

              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                  <h3 class="multisteps-form__title">Let us know how to reach you</h3>
                <p class="text-secondary">We will only use these details to contact you regarding your submission.</p>
                  <div class="multisteps-form__content">
                    <div class="form-row mt-4">
                      <div class="col">
                        <label for="">ADDRESS</label>
                        <input class="multisteps-form__input form-control" type="text" name="address" value="" placeholder="Your Address"/>
                      </div>
                    </div>
                    <div class="form-row mt-4">
                      <div class="col">
                        <label for="">EMAIL</label>
                        <input class="multisteps-form__input form-control" type="email" name="email" value="" placeholder="Your Email Address"/>
                      </div>
                    </div>

                    <div class="form-row mt-4">
                      <div class="col">
                        <label for="">PHONE NUMBER</label>
                        <input class="multisteps-form__input form-control" type="tel" name="phone" value="" placeholder="91+ "/>
                      </div>
                    </div>

                    <div class="button-row d-flex mt-4">
                      <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                      <button class="btn  btn-success ml-auto js-btn-next" type="submit" name="submit" value="" title="">Submit</button>
                    </div>
                  </div>
                </div>


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function isEmpty(){
    let artist = document.getElementById("artist").value;
    let year = document.getElementById("year").value;
    let title = document.getElementById("title").value;
    let material = document.getElementById("material").value;
    let height = document.getElementById("height").value;
    let width = document.getElementById("width").value;
    let type = document.getElementById("type").value;
    let provenance = document.getElementById("provenance").value;
    let city = document.getElementById("city").value;

    if((artist != '') && (year != '') && (title != '') && (material != '') && (height != '') && (width != '') && (type != '') && (provenance != '') && (city != '')){
      document.getElementById("btn1").removeAttribute("disabled");
    }
  }
</script>

<script  src="function.js"></script>

</body>
</html>

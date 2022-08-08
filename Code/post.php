<?php
session_start();
$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}
if(isset($_POST['post']))
{
  $user_name=$_SESSION['user_name'];
  //echo "$user_name";
  $file = $_FILES['post_img'];
  $text = $_POST['post_text'];
  $filename = $file['name'];
  $fileerror = $file['error'];
  $filetmp = $file['tmp_name'];
  $fileext = explode('.',$filename);
  $filecheck = strtolower(end($fileext));
  $filesize = $file['size']/(1024*1024);
  $fileextstored = array('png' ,'jpg','jpeg' );
  if(in_array($filecheck,$fileextstored)){
    $destinationfile = 'upload/'.$filename;
    move_uploaded_file($filetmp,$destinationfile);
    
    $query = "insert into post(user_name,post_img,post_text) values('$user_name','$destinationfile','$text')";
  if(mysqli_query($conn,$query) && ($filesize < 1))
  {
    //header('Location: wall.php');
    echo"<script>alert('Posted Successfully...');</script>";
  }
  else{
      echo"<script>alert('Post Again and Check for Image size should be less than 1MB ...');</script>";
      //echo "Error: " .$sql."".mysqli_error($conn);
    }
  }
  else{
    $_SESSION['status'] = " Please upload only JPG, PNG or JPEG image. ";
  }
}
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>post</title>
    <script>
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/icons/bootstrap-icons.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">

  </head>
  <body>
    <!-- Button trigger modal -->
    <div class="modal-dialog" id= "id1">
            <div class="modal-content">
                <div  class="modal-header">
                    <h5 class="modal-title">Add New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.href='Wall.php'" ></button>
                </div>
                <div class="modal-body">
                    <img src="img/post.jpg" style="display:none" id="post_img" class="w-100 rounded border">
                    <form method="post" action="" enctype="multipart/form-data" required>
                        <div class="my-3">
                            <input class="form-control" name="post_img" type="file" id="select_post_image">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Say Something</label>
                            <textarea class="form-control" name="post_text" id="exampleFormControlTextarea1" rows="1"></textarea>
                        </div>

                            <button type="submit" name="post" class="btn btn-primary">Post</button>

                    </form>


                </div>
            </div>
        </div>



    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      var input = document.querySelector("#select_post_image");
      input.addEventListener("change", preview);

      function preview(){
        var fileobject = this.files[0];
        var filereader = new FileReader();


        filereader.readAsDataURL(fileobject);

        filereader.onload=function(){
          var image_src=filereader.result;
          var image=document.querySelector("#post_img");
          image.setAttribute('src',image_src);
          image.setAttribute('style', 'display:');
        }
      }

    </script>
</body>
</html>

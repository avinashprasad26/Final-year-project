<?php

session_start();

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}
$ids=$_SESSION['user_name'];
//echo"$ids";
$showquery="select * from signup where username='$ids'";
$showdata=mysqli_query($conn,$showquery);
$rows=mysqli_fetch_array($showdata);
$_SESSION['user_id'] = $rows['idd'];

if(isset($_POST['update']))
{

  $file = $_FILES['file'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];

  $filename = $file['name'];
  $fileerror = $file['error'];
  $filetmp = $file['tmp_name'];
  
  $filesize = $file['size']/(1024*1024);

  $fileext = explode('.',$filename);
  $filecheck = strtolower(end($fileext));
  $fileextstored = array('png' ,'jpg','jpeg' );

  if(in_array($filecheck,$fileextstored)){

    $destinationfile = 'upload/'.$filename;
    move_uploaded_file($filetmp,$destinationfile);

  $query = " update signup SET image_path='$destinationfile', fname='$fname',lname='$lname',gender='$gender',dob='$dob' where username='$ids'";

  if((mysqli_query($conn,$query)) && ($filesize < 1))
  {
    echo"<script>alert('Updated Successfully...');</script>";
    //header('Location: pharmacey.php');
  }
  else{
      echo"<script>alert('Updation Failed...');</script>";
      //echo "Error: " .$sql."".mysqli_error($conn);
    }

  }
  else{
    $_SESSION['status'] = " Please upload only JPG, PNG or JPEG image. ";
  }
}
mysqli_close($conn);
if(!isset($_SESSION['user_name'])){
  header('location:Login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <script>
    if(window.history.replaceState){
      window.history.replaceState(null,null,window.location.href);
    }
  </script>

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
                <a class="navbar-brand" href="wall.php">
                    <span class="navbar-brand mb-0 h1">postQuarium</span>

                </a>

                <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="looking for someone.."
                        aria-label="Search">

                </form> -->

            </div>


            <ul class="navbar-nav  mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link text-dark" href="wall.php"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="post.php"><i class="bi bi-plus-square-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="bi bi-bell-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="bi bi-chat-right-dots-fill"></i></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $rows['image_path'] ?>" alt="" height="30" class="rounded-circle border">
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Account Settings</a></li> -->
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
        <div class="col-12 bg-white border rounded p-4 mt-4 shadow-sm">
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">Edit Profile</h1>
                <div class="form-floating mt-1 col-6">
                    <img src="<?php echo $rows['image_path'] ?>" class="img-thumbnail my-3" style="height:150px;" alt="...">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Change Profile Picture (Image size should be less than 1MB)</label>
                        <input class="form-control" type="file" name="file" id="formFile" >
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-floating mt-1 col-6 ">
                        <input type="text" class="form-control rounded-0" name="fname" value="<?php echo $rows['fname'] ?>">
                        <label for="floatingInput">First Name</label>
                    </div>

                    <div class="form-floating mt-1 col-6">
                        <input type="text" class="form-control rounded-0" name="lname" value="<?php echo $rows['lname'] ?>">
                        <label for="floatingInput">Last Name</label>
                    </div>
                </div>


                <div class="form-floating mt-1">


                  <select id="gender" name="gender" class="form-select" aria-label="Default select example" required>
                    <option selected>    </option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                  <label for="floatingInput">Gender</label>


                </div>


                <div class="form-floating mt-1">
                    <input type="text" class="form-control rounded-0"  name="email" value="<?php echo $rows['email'] ?>" disabled>
                    <label for="floatingInput">Email</label>
                </div>

                <div class="form-floating mt-1">
                    <input type="text" class="form-control rounded-0" name="dob" value="<?php echo $rows['dob'] ?>">
                    <label for="floatingInput">Date of Birth</label>
                </div>

                <div class="form-floating mt-1">
                    <input type="text" class="form-control rounded-0" name="username" value="<?php echo $rows['username'] ?>" disabled>
                    <label for="floatingInput">Username</label>
                </div>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="update" name="update" value="">Update Profile</button>



                </div>

            </form>
        </div>

    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

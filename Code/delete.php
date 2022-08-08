<?php

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}
$id=$_GET['id'];
$query="delete from cart where id='$id'";
$data=mysqli_query($conn,$query);
if($data)
{
    echo"<script>alert('Art deleted from cart');
    window.location.href='cart.php';</script>";
}
else {
  echo"<script>alert('Failed to delete the Art from cart');</script>";
}

 ?>

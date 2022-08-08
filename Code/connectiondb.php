<?php
    $conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb','3306');
    if (!$conn) {
      die('Connection Failed : '.mysqli_connect_error);
    }
?>

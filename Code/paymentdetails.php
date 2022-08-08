<?php
session_start();
$username = $_SESSION['user_name'];
//echo"$username";
$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}

$query = "select * from paymentdetails where username = '$username'";

$querydetail = mysqli_query($conn,$query);
$total=mysqli_num_rows($querydetail);
if($total != 0){
   echo"<script>alert('Table has $total records.');</script>";
 }
 else{
     echo"<script>alert('Table has no records.');</script>";
 }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8549de214a.js" crossorigin="anonymous"></script>


  </head>

     <style media="screen">

       *{
         margin: 0px;
         padding:0px;
       }

       body{
         background-image: url('images/white.jpg');
         background-attachment: fixed;
         background-size: cover;
         font-family: new time romain;
       }

       h1{
         color:black;
         text-align: center;
         margin-top: 0;
         padding: 20px;
         margin-bottom: 10px;
         width: 100%;
         font-family: 'Lobster', cursive;
           font-size: 50px;
       }

       th{
         color: black;
         font-size: 25px;
        }

        td{
          color: black;
          font-size: 18px;
        }

     </style>

  <body>

    <div class="container">
      <h1>Payment History</h1>

        <div class="table-responsive">
          <table class="table" align="center" border="1px">
            <br><tr>
              <th>Order_Id</th>
              <th>Payment_Id</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Amount</th>
              <th>Order_Date</th>
            </tr>

            <?php
            while($rows=mysqli_fetch_assoc($querydetail))
            {
              ?>

              <tr>
                <td><?php echo $rows['ordersid']; ?></td>
                <td><?php echo $rows['paymentid']; ?></td>
                <td><?php echo $rows['emailid']; ?></td>
                <td><?php echo $rows['phone']; ?></td>
                <td><?php echo "₹ ".$rows['amount']; ?></td>
                <td><?php echo $rows['orderdate']; ?></td>
              </tr>
              <?php
              }
             ?>

          </table>

        </div>

    </div>

  </body>
</html>

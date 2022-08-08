<?php
session_start();
$username = $_SESSION['user_name'];
//echo"$username";
$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}

$usernamequery="select * from signup where username = '$username' ";
$usernamedata=mysqli_query($conn,$usernamequery);
$arrusernamedata=mysqli_fetch_array($usernamedata);
$idd = $arrusernamedata['idd'];

$orderquery = "SELECT sell.title,sell.arttype,sell.image,sell.name,sell.phone,sell.email,order_details.order_id,order_details.quantity,order_details.price,person_order_details.street_address,person_order_details.town,person_order_details.state,person_order_details.country,person_order_details.pincode FROM order_details,sell,person_order_details WHERE order_details.sell_id = sell.id AND order_details.p_o_d_id = person_order_details.id  AND order_details.user_id = '$idd'";

$queryorder=mysqli_query($conn,$orderquery);
$total=mysqli_num_rows($queryorder);
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
      <h1>Order's Records</h1>

        <div class="table-responsive">
          <table class="table" align="center" border="1px">
            <br><tr>
              <th>Order_id</th>
              <th>Image</th>
              <th>Seller_Name</th>
              <th>Art_Name</th>
              <th>Art Type</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Ordered_Address(State/Country/Pincode)</th>
              <th>Seller_Phone</th>
              <th>Seller_Email</th>
            </tr>

            <?php
            while($rows=mysqli_fetch_assoc($queryorder))
            {
              ?>

              <tr>
                <td><?php echo $rows['order_id']; ?></td>
                <td><img src="<?php echo $rows['image']; ?>" alt="" width="210" height="200"/></td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['title']; ?></td>
                <td><?php echo $rows['arttype']; ?></td>
                <td><?php echo $rows['quantity']; ?></td>
                <td><?php echo $rows['price']; ?></td>
                <td><?php echo $rows['street_address'].", ".$rows['town']." ".$rows['state'].", ".$rows['country']."-".$rows['pincode'];?></td>
                <td><?php echo $rows['phone']; ?></td>
                <td><?php echo $rows['email']; ?></td>
                <!-- <td><a href="Edit.php?ii=" data-bs-toggle="tooltip" title="Update"><i class="fas fa-edit" aria-hidden="true"></i></a></td> -->
                <!-- <td><a href="delete.php?ii=" onclick="return checkdelete()" data-bs-toggle="tooltip" title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></a></td> -->
              </tr>
              <script>
                function checkdelete()
                {
                  return confirm('Are you sure you want to delete');
                }
              </script>
              <?php
              }
             ?>

          </table>

        </div>

    </div>

  </body>
</html>

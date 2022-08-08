<?php

require('config.php');
require('razorpay-php/Razorpay.php');
session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}
$ids=$_SESSION['user_name'];

$usernamequery="select * from signup where username = '$ids' ";
$usernamedata=mysqli_query($conn,$usernamequery);
$arrusernamedata=mysqli_fetch_array($usernamedata);
$idd = $arrusernamedata['idd'];

$select_cart = mysqli_query($conn,"select * from cart where user_id = '$idd'");

$subtotal=0;
$total=0;
while($fetch_cart = mysqli_fetch_assoc($select_cart)){
    $subtotal = number_format($fetch_cart['quantity'] * $fetch_cart['price']);
    $total = $total +($fetch_cart['quantity'] * $fetch_cart['price']);
    //echo "$total";
}

$_SESSION['amount'] = $total;
$_SESSION['email'] = $arrusernamedata['email'];
$emails = $_SESSION['email'];
$_SESSION['phone'] = $arrusernamedata['pno'];
$pno = $_SESSION['phone'];
$_SESSION['name'] = $arrusernamedata['fname']." ".$arrusernamedata['lname'];
$names = $_SESSION['name'];


$orderData = [
    'receipt'         => 82829124,
    'amount'          => $total * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'manual';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $total,
    "name"              => "artquarium.in",
    "description"       => "Art Gallery With E-Commerece",
    "image"             => "http://artquarium.in/artlogo.png",
    "prefill"           => [
    "name"              => $names,
    "email"             => $emails,
    "contact"           => $pno,
    ],
    "notes"             => [
    "address"           => "Banglore",
    "merchant_order_id" => "JgvGQKZuu4LY5y",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("checkout/{$checkout}.php");

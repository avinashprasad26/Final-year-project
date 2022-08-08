<?php

require('config.php');
require('connectiondb.php');

session_start();

$ids=$_SESSION['user_name'];

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $ordersid = $_SESSION['razorpay_order_id'];
    $paymentid = $_POST['razorpay_payment_id'];
    $emailid = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $amount = $_SESSION['amount'];
    date_default_timezone_set("Asia/Calcutta");
    $orderdate = date('d-m-y h-i-s');
    $query = "insert into paymentdetails(ordersid, paymentid, emailid, phone, amount, orderdate,username) values('$ordersid','$paymentid','$emailid','$phone','$amount','$orderdate','$ids')";
    if(mysqli_query($conn,$query)){
        header('Location:http://artquarium.in/success.php');
    }
    else{
        echo "Error: " .$sql."".mysqli_error($conn);
    }
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
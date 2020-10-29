<?php
session_start();
if(isset($_POST['submit']))
{
	$first_name = trim(filter_input(INPUT_POST, 'first_name'));
	$last_name = trim(filter_input(INPUT_POST, 'last_name'));
	$email = trim(filter_input(INPUT_POST, 'email'));
	$price = trim(filter_input(INPUT_POST, 'price'));
	$_SESSION['t_price'] = $price;
  $_SESSION['t_email'] = $email;
	// processing the rave payment
$curl = curl_init();

$customer_email = $email;
$amount = $price;  
$currency = "NGN";
$set= '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$set = substr(str_shuffle($set), 0,12);
$txref = "rave-".$set; // ensure you generate unique references per transaction.
$PBFPubKey = "FLWPUBK_TEST-694f9dc1052df9e245d2e19fc038cf08-X"; // get your public key from the dashboard.
$redirect_url = "https://localhost/bet_web/success.php?txref=".$txref."&amount=".$amount."&currency=".$currency;
//$payment_plan = "pass the plan id"; // this is only required for recurring payments.


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'customer_email'=>$customer_email,
    'currency'=>$currency,
    'txref'=>$txref,
    'PBFPubKey'=>$PBFPubKey,
    'redirect_url'=>$redirect_url
    //'payment_plan'=>$payment_plan
  ]),
  CURLOPT_HTTPHEADER => [
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the rave API
  die('Curl returned error: ' . $err);
}

$transaction = json_decode($response);

if(!$transaction->data && !$transaction->data->link){
  // there was an error from the API
  print_r('API returned error: ' . $transaction->message);
}

// uncomment out this line if you want to redirect the user to the payment page
//print_r($transaction->data->message);


// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $transaction->data->link);
}
?>
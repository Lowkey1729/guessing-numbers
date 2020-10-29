<?php session_start(); ?>
<?php include('config.php'); ?>
<?php include('model/customer_db.php');?>
<?php $user = new Users();?>
<?php
    if (isset($_GET['txref'])) 
    {
        $ref = $_GET['txref'];
        $amount = $_GET['amount']; //Correct Amount from Server
        $currency = $_GET['currency']; //Correct Currency from Server
        $email = $_SESSION['t_email'];

        $query = array(
            "SECKEY" => "FLWSECK_TEST-022d99e01fec4770080a96977726c803-X",
            "txref" => $ref
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
        	try
        	{	
        		$email = $_SESSION['email'];
        		$balance = $user->get_user_balance($email);
        		$balance = $balance + $amount;
        		$user->update_balance($balance, $email);
	        	$_SESSION['success'] = " Payment Recieved.";
	        	header('location: bets.php');
        	}
        	catch(PDOException $e)
        	{
        			$_SESSION['bet_error'] = $e->getMessage();
        		   header('location: bets.php');
        	}
        	
      
        } else {
        	$_SESSION['bet_error'] = " Payment not recieved.".$amount." ".$currency." ".$chargeResponsecode;
            header('location: bets.php');
        }
    }
        else {
      die('No reference supplied');
    }
// 

?>
<?php
require 'vendor/autoload.php';
require 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/PHPMailer/src/SMTP.php'; 
require 'vendor/PHPMailer/PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
session_start();
include('config.php');
include('model/fields.php');
include('model/validate.php');
include('model/customer_db.php');
//include('model/bet_functions.php');
// add field  with optional initial message  for the registration page
$validate = new Validate();
$user = new Users();
//$crypt = new Crypt();
$fields = $validate->getFields();
$fields->addField('last_name');
$fields->addField('password');
$fields->addField('first_name');
$fields->addField('mobile');
$fields->addField('v_password');
$fields->addField('email');
$fields->addField('username');
$fields->addField('r_email');
$fields->addField('r_mobile');
$fields->addField('n_password');
$fields->addField('confirm_password');

if(isset($_POST['action']))
{
	$action = $_POST['action'];
}
elseif(isset($_GET['action']))
{
	$action = $_GET['action'];
}
else
{
	$action = 'home';
}

strtolower($action);
switch ($action) 
{
case 'home':
	header("location: home.php");
	break;

case 'logout':
		try
		{
			$user_id = $_SESSION['bet_id'];
			$status = 'OFF';
			global $db;
			$query = " UPDATE user_online SET status =:status,
							       	   last_activity = now()
							       WHERE user_id = :user_id";
			$result = $db->prepare($query);
			$result->bindValue(':status', $status);
			$result->bindValue(':user_id', $user_id);
			$result->execute();
			$result->closeCursor();
			session_destroy();
			header("Location: home.php");

		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] = $e->getMessage();
			header('location: home.php');

		}
		
		break;
case 'sign_in':
		$email = trim(filter_input(INPUT_POST, 'email'));
		$password = trim(filter_input(INPUT_POST, 'password'));
		$_SESSION['email'] = $email;
		// validate the field
		$validate->password('password', $password);
		if($fields->hasErrors())
		{
			$_SESSION['bet_error'] = "Errors in the fields.";
			 if(strlen($password) < 6)
			 {
			 	$_SESSION['bet_error'] = "Password must be at least 6 characters. ";
			 }
			 else
			 {
			 	$_SESSION['bet_error'] = "Password must contain at least one Uppercase letter, lowercase letter,  number and symbol.".$date;
			 }
			header('location: sign_in.php');
		}
		else
		{
			if($user->is_user_login_valid($email, $password)&&($user->get_user_status($email)==Null))
			{
				// check if the activated code was entered before signing in
				try
				{
					
					global $db;
					$query = " SELECT updated_at FROM user WHERE email =:email";
					$result = $db->prepare($query);
					$result->bindValue(':email', $email);
					$result->execute();
					$get = $result->fetch();
					$result->closeCursor();
					$date = $get['updated_at'];
					if($date == NULL)
					{
						$_SESSION['bet_error'] = " Account not yet activated.";
						header('location: activation.php');
					}
					else
					{
						$_SESSION['bet_id'] = $user->get_user_login_id($email);
						$_SESSION['get_username'] = $user->get_username($email);
						$user_id = $_SESSION['bet_id'];
						$status = 'ON';
						try
						{	
							$user_id = $_SESSION['bet_id'];
							$status = 'ON';
							global $db;
							$query1 = " SELECT *, COUNT(*) As row FROM user_online WHERE user_id = :user_id ";
							$result1 = $db->prepare($query1);
							$result1->bindValue(':user_id', $user_id);
							$result1->execute();
							$row = $result1->fetch();
							$result1->closeCursor();
							if($row['row'] >0 )
							{
								$user_id = $_SESSION['bet_id'];
								$status = 'ON';
								global $db;
								$query = " UPDATE user_online SET 
																  status = :status,
																  last_activity = now()
															  WHERE user_id =:user_id ";
								$result = $db->prepare($query);
								$result->bindValue(':user_id', $user_id);
								$result->bindValue(':status', $status);
								$result->execute();
								$result->closeCursor();
								$_SESSION['success'] = " Welcome Back!!!.";
								header('location: home.php');
							}
							else
							{	
								$user_id = $_SESSION['bet_id'];
								$status = 'ON';
								global $db;
								$query = " INSERT INTO user_online (user_id, last_activity, status)
												       VALUES(:user_id, now(), :status)";
								$result = $db->prepare($query);
								$result->bindValue(':status', $status);
								$result->bindValue(':user_id', $user_id);
								$result->execute();
								$result->closeCursor();
								$_SESSION['success'] = " Welcome Back!!!.";
								header('location: home.php');

							}
							
						}
						catch(PDOException $e)
						{
							$_SESSION['bet_error'] = $e->getMessage();
							header('location: sign_in.php');
						}
								
					}

				}
				catch(PDOException $e)
				{
					$_SESSION['bet_error'] = $e->getMessage();
				}
				
			}
			elseif(($user->is_user_login_valid($email, $password))&&($user->get_user_status($email)=="Admin"))
			{	
				// check if the activated code was entered before signing in
				try
				{
					
					global $db;
					$query = " SELECT updated_at FROM user WHERE email =:email";
					$result = $db->prepare($query);
					$result->bindValue(':email', $email);
					$result->execute();
					$get = $result->fetch();
					$result->closeCursor();
					$date = $get['updated_at'];
					if($date == NULL)
					{
						$_SESSION['bet_error'] = " Account not yet activated.";
						header('location: activation.php');
					}
					else
					{
								
						$_SESSION['bet_id'] = $user->get_user_login_id($email);
						$_SESSION['get_username'] = $user->get_username($email);
						$_SESSION['success'] = " Welcome Back!!!.";
						header('location: admin/dashboard.php');
					}

				}
				catch(PDOException $e)
				{
					$_SESSION['bet_error'] = $e->getMessage();
				}
			}
			else
			{
				$_SESSION['bet_error'] = "Invalid Login Credentials.";
				header('location: sign_in.php');
			}

		}

	break;
case 'sign_up':
		$email = trim(filter_input(INPUT_POST, 'email'));
		$first_name = trim(filter_input(INPUT_POST, 'first_name'));
		$last_name = trim(filter_input(INPUT_POST, 'last_name'));
		$mobile = trim(filter_input(INPUT_POST, 'mobile'));
		$username = trim(filter_input(INPUT_POST, 'username'));
		$password =trim(filter_input(INPUT_POST, 'password'));
		$v_password = trim(filter_input(INPUT_POST, 'v_password'));

		$_SESSION['first_name'] = $first_name;
		$_SESSION['last_name'] = $last_name;
		$_SESSION['mobile'] = $mobile;
		$_SESSION['email'] = $email;
		$_SESSION['bet_username'] = $username;

		$validate->text('first_name', $first_name);
		$validate->text('last_name', $last_name);
		$validate->text('username',$username);
		$validate->email('email', $email);
		$validate->phone('mobile', $mobile);
		$validate->password('password', $password);
		$validate->verify('v_password', $password, $v_password);

		if($fields->hasErrors())
		{
			$_SESSION['bet_error'] = " Error In The Field <br>";
			 if($password != $v_password)
			 {
			 	$_SESSION['bet_error'] = " Passwords do not match ";
			 }
			 elseif(strlen($password) < 6)
			 {
			 	$_SESSION['bet_error'] = "Password must be at least 6 characters. ";
			 }
			 else
			 {
			 	$_SESSION['bet_error'] = "Password must contain at least one Uppercase letter, lowercase, number and symbol.";
			 }

			header('location: sign_up.php');
			
		}
		else
		{
			// if(!isset($_SESSION['captcha']))
			// {
			// 	require('recaptcha/src/autoload.php');
			// 	$recaptcha = new \ReCaptcha\ReCaptcha('6LevO1IUAAAAAFCCiOHERRXjh3VrHa5oywciMKcw',
			// 				 new \ReCaptcha\RequestMethod\SocketPost());
			// 	$response = $recaptcha->verify_recaptcha($_POST['g-recaptcha-response'],
			// 											 $_SERVER['REMOTE_ADDR']);
			// 	if(!$response->isSuccess())
			// 	{
			// 		$_SESSION['captcha_err'] = 'Please answer recaptcha correctly';
			// 		header('Location: sign_up.php');
			// 		exit();
			// 	}
			// 	else
			// 	{
			// 		$_SESSION['captcha'] = time() + (10*60);
			// 	}
			// }
			if($user->is_user_email_valid($email) === false)
			{
				$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code = substr(str_shuffle($set), 0,5);
				$_SESSION['code'] = $code;
				$user_id = $user->add_user($email, $first_name, $last_name, $mobile, $code, $password,$username);
				$_SESSION['user_id'] = $user_id;
				// store user data in session.

				$message = " <h2> Thank you for registering.</h2>
							 <p> Your Account </p>
							 <p> Email: ".$email ." </p>
							 <p> Password: ".$_POST['password']." </p>
							 <h1> Activating code: ".$code."</h1>
							 <p> Please click the link below to activate your account .</p>
							 <a href='http://localhost/bet_web/activation.php?code=". $code. "&user=". $user_id."'> Activate Account </a> 

				";

				// load phpmailer
				require('vendor/autoload.php');
				$mail = new PHPMAILER(true);
				try
				{
					// server settings
					$mail->isSMTP();
					$mail->Host = 'smtp.mailtrap.io';
					$mail->SMTPAuth = true;
					$mail->Username = 'c0aa6ba41994c4';
					$mail->Password = '6c9308bc35807c';
					$mail->SMTPSecure = 'tls';                           
				    $mail->Port = 2525;                                   

				    $mail->setFrom('bc0ad754f1-3d88a4@inbox.mailtrap.io', 'Guess~Right');
				        
				        //Recipients
				    $mail->addAddress($email);              
				    $mail->addReplyTo($email, 'Guess~Right');
				       
				        //Content
				    $mail->isHTML(true);                                  
				    $mail->Subject = 'Guess~Right Site Sign Up';
				    $mail->Body    = $message;

				    $mail->send();
				    $_SESSION['success'] = "Activating code sent to your email account";
				    header('Location: activation.php');

					$_SESSION['bet_user'] = $user->get_user_by_id($user_id);
					$_SESSION['get_username'] = $user->get_username($email);

				}
				 catch (Exception $e) {
				        $_SESSION['bet_error'] = 'Message could not be sent. Mailer Error:<br> '.$mail->ErrorInfo;
				        header('location: sign_up.php');
				      
				        
				    }

				
			}

			else
			{
				$_SESSION['bet_error'] = " Email already in use.";
			
			}
		}
	break;

case 'reset':
			$r_mobile = trim(filter_input(INPUT_POST, 'r_mobile'));
			$r_email = trim(filter_input(INPUT_POST, 'r_email'));
			global $db;
			$query = " SELECT id FROM user WHERE email = :r_email AND mobile = :r_mobile ";
			$result = $db->prepare($query);
			$result->bindValue(':r_email', $r_email);
			$result->bindValue(':r_mobile', $r_mobile );
			$result->execute();
			$valid = ($result->rowCount() == 1);
			$id = $result->fetch();
			$_SESSION['user_id'] = $id['id'];
			$id = $_SESSION['user_id'];
			$_SESSION['email'] = $r_email;
			$_SESSION['mobile'] = $r_mobile;
			$result->closeCursor();
			if($valid > 0)
			{
				// generate code to send to the guest's email...
				$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code = substr(str_shuffle($set), 0,5);
				try
				{
					global $db;
					$query = " UPDATE user SET activate_code = :code WHERE email =:r_email";
					$result = $db->prepare($query);
					$result->bindValue(':r_email', $r_email);
					$result->bindValue(':code', $code);
					$result->execute();
					$result->closeCursor();
				}
				catch(PDOException $e)
				{
					$_SESSION['bet_error'] = $e->getMessage();
					header('location: sign_in.php');
				}
				$_SESSION['code'] = $code;
				$message = "
							<h2> Password Reset </h2>
							<p> Your Account </p>
							<p> Email: ". $r_email. "</p>
							<p> Please Click the link below to reset your password.</p>
							<h1>".$code."</h1>  
							<a href='http://localhost/bet_web/reset_password.php?code=".$code."&user=".$id.'> Reset Password </a>
					"';

					// load phpmailer
					require('vendor/autoload.php');

					$mail = new PHPMailer(true);
				try{
					// server settings 
					$mail->isSMTP();
					$mail->Host = 'smtp.mailtrap.io';
					$mail->SMTPAuth = true;
					$mail->Username = 'c0aa6ba41994c4';
					$mail->Password = '6c9308bc35807c';
					$mail->SMTPSecure = 'tsl';
					$mail->Port = 2525;

					$mail->setFrom('bc0ad754f1-3d88a4@inbox.mailtrap.io', 'Guess~Right');

					// Recipients
					$mail->addAddress($r_email);
					$mail->addReplyTo($r_email, 'Guess~Right');

					//content 
					$mail->isHTML(true);
					$mail->Subject = 'Guess~Right Site Password Reset';
					$mail->Body = $message;

					$mail->send();
					$_SESSION['success'] = ' Password reset link sent';
					header('location: activation_r.php');


				}
				catch(Exception $e)
				{
					$_SESSION['bet_error'] = 'Message could not be sent . Mail Error: '. $mail->ErrorInfo;
					header('location: forgotten_password.php');
							
				}
			}
			else
			{
				$_SESSION['bet_error'] = " Invalid Details. Please Try Again.";
				header('location: forgotten_password.php');
				
			}
			 break;

case 'password_reset':
			$password = trim(filter_input(INPUT_POST, 'n_password'));
			$v_password = trim(filter_input(INPUT_POST, 'confirm_password'));
			$email = $_SESSION['email'];
			$mobile = $_SESSION['mobile'];
			// verify passwords
			$validate->password('n_password', $password);
			//$validate->verify('confirm_password', $n_password, $confirm_password);
		
				
				// $_SESSION['bet_error'] = " Error In The Field <br>";
				// header('location: reset_password.php');
				 if($password != $v_password)
				 {
				 	$_SESSION['bet_error'] = " Passwords do not match ";
				 	header('location: reset_password.php');
				 	exit(0);
				 }
				 elseif(strlen($password) < 6)
				 {
				 	$_SESSION['bet_error'] = "Password must be at least 6 characters. ";
				 	header('location: reset_password.php');
				 	exit(0);
				 }
				 elseif($fields->hasErrors())
				 {
				 	$_SESSION['bet_error'] = "Password must contain at least one Uppercase letter, lowercase, number and symbol.";
				 	header('location: reset_password.php');
				 	exit(0);
				 }
					
			
			
			
				global $db;
				$query = " SELECT *, COUNT(*) AS numrows FROM user WHERE email = :email";
				$result = $db->prepare($query);
				$result->bindValue(':email', $email);
				$result->execute();
				$row = $result->fetch();
				$result->closeCursor();
				if($row['numrows'] > 0)
				{
				$code = $_SESSION['code'];
					$pass = password_hash($password, PASSWORD_DEFAULT);
				try{
					global $db;
					$query = "UPDATE user 
						  	  SET password = :pass,
						  	  	  activate_code = :code, 
						  	  	  updated_at = now()
						  	   WHERE email = :email AND mobile = :mobile";
					$result = $db->prepare($query);
					$result->bindValue(':email', $email);
					$result->bindValue(':mobile', $mobile);
					$result->bindValue(':pass', $pass);
					$result->bindValue(':code', $code);
					$valid = $result->execute();
					if($valid)
					{
						$_SESSION['success'] = " ***Sign In***.";
						header("Location: sign_in.php");
					}	
					else
					{
						$_SESSION['bet_error'] = " Unable to update password.";
						header('location: forgotten_password.php');
					}
							
					}
					catch(PDOException $e)
					{
						$_SESSION['bet_error'] = $e->getMessage();
						header('location: reset_password.php');
					}	
			}
				
			
			 
			break;
case 'activate_code':
	$code = trim(filter_input(INPUT_POST, 'activate_code'));
	global $db;
	$query = " SELECT *, COUNT(*) As numrows FROM user WHERE activate_code = :code ";
	$result = $db->prepare($query);
	$result->bindValue(':code', $code);
	$result->execute();
	$row = $result->fetch();
	$result->closeCursor();

	$query1 =  " UPDATE user SET updated_at = now() WHERE activate_code = :code";
	$result1 = $db->prepare($query1);
	$result1->bindValue(':code', $code);
	$result1->execute();
	$result1->closeCursor();

	if($row['numrows']>0)
	{
		$_SESSION['success'] = " ***Account Activated***";
		header('location: bets.php');
	}
	else
	{
		$_SESSION['bet_error'] = " Account unable to activate.Kindly input the correct code.";
		header('location: activation.php');
	}
	break;


case 'activate_code_r':
	$code = trim(filter_input(INPUT_POST, 'activate_code'));
	global $db;
	$query = " SELECT *, COUNT(*) As numrows FROM user WHERE activate_code = :code ";
	$result = $db->prepare($query);
	$result->bindValue(':code', $code);
	$result->execute();
	$row = $result->fetch();
	$result->closeCursor();
	if($row['numrows']>0)
	{
		$_SESSION['success'] = " ***Account Activated***";
		header('location: reset_password.php');
	}
	else
	{
		$_SESSION['bet_error'] = " Account unable to activate.Kindly input the correct code.";
		header('location: activation.php');
	}
	break;

	// for one hundred naira
case 'bet_hundred':
		$_SESSION['price'] = 100;
		$email = $_SESSION['email'];
		$set = '12345678918908120895642345';
		$_SESSION['to_guess'] = substr(str_shuffle($set), 0,6);
		$balance = $user->get_user_balance($email);
		$_SESSION['chances'] = 5;
	
		if(isset($_SESSION['get_username']) && $balance >=100)
		{

			// add the value of the price and the user id to the database
			try
			{
				$user_id = $_SESSION['bet_id'];
				$price = $_SESSION['price'];
				global $db;
				$query = "INSERT INTO bets (user_id, price) VALUES (:user_id, :price)";
				$result = $db->prepare($query);
				$result->bindValue(':user_id', $user_id);
				$result->bindValue(':price', $price);
				$result->execute();
				$result->closeCursor();
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}
			$balance = $balance-100;
			$user->update_balance($balance, $email);
			header('location: game.php');
		}
		elseif(!isset($_SESSION['get_username']))
		{
			$_SESSION['bet_error'] = "Oops!!!. You need to sign in.";
			header('location: sign_in.php');
			
		}
		elseif($balance<100)
		{
			$_SESSION['bet_error'] = " Ooops!!!. Insufficient balance to place stake.";
			header('location: bets.php');
		}
		
	break;
	// two hundred naira bet
case 'bet_t_hundred':
		$_SESSION['price'] = 200;
		$email = $_SESSION['email'];
		$set = '12345678918908120895642345';
		$_SESSION['to_guess'] = substr(str_shuffle($set), 0,5);
		$balance = $user->get_user_balance($email);
		$_SESSION['chances'] = 6;
		if(isset($_SESSION['get_username'])&& $balance >=200)
		{
			// add the value of the price and the user id to the database
			try
			{
				$user_id = $_SESSION['bet_id'];
				$price = $_SESSION['price'];
				global $db;
				$query = "INSERT INTO bets (user_id, price) VALUES (:user_id, :price)";
				$result = $db->prepare($query);
				$result->bindValue(':user_id', $user_id);
				$result->bindValue(':price', $price);
				$result->execute();
				$result->closeCursor();
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}
			$balance = $balance-200;
			$user->update_balance($balance, $email);
			header('location: game.php');
		}
		elseif(!isset($_SESSION['get_username']))
		{
			$_SESSION['bet_error'] = "Oops!!!. You need to sign in.";
			header('location: sign_in.php');
		}
		elseif($balance < 200)
		{
			$_SESSION['bet_error'] = " Ooops!!!. Insufficient balance to place stake.";
			header('location: bets.php');
		}
	
	break;

	// five hundred naira bet
case 'bet_f_hundred':
		$_SESSION['price'] = 500;
	 	$email = $_SESSION['email'];
	 	$set = '12345678918908120895642345';
		$_SESSION['to_guess'] = substr(str_shuffle($set), 0,3);
		$balance = $user->get_user_balance($email);
	 	$_SESSION['chances'] = 2;
	 	if(isset($_SESSION['get_username'])&& $balance >=500)
		{
			// add the value of the price and the user id to the database
			try
			{
				$user_id = $_SESSION['bet_id'];
				$price = $_SESSION['price'];
				global $db;
				$query = "INSERT INTO bets (user_id, price) VALUES (:user_id, :price)";
				$result = $db->prepare($query);
				$result->bindValue(':user_id', $user_id);
				$result->bindValue(':price', $price);
				$result->execute();
				$result->closeCursor();
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}
			$balance = $balance-500;
			$user->update_balance($balance, $email);
			header('location: game.php');
		}
		elseif(!isset($_SESSION['get_username']))
		{
			$_SESSION['bet_error'] = "Oops!!!. You need to sign in.";
			header('location: sign_in.php');
		}
		elseif($balance < 500)
		{
			$_SESSION['bet_error'] = " Ooops!!!. Insufficient balance to place stake.";
			header('location: bets.php');
		}
	break;

	// for one thousand naira bet

case 'bet_thousand':
		$_SESSION['price'] = 1000;
		$email = $_SESSION['email'];
		$set = '12345678918908120895642345';
		$_SESSION['to_guess'] = substr(str_shuffle($set), 0,3);
		$balance = $user->get_user_balance($email);
		$_SESSION['chances'] = 4;
		if(isset($_SESSION['get_username'])&& $balance >=1000)
		{
			// add the value of the price and the user id to the database
			try
			{
				$user_id = $_SESSION['bet_id'];
				$price = $_SESSION['price'];
				global $db;
				$query = "INSERT INTO bets (user_id, price) VALUES (:user_id, :price)";
				$result = $db->prepare($query);
				$result->bindValue(':user_id', $user_id);
				$result->bindValue(':price', $price);
				$result->execute();
				$result->closeCursor();
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}
			$balance = $balance-1000;
			$user->update_balance($balance, $email);
			header('location: game.php');
		}
		elseif(!isset($_SESSION['get_username']))
		{
			$_SESSION['bet_error'] = "Ooops!!!. You need to sign in.";
			header('location: sign_in.php');	
		}
		elseif($balance < 1000)
		{
			$_SESSION['bet_error'] = " Ooops!!!. Insufficient balance to place stake.";
			header('location: bets.php');
			
		}
	break;

	case 'bet_jackpot':
	 	$email = $_SESSION['email'];
	 	$set = '12345678918908120895642345';
		$_SESSION['to_guess'] = substr(str_shuffle($set), 0,10);
	 	$_SESSION['chances'] = 2;
	 	if(isset($_SESSION['get_username']))
		{
		
			header('location: game.php');
		}
		elseif(!isset($_SESSION['get_username']))
		{
			$_SESSION['bet_error'] = "Oops!!!. You need to sign in.";
			header('location: sign_in.php');
		}
		elseif($balance < 500)
		{
			$_SESSION['bet_error'] = " Ooops!!!. Insufficient balance to place stake.";
			header('location: bets.php');
		}
	break;

case 'update_user':
	$first_name = trim(filter_input(INPUT_POST, 'first_name'));
	$last_name = trim(filter_input(INPUT_POST, 'last_name'));
	$email = $_SESSION['email'];
	$mobile = trim(filter_input(INPUT_POST, 'mobile'));
	$username = trim(filter_input(INPUT_POST, 'username'));
	$_SESSION['us'] = $mobile;
	if($fields->hasErrors())
	{
		$_SESSION['bet_error'] = " Error in the fields.";
	}
	else
	{
		try
		{
			
			$user->update_user( $username, $email, $first_name, $last_name,$mobile);
			$_SESSION['success'] = " Profile updated successfully.";
			header('location: profile.php');
		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] = $e->getMessage();
			header('location: profile.php');
		}
	}
	break;

	// game section for hundred naira
case 'guess_result_hundred':
	$input_1 = trim(filter_input(INPUT_POST, 'input_1'));
	$input_2 = trim(filter_input(INPUT_POST, 'input_2'));
	$input_3 = trim(filter_input(INPUT_POST, 'input_3'));
	$input_4 = trim(filter_input(INPUT_POST, 'input_4'));
	$input_5 = trim(filter_input(INPUT_POST, 'input_5'));
	$input_6 = trim(filter_input(INPUT_POST, 'input_6'));
	$guess = trim(filter_input(INPUT_POST, 'shuffle'));

	$input_1 = $input_1*100000;
	$input_2 = $input_2*10000;
	$input_3 = $input_3*1000;
	$input_4 = $input_4*100;
	$input_5 = $input_5*10;
	$input_6 = $input_6*1;

	$result =  $input_1 + $input_2 + $input_3 + $input_4 + $input_5 + $input_6;  
	if($result == $guess)
	{
		$id = $_SESSION['bet_id'];
		$price = $_SESSION['price'];
		$_SESSION['success'] = "Congratulations!!!  You made the right guess!!!";
		unset($_SESSION['chances']);
		global $db;
		$query = " INSERT INTO userwins  (user_id, WinDate, price, won_credits) VALUES (:id, now(), :price, 5000) ";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->bindValue(':price', $price);
		$result->execute();
		$result->closeCursor();
		header('location: bets.php');		
	}
	else
	{		$chances = $_SESSION['chances'];
			$chances = $chances-1;
			$_SESSION['chances'] = $chances;
		
			if($chances <= 5 && $chances >0  )
			{
				$_SESSION['bet_error'] = " You need to try again.<hr> You have <b> ".$chances."</b> more chances";
				//$chances = $crypt->encrypt($chances);
				header("Location: game.php?chances=$chances");	
			}
			elseif($chances ==0)
			{
				$_SESSION['bet_error'] = "You've used up your chances.";
				$_SESSION['win_num'] = $_SESSION['to_guess'];	
				header('location: bets.php');
			}
	}

	break;

			// guess game for two hundred naira
	case 'guess_result_t_hundred':
	$input_1 = trim(filter_input(INPUT_POST, 'input_1'));
	$input_2 = trim(filter_input(INPUT_POST, 'input_2'));
	$input_3 = trim(filter_input(INPUT_POST, 'input_3'));
	$input_4 = trim(filter_input(INPUT_POST, 'input_4'));
	$guess = trim(filter_input(INPUT_POST, 'shuffle'));
	$input_5 = trim(filter_input(INPUT_POST, 'input_5'));

	$input_1 = $input_1*10000;
	$input_2 = $input_2*1000;
	$input_3 = $input_3*100;
	$input_4 = $input_4*10;
	$input_5 = $input_5*1;

	$result =  $input_1 + $input_2 + $input_3 + $input_4 + $input_5;  
	if($result == $guess)
	{
		$id = $_SESSION['bet_id'];
		$price = $_SESSION['price'];
		$_SESSION['success'] = "Congratulations!!!  You made the right guess!!!";
		unset($_SESSION['chances']);
		global $db;
		$query = " INSERT INTO userwins  (user_id, WinDate, price, won_credits) VALUES (:id, now(), :price, 10000) ";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->bindValue(':price', $price);
		$result->execute();
		$result->closeCursor();
		header('location: bets.php');		
	}
	else
	{		$chances = $_SESSION['chances'];
			$chances = $chances-1;
			$_SESSION['chances'] = $chances;
		
			if($chances <= 5 && $chances >0  )
			{
				$_SESSION['bet_error'] = " You need to try again.<hr> You have <b>".$chances."</b> more chances";
				//$chances = $crypt->encrypt($chances);
				header("Location: game.php?chances=$chances");	
			}
			elseif($chances ==0)
			{
				$_SESSION['bet_error'] = "You've used up your chances.";
				$_SESSION['win_num'] = $_SESSION['to_guess'];	
				header('location: bets.php');
			}
		
		
		
	
	}	


	break;

	//  guess game for five hundred naira
case 'guess_result_f_hundred':
	$input_1 = trim(filter_input(INPUT_POST, 'input_1'));
	$input_2 = trim(filter_input(INPUT_POST, 'input_2'));
	$input_3 = trim(filter_input(INPUT_POST, 'input_3'));
	$guess = trim(filter_input(INPUT_POST, 'shuffle'));
	$input_1 = $input_1*100;
	$input_2 = $input_2*10;
	$input_3 = $input_3*1;
	

	$result =  $input_1 + $input_2 + $input_3 ;  
	if($result == $guess)
	{
		$id = $_SESSION['bet_id'];
		$price = $_SESSION['price'];
		$_SESSION['success'] = "Congratulations!!!  You made the right guess!!!";
		unset($_SESSION['chances']);
		global $db;
		$query = " INSERT INTO userwins  (user_id, WinDate, price, won_credits) VALUES (:id, now(), :price, 30000) ";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->bindValue(':price', $price);
		$result->execute();
		$result->closeCursor();
		header('location: bets.php');		
	}
	else
	{		$chances = $_SESSION['chances'];
			$chances = $chances-1;
			$_SESSION['chances'] = $chances;
		
			if($chances <= 5 && $chances >0  )
			{
				$_SESSION['bet_error'] = " You need to try again.<hr> You have ".$chances." more chances";
				//$chances = $crypt->encrypt($chances);
				header("Location: game.php?chances=$chances");	
			}
			elseif($chances ==0)
			{
				$_SESSION['bet_error'] = "You've used up your chances.";
				$_SESSION['win_num'] = $_SESSION['to_guess'];	
				header('location: bets.php');
			}
		
		
		
	
	}	

	break;

	// game thousand
case 'guess_result_thousand':
	$input_1 = trim(filter_input(INPUT_POST, 'input_1'));
	$input_2 = trim(filter_input(INPUT_POST, 'input_2'));
	$input_3 = trim(filter_input(INPUT_POST, 'input_3'));
	$guess = trim(filter_input(INPUT_POST, 'shuffle'));

	$input_1 = $input_1*100;
	$input_2 = $input_2*10;
	$input_3 = $input_3*1;
	

	$result =  $input_1 + $input_2 + $input_3 ;  
	if($result == $guess)
	{
		$id = $_SESSION['bet_id'];
		$price = $_SESSION['price'];
		$_SESSION['success'] = "Congratulations!!! You made the right guess!!!";
		unset($_SESSION['chances']);
		global $db;
		$query = " INSERT INTO userwins  (user_id, WinDate, price, won_credits) VALUES (:id, now(), :price, 60000) ";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->bindValue(':price', $price);
		$result->execute();
		$result->closeCursor();
		header('location: bets.php');		
	}
	else
	{		$chances = $_SESSION['chances'];
			$chances = $chances-1;
			$_SESSION['chances'] = $chances;
		
			if($chances <= 5 && $chances >0  )
			{
				$_SESSION['bet_error'] = " You need to try again.<hr> You have ".$chances." more chances";
				//$chances = $crypt->encrypt($chances);
				header("Location: game.php?chances=$chances");	
			}
			elseif($chances ==0)
			{
				$_SESSION['bet_error'] = "You've used up your chances.";
				$_SESSION['win_num'] = $_SESSION['to_guess'];	
				header('location: bets.php');
			}
		
		
		
	
	}	
	break;

		// game section for hundred naira
case 'guess_result_jackpot':
	$input_1 = trim(filter_input(INPUT_POST, 'input_1'));
	$input_2 = trim(filter_input(INPUT_POST, 'input_2'));
	$input_3 = trim(filter_input(INPUT_POST, 'input_3'));
	$input_4 = trim(filter_input(INPUT_POST, 'input_4'));
	$input_5 = trim(filter_input(INPUT_POST, 'input_5'));
	$input_6 = trim(filter_input(INPUT_POST, 'input_6'));
	$input_6 = trim(filter_input(INPUT_POST, 'input_7'));
	$input_6 = trim(filter_input(INPUT_POST, 'input_8'));
	$input_6 = trim(filter_input(INPUT_POST, 'input_9'));
	$input_6 = trim(filter_input(INPUT_POST, 'input_10'));
	$guess = trim(filter_input(INPUT_POST, 'shuffle'));

	$input_1 = $input_1*1000000000;
	$input_2 = $input_2*100000000;
	$input_3 = $input_3*10000000;
	$input_4 = $input_4*1000000;
	$input_5 = $input_5*100000;
	$input_6 = $input_6*10000;
	$input_7 = $input_7*1000;
	$input_8 = $input_8*100;
	$input_9 = $input_9*10;
	$input_10 = $input_10*1;

	$result =  $input_1 + $input_2 + $input_3 + $input_4 + $input_5 + $input_6 + $input_7 + $input_8 + $input_9 + $input_10;  
	if($result == $guess)
	{
		$id = $_SESSION['bet_id'];
		$price = $_SESSION['price'];
		$_SESSION['success'] = "Congratulations!!!  You made the right guess!!!";
		unset($_SESSION['chances']);
		global $db;
		$query = " INSERT INTO userwins  (user_id, WinDate, price, won_credits) VALUES (:id, now(), :price, 5000) ";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->bindValue(':price', $price);
		$result->execute();
		$result->closeCursor();
		header('location: bets.php');		
	}
	else
	{		$chances = $_SESSION['chances'];
			$chances = $chances-1;
			$_SESSION['chances'] = $chances;
		
			if($chances <= 5 && $chances >0  )
			{
				$_SESSION['bet_error'] = " You need to try again.<hr> You have <b> ".$chances."</b> more chances";
				//$chances = $crypt->encrypt($chances);
				header("Location: game.php?chances=$chances");	
			}
			elseif($chances ==0)
			{
				$_SESSION['bet_error'] = "You've used up your chances.";
				$_SESSION['win_num'] = $_SESSION['to_guess'];	
				header('location: bets.php');
			}
	}

	break;

	case 'send_message':
			$name = trim(filter_input(INPUT_POST, 'name'));
			$email = trim(filter_input(INPUT_POST, 'email'));
			$username = trim(filter_input(INPUT_POST, 'username'));
			$text = trim(filter_input(INPUT_POST, 'message'));
			//  validate field
			$validate->email('email',$email);
			if($fields->hasErrors())
			{
				$_SESSION['bet_error'] = " Invalid Email Address.";
				header('location: contact.php');
				
			}
			else
			{

					try
					{
						$user->save_message($email, $text,$name, $username);
						$_SESSION['success'] = " Message Sent successfully.";
						header('location: contact.php');
						
					}
					catch(PDOException $e)
					{
						$_SESSION['bet_error'] = $e->getMessage();
						header('location: contact.php');
						
					}
			}


		break;

	case 'update_time':
		try
		{
			$user_id = $_SESSION['bet_id'];
			$status = 'ON';
			global $db;
			$query = " UPDATE user_online SET 
									   status = :status,
							       	   last_activity = now()
							       WHERE user_id = :user_id";
			$result = $db->prepare($query);
			$result->bindValue(':user_id', $user_id);
			$result->bindValue(':status', $status);
			$result->execute();
			$result->closeCursor();
			header("home.php");

		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] = $e->getMessage();
			header('location: sign_in.php');

		}
		break;
}


















?>
<?php
session_start();
include('../config.php');
include('../model/customer_db.php');
include('../model/fields.php');
include('../model/validate.php');
$user = new Users();
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('old_password');
$fields->addField('confirm_password');
$fields->addField('new_password');
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
switch ($action) {
	case 'logout':
		try
		{
			$user_id = $_SESSION['bet_id'];
			$status = 'OFF';
			global $db;
			$query = " UPDATE user SET online =:status,
							       	   last_activity = now()
							       WHERE id = :user_id";
			$result = $db->prepare($query);
			$result->bindValue(':user_id', $user_id);
			$result->bindValue(':status', $status);
			$result->execute();
			$result->closeCursor();
			session_destroy();
			header("Location: ../home.php");

		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] = $e->getMessage();

		}
		break;


	case 'staker_delete':
		try
		{
			$id = trim(filter_input(INPUT_POST, 'id'));
			$user->delete_staker($id);
			$_SESSION['success'] = " Staker Deleted Successfully.";
			header('location: last_seven_days_stakers.php');
		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] = $e->getMessage();
			header('location: last_seven_days_stakers.php');
		}
		break;

	case 's_staker_delete':
		try
		{
			$id = trim(filter_input(INPUT_POST, 'id'));
			$user->delete_staker($id);
			$_SESSION['success'] = " Staker Deleted Successfully.";
			header('location: today_stakers.php');
		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] = $e->getMessage();
			header('location: today_stakers.php');
		}
		break;

	case 'user_delete':
		try
		{
			$id = trim(filter_input(INPUT_POST, 'id'));
			$user->delete_user($id);
			$_SESSION['success'] = " User Deleted Successfully.";
			header('location: manage_users.php');	
		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] = $e->getMessage();
			header('location: manage_users.php');
		}
		
		break;

	case 'm_user_delete':
		try
		{
			$id = trim(filter_input(INPUT_POST, 'id'));
			$user->delete_user($id);
			$_SESSION['success'] = " User Deleted Successfully.";
			header('location: users.php');
		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] = $e->getMessage();
			header('location: users.php');
		}
		break;

	case 'change_password':
		$old_pass = trim(filter_input(INPUT_POST, 'old_password'));
		$new_pass = trim(filter_input(INPUT_POST, 'new_password'));
		$confirm_pass = trim(filter_input(INPUT_POST, 'confirm_password'));
		$validate->password('new_password', $new_pass);
		// check if the password is same as the one used to register
		try
		{
			$email = $_SESSION['email'];
			global $db;
			$query = "SELECT password FROM user WHERE email = :email ";
			$result = $db->prepare($query);
			$result->bindValue(':email', $email);
			$result->execute();
			$row = $result->fetch();
			$result->closeCursor();
			$hash = $row['password'];
			$verify = password_verify($old_pass, $hash);

			if($verify == true)
			{
				if($new_pass != $confirm_pass)
				 {
				 	$_SESSION['bet_error'] = " Passwords do not match ";
				 	header('location: change_password.php');
				 	exit(0);
				 }
				 elseif(strlen($new_pass) < 6)
				 {
				 	$_SESSION['bet_error'] = "Password must be at least 6 characters. ";
				 	header('location: change_password.php');
				 	exit(0);
				 }
				 elseif($fields->hasErrors())
				 {
				 	$_SESSION['bet_error'] = "Password must contain at least one Uppercase letter, lowercase, number and any symbol.";
				 	header('location: change_password.php');
				 	exit(0);
				 }

				 try{
				 		$password = password_hash($new_pass, PASSWORD_DEFAULT);
						global $db;
						$query = "UPDATE user 
							  	  SET password = :pass,
							  	  	  updated_at = now()
							  	   WHERE email = :email";
						$result = $db->prepare($query);
						$result->bindValue(':email', $email);
						$result->bindValue(':pass', $password);
						$valid = $result->execute();
						if($valid)
						{
							$_SESSION['success'] = " ***Password Changed Successfully.***.";
							header("Location: change_password.php");
						}	
						else
						{
							$_SESSION['bet_error'] = " Unable to change password.";
							header('location: change_password.php');
						}
								
					}
						catch(PDOException $e)
						{
							$_SESSION['bet_error'] = $e->getMessage();
							header('location: change_password.php');
						}
					}
					else
					{
						$_SESSION['bet_error'] = " Incorrect Password.";
						header('location: change_password.php');
					}
		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] = $e->getMessage();
			header('location: change_password.php');
		}
				
		break;

	case 'message_delete':
		$id = trim(filter_input(INPUT_POST, 'id'));
		try
		{
			global $db;
			$query = " DELETE FROM sites WHERE id =:id";
			$result = $db->prepare($query);
			$result->bindValue(':id', $id);
			$result->execute();
			$result->closeCursor();
			$_SESSION['success'] = " Message Deleted Successfully.";
			header('location: messages.php');
		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] =$e->getMessage();
			header('location: messages.php');
		}
		break;

	case 'create_post':
		$text = trim(filter_input(INPUT_POST, 'text'));
		try
		{
			global $db;
			$query = " INSERT INTO notices (notice, created_at) VALUES(:body, now()  )";
			$result = $db->prepare($query);
			$result->bindValue(':body', $text);
			$result->execute();
			$result->closeCursor();
			$_SESSION['success'] = " Message  Sent Successfully.";
			header('location: create_posts.php');
		}
		catch(PDOException $e)
		{
			$_SESSION['bet_error'] = $e->getMessage();
			header('location: create_posts.php');
		}
		break;

}
?>	
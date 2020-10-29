<?php
class Users
{
	public function add_user($email, $first_name, $last_name, $mobile, $activate_code, $password,$username)
	{
		global $db;
		$password = password_hash($password, PASSWORD_DEFAULT);
		$query = ' INSERT INTO user ( firstname, lastname, email, password, username, mobile, activate_code, created_at)
				   VALUES (:first_name , :last_name, :email, :password,:username, :mobile, :activate_code, now())';
	    $result = $db->prepare($query);
	    $result->bindParam(':first_name', $first_name);  
	    $result->bindParam(':last_name', $last_name);
	    $result->bindParam(':email', $email);
	    $result->bindParam(':activate_code', $activate_code);
	    $result->bindParam(':password', $password);
	    $result->bindParam(':mobile', $mobile);
	    $result->bindParam(':username', $username);
	    $result->execute();
	    $admin_id = $db->lastInsertId();  
	    $result->closeCursor();
	    return $admin_id;
	}

	public function update_user( $username, $email, $first_name, $last_name,$mobile)
	{
		global $db;
		$query = ' UPDATE user SET 
				   username = :username,
				   firstname = :first_name,
				   lastname = :last_name,
				   updated_at = now()
				   WHERE email = :email';
		$result = $db->prepare($query);
		$result->bindValue(':email', $email);
		$result->bindValue(':first_name', $first_name);
		$result->bindValue(':last_name', $last_name);
		$result->bindValue(':username', $username);
		//$result->bindValue(':mobile', $mobile);
		$result->execute();
		$result->closeCursor();
	}

	public function delete_user($user_id)
	{
		global $db;
		$query = ' DELETE FROM user WHERE id = :user_id';
		$result = $db->prepare($query);
		$result->bindValue(':user_id', $user_id);
		$result->execute();
		$result->closeCursor();
	}

	public function delete_staker($id)
	{
		global $db;
		$query = ' DELETE FROM bets WHERE user_id = :id';
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->execute();
		$result->closeCursor();
	}

	public function is_user_email_valid($email)
	{
		global $db;
		$query = ' SELECT id FROM user
				   WHERE email = :email';
		$result = $db->prepare($query);
		$result->bindValue(':email', $email);
		$result->execute();
		$valid = ($result->rowCount() == 1);
		$result->closeCursor();
		return $valid;
	}

	public function get_user_email($email)
	{

		global $db;
		$query = " SELECT * FROM user
				   WHERE email = :email";
		$result = $db->prepare($query);
		$result->bindValue(':email', $email);
		$result->execute();
		$admin = $result->fetch();
		$result->closeCursor();
		return $admin;	
	}

	public function get_user_by_id($user_id)
	{

		global $db;
		$query = " SELECT * FROM user
				   WHERE id = :user_id";
		$result = $db->prepare($query);
		$result->bindValue(':user_id', $user_id);
		$result->execute();
		$admin = $result->fetch();
		$result->closeCursor();
		return $admin;
	}

	public function get_all_users()
	{
		global $db;
		$query = " SELECT * FROM users
			       WHERE id = :user_id";
		$result = $db->prepare($query);
		$result->execute();
		$admins = $result->fetchAll();
		$result->closeCursor();
		return $admins;
	}

	public function is_user_login_valid($email, $password)
	{
		global $db;
		$query = " SELECT password FROM user
				   WHERE email = :email";
		$result = $db->prepare($query); 
		$result->bindValue(':email', $email);
		$result->execute();
		$row = $result->fetch();
		$result->closeCursor();
		$hash = $row['password'];
		return password_verify($password, $hash);
	}

	public function get_user_status($email)
	{
		global $db;
		$query = " SELECT status FROM user
				   WHERE email = :email ";
		$result = $db->prepare($query);
		$result->bindValue(':email', $email);
		$result->execute();
		$role = $result->fetch();
		$result->closeCursor();
		return $role['status'];
	}

	public function get_user_balance($email)
	{
		global $db;
		$query = " SELECT balance FROM user WHERE email =:email";
		$result = $db->prepare($query);
		$result->bindValue(':email', $email);
		$result->execute();
		$balance = $result->fetch();
		$result->closeCursor();
		return $balance['balance'];
	}

	public function update_balance($balance,$email)
	{
		global $db;
		$query = " UPDATE user
						 SET balance = :balance,
						 	 updated_at = now()
						 WHERE email = :email";
		$result = $db->prepare($query);
		$result->bindValue(':email', $email);
		$result->bindValue(':balance', $balance);
		$result->execute();
		$result->closeCursor();
	}

	public function get_user_image($username)
	{
		global $db;
		$query = " SELECT image FROM user WHERE username = :username";
		$result = $db->prepare($query);
		$result->bindParam(':username', $username);
		$result->execute();
		$image = $result->fetch();
		$result->closeCursor();
		return $image['image'];
	}

	public function get_username($email)
	{
		global $db;
		$query = " SELECT * FROM user
				   WHERE email = :email ";
		$result = $db->prepare($query);
		$result->bindValue(':email', $email);
		$result->execute();
		$username = $result->fetch();
		$result->closeCursor();
		return $username['username'];
	}
	public function get_user_login_id($email)
	{
		global $db;
		$query = " SELECT * FROM user WHERE email = :email ";
		$result = $db->prepare($query);
		$result->bindValue('email', $email);
		$result->execute();
		$id = $result->fetch();
		$result->closeCursor();
		return $id['id'];
	}

	public function get_details_by_id($id)
	{
		global $db;
		$query = " SELECT * FROM user WHERE id =:id";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->execute();
		$username = $result->fetch();
		$result->closeCursor();
		return $username;
	}

	


	public function get_email($id)
	{
		global $db;
		$query = " SELECT email FROM user WHERE id = :id";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->execute();
		$email = $result->fetch();
		return $email['email'];
	}

	public function save_message($email, $body, $name, $username)
	{
		global $db;
		$query = "INSERT INTO  sites  
				  (name, text, email, username, message_at)
				  VALUES (:name,:body , :email, :username, now())";
		$result = $db->prepare($query);
		$result->bindValue(':email', $email);
		$result->bindValue(':body', $body);
		$result->bindValue(':name', $name);
		$result->bindValue(':username', $username);

		$result->execute();
		$comment_id = $db->lastInsertId();
		$result->closeCursor();
		//return $comment_id;

	} 

}
























































































?>
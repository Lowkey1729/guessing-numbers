<?php include('../config.php'); ?>
<?php
	
	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
		global $db;
		$query = " SELECT *,  user.email As email, user.id As user_id   FROM user WHERE user.id =:id";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->execute();
		$email = $result->fetch();
		$result->closeCursor();

		echo json_encode($email);
	}







?>
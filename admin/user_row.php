<?php include('../config.php'); ?>
<?php
	
	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
		global $db;
		$query = " SELECT *, user.id As user_id,
		                         user.email As email  
		                      FROM user 
		                      WHERE user.id = :id";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->execute();
		$row = $result->fetch();
		$result->closeCursor();
		echo json_encode($row);
	}







?>
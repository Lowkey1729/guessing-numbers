<?php include('../config.php'); ?>
<?php
	
	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
		global $db;
		$query = " SELECT *,  sites.email As email, sites.id As id   FROM sites WHERE sites.id =:id";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->execute();
		$email = $result->fetch();
		$result->closeCursor();

		echo json_encode($email);
	}







?>
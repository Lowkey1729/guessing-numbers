<?php
$dsn = 'mysql:host=localhost;dbname=bet_web';
$usernam = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try
{
	$db = new PDO($dsn, $usernam, $password, $options);
}
catch(PDOException $e)
{
	$_SESSION['error'] = $e->getMessage();

	exit();

}


if(!isset($_SERVER['HTTPS']))
{
	$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header('location: '.$url);
}

?>
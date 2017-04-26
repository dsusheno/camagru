<?php

session_start();

include "../config/database.php";
try {
		$DB_host = $DB_DSN;
		$DB_user = $DB_USER;
		$DB_pass = $DB_PASSWORD;
		$DB_name = "camagru";
	 	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}

include_once 'class.user.php';
$user = new USER($DB_con);
?>
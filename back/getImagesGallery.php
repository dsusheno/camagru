<?php

include "../back/connection.php";

$stmt = $DB_con->prepare("SELECT img_path FROM images ORDER BY time_creat DESC");
$stmt->execute();
$all_path = $stmt->fetchAll();
$result = array();
foreach ($all_path as $value)
{
	$result[] = $value["img_path"];
}

$n = $_POST["n"];
$response = "";
$i = $n;
while (($i < $n + 4) && $result[$i] != NULL)
{
	$response = $response.$result[$i].';';
	$i++;
	
}
echo $response;
?>
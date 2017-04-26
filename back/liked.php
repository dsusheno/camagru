
<?php
function count_like($img_path)
{

include "../back/connection.php";
	try {
	$like = $DB_con->prepare("SELECT * FROM likes WHERE img_path=:img_path");
	$like->execute(array(':img_path'=>$img_path));
	$nb_like = $like->rowCount();
}
catch(PDOException $e)
{
				echo $e->getMessage();
				die();
			}
	return $nb_like;
}
?>
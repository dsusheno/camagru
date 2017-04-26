<?php
include "../back/connection.php";
?>

<?php
$login = $_POST['login'];
$img_path = $_POST['img_path'];
if ($login && $img_path)
{
		$like_selected = $DB_con->prepare("SELECT * FROM likes WHERE img_path=:img_path and login=:login");
		$like_selected->execute(array(':img_path'=>$img_path, ':login'=>$login));
		if ($like_selected->rowCount() == 0)
		{
			try {
				$sql = "INSERT INTO likes(img_path, login) VALUES('{$img_path}', '{$login}');";
				$DB_con->exec($sql);
				}
			catch(PDOException $e)
			{
				echo $sql . "<br>" . $e->getMessage();
				die();
			}
		}
}
?>
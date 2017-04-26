<?php
include "../back/connection.php";
?>

<?php
$img_path = $_POST["img_path"];
if ($img_path)
{
	$delete = $DB_con->prepare("DELETE from comments where img_path=:img_path; DELETE from likes where img_path=:img_path; DELETE from images where img_path=:img_path;");
	$delete->execute(array(":img_path"=>$img_path));
}
?>
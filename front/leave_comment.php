<?php
include "../back/connection.php";
?>

<?php
	if ($_POST["comment"])
	{
		$img_path = $_SESSION['path'];
		$comment = htmlentities($_POST["comment"]);
		$comment = addslashes($comment);
		$login = $_SESSION['user_session'];
		$sql = "INSERT INTO comments(img_path, login, comment) VALUES('{$img_path}', '{$login}', '{$comment}');";
		$DB_con->exec($sql);

		$user_comment = $login;
		$info_login = $DB_con->prepare("SELECT login FROM images WHERE img_path=:img_path");
        $info_login->execute(array(':img_path'=>$img_path));
        $all_info = $info_login->fetchAll();
        $img_owner = $all_info[0][login];

        $info_email = $DB_con->prepare("SELECT email FROM users WHERE login=:img_owner");
        $info_email->execute(array(':img_owner'=>$img_owner));
        $all_info = $info_email->fetchAll();
        $email = $all_info[0][email];
		$user->new_comment($email, $img_owner, $user_comment, $_POST["comment"]);
		?>
			<script type="text/javascript">
			var url = "../front/image.php?path=" + "<?php echo $img_path; ?>";
			window.location = url;
			</script>
		<?php
	}
?>


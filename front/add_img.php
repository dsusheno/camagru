<?php
include "../back/connection.php";

if($user->is_loggedin() && isset($_POST['img']))
{
	$png_f = 0;
	$jpg_f = 0;
	$jpeg_f = 0;
	if (!file_exists("../img")) {
    	mkdir("../img", 0777, true);
	}
	$upload_dir = "../img/";
	$img = $_POST['img'];
	$login = $_SESSION['user_session'];
	if (!strncmp($img, 'data:image/png;base64,', strlen('data:image/png;base64,')))
	{
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$png_f = 1;
	}
	else if (!strncmp($img, 'data:image/jpg;base64,', strlen('data:image/jpg;base64,')))
	{
		$img = str_replace('data:image/jpg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$jpg_f = 1;
	}
	else if (!strncmp($img, 'data:image/jpeg;base64,', strlen('data:image/jpeg;base64,')))
	{
		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$jpeg_f = 1;
	}
	if ($png_f || $jpg_f || $jpeg_f)
	{
		$data = base64_decode($img);
		$file = microtime();
		$file = $img = str_replace(' ', '', $file);
		$file = $img = str_replace('.', '', $file);
		$name = $upload_dir . $file;
		if ($png_f)
			$file = $name . ".png";
		else if ($jpg_f)
			$file = $name . ".jpg";
		else if ($jpeg_f)
			$file = $name . ".jpeg";
		$success = file_put_contents($file, $data);
		print $success ? $file : 'Unable to save the file.';
		$sql = "INSERT INTO images(name, img_path, login) VALUES ('{$name}', '{$file}', '{$login}')";
		$DB_con->exec($sql);
	}
}
else
{
	echo "No img or you're not logged in.";
}
?>

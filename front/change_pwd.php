<?php
include "../front/header.php";
?>

<?php

if ($user->is_loggedin())
{
	$login = $_SESSION["user_session"];
	$oldPwd = md5($_POST['oldPwd']);
	$newPwd = $_POST['newPwd'];
	
	$oldPwdGet = $user->get_pwd($login);
	if ($oldPwdGet != $oldPwd)
		echo "<h2>You made a mistake in your password.</h3>";
	else
	{
		$user->change_pwd($login, $newPwd);
		echo "<h2>Your password is updated.</h3>";
	}
}
else
{
	echo "<h3>Please Login</h3>";
}
?>

<?php
include "../front/footer.php";
?>
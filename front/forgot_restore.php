<?php
include "../front/header.php";
?>

<?php
$email = $_POST['email'];
$user_select = $DB_con->prepare("SELECT * FROM users WHERE email=:email");
$user_select->execute(array(':email'=>$email));
$userRow = $user_select->fetch(PDO::FETCH_ASSOC);
if ($user_select->rowCount() > 0)
{
	$new_pwd = $user->pwd_generate();
	$user->change_pwd($userRow['login'], $new_pwd);
	$user->new_pwd_mail($email, $userRow['login'], $new_pwd);
	echo "<h3>Your new password was sent to your e-mail</h3>";
}
else
	echo "<h3>User with that e-mail does not exists."
?>

<?php
include "../front/footer.php";
?>
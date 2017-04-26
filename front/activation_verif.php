<?php
include "../front/header.php";
?>

<?php
$login = $_POST['login'];
$pwd_activation = $_POST['pwd'];
$user_select = $DB_con->prepare("SELECT * FROM users WHERE login=:login");
$user_select->execute(array(':login'=>$login));
$userRow = $user_select->fetch(PDO::FETCH_ASSOC);
if ($user_select->rowCount() > 0)
{
	if ($pwd_activation == $userRow['pwd_activation'])
	{
		$user_select = $DB_con->prepare("UPDATE users SET activated = 1 WHERE login = :login");
		$user_select->execute(array(':login'=>$login));
		echo "<h3>Account is activated!\nPlease LogIn now.<h3>";
	}
	else
	{
		echo "<h3>Activation code is not good.</h3>";
	}
}
else
{
	echo "User don't exist.";
}

?>

<?php
include "../front/footer.php";
?>
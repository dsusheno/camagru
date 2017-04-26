<?php
include "../front/header.php";
?>

<?php
if ($_SESSION['user_session'] != NULL)
{
?>
<script type="text/javascript">
window.location = "../front/profile.php";
</script>
<?php
}
?>

<?php
$login = htmlentities($_POST['login']);
$login = addslashes($login);
$pwd = hash('md5', $_POST['pwd']);
if ($user->login($login, $pwd) != true)
{
	echo "<h3>Login or password are not good, or you didn't activate your accaount</h3>";
	?>
    <script type="text/javascript">
        function timeOut() {
            window.location = "../front/login.php";
        }
        window.setTimeout(timeOut, 5000);
    </script>
	<?
}
else
{
	?>
	<script type="text/javascript">
	window.location = "../front/index.php";
	</script>
	<?
}

?>

<?php
include "../front/footer.php";
?>
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

<div id="signup">

    <form action="login_connect.php" method="post">
        
            <h2>Log In</h2>
        	<input type="text" name="login" placeholder="User name" pattern="[0-9A-Za-z]{3,}" title="Login should contain minimum 3 numbera[0-9] or/and letters[A-Z/a-z]" autofocus required/>
            <input type="password" name="pwd" placeholder="Password" pattern="[0-9A-Za-z]{6,}"
       	    title="Password should contain minimum 6 numbera[0-9] or/and letters[A-Z/a-z]" required/>
            <input class="submit" type="submit" value="Log In">
    </form>
    <a href="../front/forgot_password.php"><input class="blue" type="submit" value="Forgot your Password?"></a>
    <a href="../front/activation.php"><input class="blue" type="submit" value="Activate account"></a>
</div>


<?php
include "../front/footer.php";
?>
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

    <form name="signup" action="signup_connect.php" method="post">
        
            <h2>Register</h2>
            <h3>Fill in this form</h3>
        	<input type="text" name="login" placeholder="User name" pattern="[0-9A-Za-z]{3,}" title="Login should contain minimum 3 numbera[0-9] or/and letters[A-Z/a-z]" autofocus required/>
            <input type="gmail" name="email" placeholder="e-mail" required/>
       	    <input type="password" name="pwd" placeholder="Password" pattern="[0-9A-Za-z]{6,}"
       	    title="Password should contain minimum 6 numbera[0-9] or/and letters[A-Z/a-z]" required/>
            <input class="submit" type="submit" value="REGISTER">
    </form>

</div>

<?php
include "../front/footer.php";
?>

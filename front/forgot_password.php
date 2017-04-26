<?php
include "../front/header.php";
?>

<div id="signup">

    <form action="forgot_restore.php" method="post">
        
            <h3>Put your E-mail to restor your password</h3>
        	<input type="email" name="email" placeholder="E-mail" autofocus required/>
            <input class="submit" type="submit" value="Restore">
    </form>

</div>

<?php
include "../front/footer.php";
?>
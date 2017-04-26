<?php
include "../front/header.php";
?>

<div id="signup">

    <form action="activation_verif.php" method="post">
        
            <h3>You received confirmation e-mail with your Activation Code</h3>
        	<input type="text" name="login" placeholder="User name" autofocus required/>
            <input type="password" name="pwd" placeholder="Code" required/>
            <input class="submit" type="submit" value="Activate">
    </form>

</div>

<?php
include "../front/footer.php";
?>
<?php
include "../front/header.php";
?>

<?php
	$login = htmlentities($_POST['login']);
  $login = addslashes($login);
	$email = addslashes($_POST['email']);
  if ($_POST['pwd'] == NULL)
    $pwd = NULL;
  else
    $pwd = hash('md5', $_POST['pwd']);

  if ($login != NULL && $email != NULL && $pwd != NULL)
  {
	   $exec_login = $DB_con->prepare("SELECT login FROM users WHERE login = '{$login}'"); 
	   $exec_login->execute();
     $exec_mail = $DB_con->prepare("SELECT email FROM users WHERE email = '{$email}'");
     $exec_mail->execute(); 
     if ($exec_login->rowCount() > 0 || $exec_mail->rowCount() > 0)
     {
   		 echo "<h3>Login $login or e-mail $email are already used</h3>";
       ?>
       <script type="text/javascript">
       function timeOut()
       {
          window.location = "../front/signup.php";
        }
        window.setTimeout(timeOut, 3000);
        </script>
    <?php
      }
      else {
        $user->register($login, $pwd, $email);
        ?>
         <script type="text/javascript">
         window.location = "../front/activation.php";
        </script>
        <?php
      }
  }
  else
  {
    ?>
    <script type="text/javascript">
    window.location = "../front/signup.php";
    </script>
    <?php
  }
?>

<?php
include "../front/footer.php";
?>
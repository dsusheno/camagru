<?php
include "../front/header.php";
?>

<?php
if ($user->is_loggedin())
{
	$user->logout();
}
?>

<script type="text/javascript">
window.location = "../front/index.php";
</script>

<?php
include "../front/footer.php";
?>
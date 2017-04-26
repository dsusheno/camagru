<?php
include "../back/connection.php";
?>

<html>
<head>
	<title>PicSelf</title>
	<link rel="stylesheet" type="text/css" href="../front/css/header.css" />
	<link rel="stylesheet" type="text/css" href="../front/css/footer.css" />
	<link rel="stylesheet" type="text/css" href="../front/css/body.css" />
	<link rel="stylesheet" type="text/css" href="../front/css/photo_page.css" />
	<link rel="stylesheet" type="text/css" href="../front/css/profile.css" />
	<link rel="stylesheet" type="text/css" href="../front/css/video.css" />
</head>
<body>
<div>
<ul class="header">
<li>
<a href="../front/index.php">Gallery</a>
</li>
<li>
<a href="../front/video.php">PicYourSelf</a>
</li>
<?php
if ($user->is_loggedin())
{
	echo '<li class="right">
		<a href="../front/profile.php">'.$_SESSION['user_session'].'</a>
		</li>';
	echo '<li class="right">
		<a href="../front/logout.php">Logout</a>
		</li>';
	}
else
{
	echo '<li class="right">
		<a href="../front/signup.php">Register</a>
		</li>';
	echo '<li class="right">
		<a href="../front/login.php">LogIn</a>
		</li>';
	}
?>
</ul>
</div>
<script>
onload = function ()
{
for (var lnk = document.links, j = 0; j < lnk.length; j++)
if (lnk [j].href == document.URL) lnk [j].className = 'act';
}
</script>
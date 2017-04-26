<?php
include "../front/header.php";
include "../back/liked.php";
?>

<?php
if (!$_GET['path'])
	echo "<h3>You didn't choose an image</h3>";
else
{
	$img_path = $_GET['path'];
	$_SESSION['path'] = $img_path;
	if (!file_exists($img_path))
		echo "<h3>Image doesn't exists</h3>";
	else
	{
		$img_selected = $DB_con->prepare("SELECT * FROM images WHERE img_path=:img_path");
		$img_selected->execute(array(':img_path'=>$img_path));
		if ($img_selected->rowCount() > 0)
		{
			$all_info = $img_selected->fetchAll();
			?>
			<br>
			<div id="img_block">
			<?php
				if ($_SESSION["user_session"] == $all_info[0]['login'])
				{
					echo "<div class=\"delete_div\"><button class=\"delete\" onclick=\"deleteFunction()\">Delete</button></div><br>";
				}
			?>
			<img class="img_block" src="<?php echo $img_path; ?>"/>
			<br>
			<div class="likes">
			<table class="likes_table">
			<tr>
			<td>
			<?php
				if ($user->is_loggedin())
				{
					?>
					<button class="likes_button" onclick="likeFunction()">Like</button> <?php echo count_like($img_path); ?>
					<?php
				}
				else
				{
					echo "<h3 class=\"login_like\">Please Login to like.</h3>";
				}
			?>
			</td>
			<td class="rightcol"><h3 class="login">@<?php echo $all_info[0]['login']; ?></h3></td>
			</tr>
			</table>
			</div>
			<br>
			
			<?php
			$leaved_comments = $DB_con->prepare("SELECT * FROM comments WHERE img_path=:img_path ORDER BY comment_time DESC");
			$leaved_comments->execute(array(':img_path'=>$img_path));
			if ($leaved_comments->rowCount() > 0)
			{
				$all_info = $leaved_comments->fetchAll();
				foreach ($all_info as $value)
				{
					?>
					<div id='lived_comment'>
					<div>
					<table class="login_time">
   					<tr>
   					 <td><h4 class="login">@<?php echo $value["login"]; ?></h4></td>
   					 <td class="rightcol"><h4 class="time"><?php echo $value["comment_time"]; ?></h4></td>
   					</tr>
   					</table>
   					</div>
					<div class="comment"><h5 class="comment"><?php echo $value["comment"]; ?></h5></div>
					</div>
					<?php
				}
			}
			if (!$user->is_loggedin())
				echo "<h3>Please Login to leave a comment</h3></div>";
			else
			{
				?>

				<div id="leave_comment">
				<form action="leave_comment.php" method="post">
        		<input type="text" name="comment" placeholder="Your comment" required/>
            	<input class="submit" type="submit" value="Leave a comment">
    			</form>
				</div>
				</div>
				
				<?php
			}
		}
		else
			echo "<h3>Image doesn't exists</h3>";
	}
}
?>

<script type="text/javascript">
var xmlhttp;

if(window.XMLHttpRequest)
	xmlhttp = new XMLHttpRequest();
else
	if(window.ActiveXObject)
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	else
		alert ("Извините! Ваш браузер не поддерживает XMLHTTP!");

function likeFunction()
{
	var img_path = "<?php echo $img_path; ?>";
	var login = "<?php echo $_SESSION['user_session']; ?>";
	var url = "../back/like.php";
	var param = "login=" + login + "&img_path=" + img_path;

	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.send(param);
	window.location.reload();
}

function deleteFunction()
{
	var img_path = "<?php echo $img_path; ?>";
	var url = "../back/delete_photo.php";
	var param = "img_path=" + img_path;

	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.send(param);
	window.location = "../front/profile.php";

}

</script>

<?php
include "../front/footer_relative.php";
?>
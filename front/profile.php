<?php
include "../front/header_gallery.php";
?>

<?php
if ($user->is_loggedin())
{
?>

<table class="profile">
<td class="left">
	<h2>Your photos</h2>
	<div id="gallery_profile">
	</div>
</td>
<td class="right"><h2>Profile</h2>
<div id="signup">
    <form action="change_pwd.php" method="post">
    	<h3>Change password</h3>
        	<input type="password" name="oldPwd" placeholder="Current password" pattern="[0-9A-Za-z]{6,}"
       	    title="Password should contain minimum 6 numbera[0-9] or/and letters[A-Z/a-z]" required/>
            <input type="password" name="newPwd" placeholder="New password" pattern="[0-9A-Za-z]{6,}"
       	    title="Password should contain minimum 6 numbera[0-9] or/and letters[A-Z/a-z]" required/>
            <input class="submit" type="submit" value="Change password">
    </form>
</div>
</td>
</table>


<script>
var contentHeight = 800;
var pageHeight = document.documentElement.clientHeight;
var scrollPosition;
var n = 0;
var xmlhttp;

function putImages(){
	
	if (xmlhttp.readyState==4) 
	  {
		  if(xmlhttp.responseText){
			 var resp = xmlhttp.responseText.replace("\r\n", ""); 
			 var files = resp.split(";");
			  var j = 0;
			  for(i=0; i<files.length; i++){
				  if(files[i] != ""){
					 document.getElementById("gallery_profile").innerHTML += '<a href="../front/image.php?path='+files[i]+'"><img class="gallery_profile" src="'+files[i]+'"/></a>';
					 j++;
					 	document.getElementById("gallery_profile").innerHTML += '<br />';
					 if(j % 4 == 0)
					 	document.getElementById("gallery_profile").innerHTML += '<hr />';
				  }
			  }
		  }
	  }
}
		
		
function scroll(){
	if(navigator.appName == "Microsoft Internet Explorer")
		scrollPosition = document.documentElement.scrollTop;
	else
		scrollPosition = window.pageYOffset;		
	
	if((contentHeight - pageHeight - scrollPosition) < 500){
				
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			if(window.ActiveXObject)
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			else
				alert ("Sorry! Your browser doesn't support XMLHTTP!");		  

		var url = "../back/getImagesProfile.php";
		var login = "<?php echo $_SESSION['user_session']; ?>";
		var param = "n=" + n + "&login=" + login;
		xmlhttp.open("POST", url, true);
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlhttp.send(param);
		
		n += 4;
		xmlhttp.onreadystatechange = putImages;		
		contentHeight += 800;		
	}
}

</script>

<?php
	include "../front/footer_relative.php";
	}
	else
	{
		echo "<h3>Please Login to see your photos.</h3>";
		include "../front/footer.php";
	}
?>
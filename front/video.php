<?php
include "../back/connection.php";
if ($user->is_loggedin())
{
	include "../front/header_gallery.php";
?>

<table class="pic">
<td class="left" style="width: 70%;">
<?php
include "../front/webcam.php";
?>
</td>
<td class="right">
	<h3>Your photos</h3>
	<div id="gallery_profile">
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
	
	if((contentHeight - pageHeight - scrollPosition) < 800){
				
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
}
	else
	{
		include "../front/header.php";
		echo "<h3>You need to log in.</h3>";
		include "../front/footer.php";
	}
?>
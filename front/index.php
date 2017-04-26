<?php
include "../front/header_gallery.php";
?>

<table class="profile">
<td class="one">
	<h2>All photos</h2>
	<div id="gallery">
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
					 document.getElementById("gallery").innerHTML += '<a href="../front/image.php?path='+files[i]+'"><img class="gallery" src="'+files[i]+'"/></a>';
					 j++;
				  
					 if(j % 2 == 0)
					 	document.getElementById("gallery").innerHTML += '<br />';
					 if(j % 4 == 0)
					 	document.getElementById("gallery").innerHTML += '<hr />';
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
		  
		var url = "../back/getImagesGallery.php";
		var param = "n=" + n;
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
?>
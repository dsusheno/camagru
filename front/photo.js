
var filter , f_w, f_h, f_x, f_y, flip;

var v = document.getElementById('video'),
	v_h = v.height,
	v_w = v.width;

	var w = v_w, h = v_h;

	console.log(w + " " + h);
flip = 0;

function toggle_save()
{
		$save = document.getElementById('save');
		save.style.display = "block";
}

function toggle_filter(id)
{
	var smile_v = document.getElementById('smile_v'),
		grind_v = document.getElementById('grind_v');
		alah_v = document.getElementById('alah_v');
		clown_v = document.getElementById('clown_v');
		mustache_v = document.getElementById('mustache_v');
		aux = document.getElementById(id);
		cap = document.getElementById('capture');
		if (aux.style.display == "none")
		{
			smile_v.style.display = "none";
			grind_v.style.display = "none";
			alah_v.style.display = "none";
			clown_v.style.display = "none";
			mustache_v.style.display = "none";
			aux.style.display = "block";
			cap.style.display = "block";
		}
		else
		{
			cap.style.display = "none";
			aux.style.display = "none";
			filter = null;
		}

}

function verif()
{
		var smile_v = document.getElementById('smile_v'),
		grind_v = document.getElementById('grind_v'),
		alah_v = document.getElementById('alah_v'),
		clown_v = document.getElementById('clown_v'),
		mustache_v = document.getElementById('mustache_v'),
		sav = document.getElementById('save'),
		cap = document.getElementById('capture');

		if (smile_v.style.display == "none" && grind_v.style.display == "none" && alah_v.style.display == "none" && clown_v.style.display == "none" && mustache_v.style.display == "none")
		{
			sav.style.display = "none";
			cap.style.display = "none";
			return (1);		
		}
		return (0);
}

function get_filter(i)
{
	if (i == '1')
	{
		var	overlay = document.getElementById('over');
		overlay.className = "overlay_smile";
		filter = document.getElementById('smile');
		f_w = 160;
		f_h = 120;
		f_x = 50;
		f_y = 50;
	}
	else if (i == '2')
	{
		var overlay = document.getElementById('over');
		overlay.className = "overlay_grind";
		grind_v.style.width = 400; 
		grind_v.style.height = 300;
		filter = document.getElementById('grind');
		f_w = 400;
		f_h = 300;
		f_x = 0;
		f_y = 0;
	}
	else if (i == '3')
	{
		var overlay = document.getElementById('over');
		overlay.className = "overlay_grind";
		alah_v.style.width = 400; 
		alah_v.style.height = 300;
		filter = document.getElementById('alah');
		f_w = 400;
		f_h = 300;
		f_x = 0;
		f_y = 0;
	}
	else if (i == '4')
	{
		var overlay = document.getElementById('over');
		overlay.className = "overlay_clown";
		filter = document.getElementById('clown');
		f_w = 160;
		f_h = 120;
		f_x = 200;
		f_y = 150;
	}
	else if (i == '5')
	{
		var overlay = document.getElementById('over');
		overlay.className = "overlay_clown";
		filter = document.getElementById('mustache');
		f_w = 160;
		f_h = 120;
		f_x = 200;
		f_y = 150;
	}
}


(function(){

	var video = document.getElementById('video'),
		canvas = document.getElementById('canvas'),
		context = canvas.getContext('2d'),
		img = document.getElementById('img');
		vendorUrl = window.URL || window.webkitURL;

		var constraints = { audio: false, video: true };
	
		navigator.mediaDevices.getUserMedia(constraints).then(function(stream){
			video.src = vendorUrl.createObjectURL(stream);
			video.play();
		})
		.catch(function(err) { console.log(err.name + ": " + err.message); });


	var fr;
	var file;
	select = document.getElementById('fileselect');

	select.addEventListener('change', function(){
		file = select.files[0];
		fr = new FileReader();
		fr.onload = recievedData;
		if (file)
		{
			fr.readAsDataURL(file);
			toggle_save();
		}
	});

	function recievedData(){
		img.src = fr.result;
	}

	document.getElementById('capture').addEventListener('click', function(){
		select.value = "";
		if (!verif() &&  filter)
		{
		context.clearRect(0, 0, canvas.width, canvas.height);
		toggle_save();
		if (flip == 0)
		{
			context.translate(w, 0);
			context.scale(-1, 1);
			flip = 1;
		}
		context.drawImage(video, 0, 0, w, h);
		if (filter)
		{
			if (flip == 1)
			{
				context.translate(w, 0);
				context.scale(-1, 1);
				flip = 0;
			}
			context.drawImage(filter,f_x,f_y,f_w,f_h);

		}
		img.setAttribute('src', canvas.toDataURL('image/png'));
	}
	});

	document.getElementById('save').addEventListener('click', function(){
		if (img.src)
		{
			var ajax = getXMLHttpRequest();
			var params = 'img=' + img.src;
			ajax.open("POST", "add_img.php", true);
    		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    		ajax.send(params);
    		setTimeout("location.reload(true);", 500);
    	}
	});
})();

function getXMLHttpRequest() {
    var xhr = null;

    if(window.XMLHttpRequest || window.ActiveXObject){
        if(window.ActiveXObject){
            try{
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            }catch(e){
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }else{
            xhr = new XMLHttpRequest();
        }
    }else{
        alert("Your browser doesn't support XMLHTTPRequest !");
        return;
    }
	return xhr;
}

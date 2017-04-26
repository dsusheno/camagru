<style>
.booth{
    width: 400px;
    height: 300px;
    background-color: #ccc;
    border: 10px solid #ddd;
    margin: 0 auto;
}

.capture-button{
    display: block;
    margin: 10px 0;
    padding: 10px 20px;
    background-color: cornflowerblue;
    color: #fff;
    text-align: center;
    text-decoration: none;
}

#canvas {
    display: none;
}

.container { position:relative; }
.container video {
    position:relative;
    z-index:0;
}
.overlay_smile {
    position:absolute;
    top:50;
    left:50;
    z-index:1;
}
.overlay_grind {
    position:absolute;
    top:0;
    left:0;
    z-index:1;
}

.overlay_clown {
    position:absolute;
    top:50%;
    left:50%;
    z-index:1;
}


.filter{

	margin: 0 auto;	
}

.img_buttons
{
    cursor: pointer;
    border: solid 1px;
}

#video{
     transform: rotateY(180deg);
    -webkit-transform:rotateY(180deg); /* Safari and Chrome */
    -moz-transform:rotateY(180deg);
}
</style>

<div class="filter">
  <img class="img_buttons" id="smile" src="upload/test1.png" width="160" height="120" onclick="get_filter('1'); toggle_filter('smile_v')">
  <img class="img_buttons" id="grind" src="upload/test2.png" width="160" height="120" onclick="get_filter('2'); toggle_filter('grind_v')">
  <img class="img_buttons" id="alah" src="upload/test3.png" width="160" height="120" onclick="get_filter('3'); toggle_filter('alah_v')">
  <img class="img_buttons" id="clown" src="upload/test4.png" width="160" height="120" onclick="get_filter('4'); toggle_filter('clown_v')">
  <img class="img_buttons" id="mustache" src="upload/test5.png" width="160" height="120" onclick="get_filter('5'); toggle_filter('mustache_v')">
</div>

<div class="booth">

  <div class="container">
    <video id="video" width="400" height="300"></video>
        <div id="over" class="overlay">
            <img id="smile_v" src="upload/test1.png" width="160" height="120" style="display: none;">
            <img id="grind_v" src="upload/test2.png" width="160" height="120" style="display: none;">
            <img id="alah_v" src="upload/test3.png" width="160" height="120" style="display: none;">
            <img id="clown_v" src="upload/test4.png" width="160" height="120" style="display: none;">
            <img id="mustache_v" src="upload/test5.png" width="160" height="120" style="display: none;">
        </div>
    </div>
    <button id="capture" class="capture-button" style="display: none;">Take a photo</button>
    <input  id="fileselect" type="file" accept="image/*">
    <button id="save" class="capture-button" style="display: none;">Save Photo</button>
    <canvas id="canvas" width="400" height="300"></canvas>
    <img id="img" src="" width="400" height="300">
</div>
<script src="photo.js"></script>


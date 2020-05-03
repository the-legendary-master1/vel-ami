<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Coming Soon - VELAMI</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<style>
		body{background:url(/files/background.png) repeat;background-size:200px auto;height:100%}@font-face{font-family:bebas_neueregular;src:url(https://dl.dropboxusercontent.com/u/81135676/bebasneue_regular-webfont.eot);src:url(https://dl.dropboxusercontent.com/u/81135676/bebasneue_regular-webfont.woff2) format("woff2"),url(https://dl.dropboxusercontent.com/u/81135676/bebasneue_regular-webfont.woff) format("woff"),url(https://dl.dropboxusercontent.com/u/81135676/bebasneue_regular-webfont.ttf) format("truetype"),url(https://dl.dropboxusercontent.com/u/81135676/bebasneue_regular-webfont.svg#bebas_neueregular) format("svg");font-weight:400;font-style:normal}@font-face{font-family:bebas_neuebold;src:url(https://dl.dropboxusercontent.com/u/81135676/bebasneue_bold-webfont.eot);src:url(https://dl.dropboxusercontent.com/u/81135676/bebasneue_bold-webfont.woff2) format("woff2"),url(https://dl.dropboxusercontent.com/u/81135676/bebasneue_bold-webfont.woff) format("woff"),url(https://dl.dropboxusercontent.com/u/81135676/bebasneue_bold-webfont.ttf) format("truetype"),url(https://dl.dropboxusercontent.com/u/81135676/bebasneue_bold-webfont.svg#bebas_neuebold) format("svg");font-weight:400;font-style:normal}body,html{display:block;padding:0;margin:0;width:100%;position:relative;height:100%}body{font-family:bebas_neuebold,Arial,sans-serif}section{position:relative;width:100%;height:100%;background:radial-gradient(circle,#bed6ff,#266fea)}#canvas{position:absolute;top:0;left:0;width:100%;height:100%;z-index:100}.coming_content{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);width:70%;margin:0 auto;color:#fff;text-align:center;z-index:101}.coming_content h1{font-size:5.625em;margin:0;letter-spacing:2px;text-align:center}.coming_content .separator_container{width:100%;display:block;text-align:center;position:relative;margin:12px 0}.coming_content .separator_container:after,.coming_content .separator_container:before{display:table;content:""}.coming_content .separator_container:after{clear:both}.coming_content .separator{color:#fff;margin:0 auto 1em;width:25em}.coming_content .line_separator svg{width:40px;height:40px;fill:#fff}.coming_content .line_separator:after,.coming_content .line_separator:before{display:block;width:40%;content:" ";margin-top:20px;border:1px solid #fff}.coming_content .line_separator:before{float:left}.coming_content .line_separator:after{float:right}.coming_content h3{font-family:Montserrat,sans-serif;letter-spacing:2px;line-height:2;font-size:1.387em;font-weight:400;text-align:center;margin:0;text-shadow:2px 3px 7px #003896}.coming_content h3 a{text-decoration:underline}h1{color:#fff;font:900 100px Helvetica,Arial,Sans-Serif;text-shadow:2px 10px 12px #003896;margin:0 auto;text-align:center;text-transform:uppercase}@media only screen and (max-width:768px){.coming_content h1{font-size:3em}.coming_content h3{font-size:.95em}.coming_content .separator{width:25em;max-width:100%}.coming_content .line_separator:after,.coming_content .line_separator:before{width:20vw}}
	</style>
</head>
<body>
	<section> <canvas id='canvas'></canvas> <div class="coming_content"> <h1>Coming Soon</h1> <div class="separator_container"> <div class="separator line_separator"> <span> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="36px" viewBox="0 0 40 36" style="enable-background:new 0 0 40 36;" xml:space="preserve"><g id="Page-1_4_" sketch:type="MSPage"><g id="Desktop_4_" transform="translate(-84.000000, -410.000000)" sketch:type="MSArtboardGroup"><path id="Cart" sketch:type="MSShapeGroup" class="st0" d="M94.5,434.6h24.8l4.7-15.7H92.2l-1.3-8.9H84v4.8h3.1l3.7,27.8h0.1c0,1.9,1.8,3.4,3.9,3.4c2.2,0,3.9-1.5,3.9-3.4h12.8c0,1.9,1.8,3.4,3.9,3.4c2.2,0,3.9-1.5,3.9-3.4h1.7v-3.9l-25.8-0.1L94.5,434.6"/></g></g> </svg> </span> </div></div><h3>Stay Home & Shop Online</h3> </div></section>
	<script>
		for(var canvas=document.getElementById("canvas"),ctx=canvas.getContext("2d"),particles=[],particleCount=280,i=0;i<particleCount;i++)particles.push(new particle);function particle(){this.x=Math.random()*canvas.width,this.y=canvas.height+300*Math.random(),this.speed=1+Math.random(),this.radius=3*Math.random(),this.opacity=100*Math.random()/1e3}function loop(){requestAnimationFrame(loop),draw()}function draw(){ctx.clearRect(0,0,canvas.width,canvas.height),ctx.globalCompositeOperation="lighter";for(var t=0;t<particles.length;t++){var a=particles[t];ctx.beginPath(),ctx.fillStyle="rgba(255,255,255,"+a.opacity+")",ctx.arc(a.x,a.y,a.radius,0,2*Math.PI,!1),ctx.fill(),a.y-=a.speed,a.y<=-10&&(particles[t]=new particle)}}loop();
	</script>
</body>
</html>
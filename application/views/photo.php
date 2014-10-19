<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <title>webcam demo</title>
		<meta name="author" content="terry - gbin1.com">
		<meta name="description" content="HTML5 webcam demo">
		<meta name="keywords" content="HTML5,webcam,gbin1.com, gbin1, gbtags">
		<link href='http://fonts.googleapis.com/css?family=Revalia' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo base_url("static/photo/css/jquery.qtip.css");?>" type="text/css" media="screen">
		<script type="text/javascript" src="<?php echo base_url("static/photo/js/jquery-1.8.2.min.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("static/photo/js/photobooth_min.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("static/photo/js/jquery.qtip.min.js");?>"></script>
		<script type="text/javascript" src="<?php echo base_url("static/photo/js/gbin1.js");?>"></script>
		<style>
			body{
				font-size:12px;
				background: #68A7E7;
				font-family: 'Revalia', cursive, arial;
			}
			
			div#pictures,div#webcam{
				margin: 10px 0 0;
			}

			
			#main{
				width: 100%;
/*				margin: 10px auto;
				background: #FFF;
				color: #333;
				border: 2px solid #FFF;
				box-shadow: 0px 0px 10px #CCC;
				padding:20px;
				border-radius: 5px;*/
			}
			
			#main article{
				margin-bottom: 50px;
				background: #F8F8F8;
				border-radius: 5px;
				padding:20px;
				border: 1px solid #bbb;
			}
			
			#main #webcam{
				height: 200px;
				width: 100%;
			}
			
			#main #plist{
				margin: 20px 0;
				font-weight: bold;
				border-radius: 5px;
				background: #CCC;
				padding:10px;
			}
			
			#main img{
				margin-bottom: 50px;
				background: #F8F8F8;
				border-radius: 10px;
				box-shadow: 0px 0px 5px #888;
			}			
			
			.clear{
				clear:both;
			}
			
			#main ul{
				list-style:none;
				margin:0;
				padding:0;
			}
			
			#main .photobooth{
				border: 1px solid #ccc;
				border-radius: 5px;
			}
		
		</style>
	</head> 
	<body>
		
		<section id="main">
			<article>
			<div id="webcam"></div>
			</article>
		</section>
	</body>	
</html>
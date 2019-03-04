<?php 
/**
 Template Name: picwall

 */

?>

<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta name="referrer" content="no-referrer" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Skyarea·PicWall</title>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/picwall/css/polaroid-gallery.css"/>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/picwall/js/polaroid-gallery.js"></script>
</head>
<body class="fullscreen">
	<span class="back-text">Skyarea · PicWall</span>
	
	<div id="gallery"  class="fullscreen"></div>
	<div id="nav"  class="navbar">
	    <button id="preview" >&lt; 前一张</button>
		<button id="reload" onClick="polaroidGallery()" >下一批</button>
	    <button id="next" >下一张 &gt;</button>
		
		
	</div>
	
	
	<script>
	    window.onload = function () {
	        new polaroidGallery();
	    }
	</script>
</body>
</html>
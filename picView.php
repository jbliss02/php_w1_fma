<?php
	//code that creates an image for view
	
	require('classes/downloadedPic.php');
	
	//the the file name from the url
		if(isset($_GET["img"])){
	
			$img = urldecode($_GET["img"]);
			$pic = new downloadedPic($img);
			header('Content-Type: image/jpeg');
			imagejpeg($pic->returnImage(), NULL, 100);

		}//if url parameter exists
		
?>
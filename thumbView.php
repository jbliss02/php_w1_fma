<?php

	//require('classes/downloadedPic.php');
	//$pic = new downloadedPic(urldecode($_GET["img"]));

	


	
	
	//the the file name from the url
		if(isset($_GET["img"])){
	
			$img = urldecode($_GET["img"]);
			
			require('classes/downloadedPic.php');
			$pic = new downloadedPic($img);
			header('Content-Type: image/jpeg');
			imagejpeg($pic->thumbNail, NULL, 100);
			
			
			//the below works!!!
			//require('classes/picCollection.php');
			//$pics = new picCollection();	
			//header('Content-Type: image/jpeg');
			//imagejpeg($pics->imgList[0]->thumbNail, NULL, 100);
	
			

		}//if url parameter exists
	


?>

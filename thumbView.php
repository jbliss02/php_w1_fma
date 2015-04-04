<?php

	//require('classes/downloadedPic.php');
	//$pic = new downloadedPic(urldecode($_GET["img"]));

	
		require('classes/picCollection.php');
	  $pics = new picCollection();
	
		header('Content-Type: image/jpeg');
		imagejpeg($pics->imgList[0]->thumbNail, NULL, 100);
	

	//require('classes/picCollection.php');
	//$pics = new picCollection();

	//require('classes/downloadedPic.php');
	//$img = new downloadedPic();
	
	//header('Content-Type: image/jpeg');
	//$pics->returnThumb();
	//imagejpeg($pics->returnThumb(), NULL, 90);
	//echo('errrr');
	//echo($pics->imgList[0]->origName);
	//imagejpeg($pics->imgList[0]->fileName, NULL, 90);
	
	
	//the the file name from the url
		if(isset($_GET["img"])){
	
			$img = urldecode($_GET["img"]);
			//header('Content-Type: image/jpeg');
			//imagejpeg($pics->returnThumb(), NULL, 90);
			//imagejpeg($img, NULL, 90);
	}
	


?>

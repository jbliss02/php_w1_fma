<?php


	
	require('classes/picCollection.php');

	
	$pics = new picCollection();
	$pics->loadAllImages();
	//$pics->displayThumbs();

	
	echo('<img src="'.$pics->imgList[0]->fileName.'" />');
	


?>
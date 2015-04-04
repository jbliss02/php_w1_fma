<?php

	include_once('includes/functions.php');
	require('classes/picCollection.php');
	require('classes/template.php');

	$view = new template('includes/templatePage.html'); //set the template object
	
	//extract the view number from the url parameter
	if(isset($_GET["view"])){
		$viewNumber = $_GET["view"];
	}
	else {
		$viewNumber = 1; //default
	}
	
	//print out content based on what view is requested
	if($viewNumber == 1){
	
		//the main thumbnail view
		$view->setContent("%heading%", "Main Page");
		$view->setContent("%content%", "Click a thumbnail to view");
		echo $view->returnContent();	
				
		$pics = new picCollection(); 

		foreach($pics->imgList as $pic) {
			//echo('<img src="thumbView.php?img='.urlencode($pic->fileName).'" />');
			//printThumbnail('thumbView.php?img='.urlencode($pic->fileName), $pic);
			printThumbnail($pic);
		}

	}
	else if ($viewNumber == 2){
	
		if(isset($_GET["src"])){
		
			$src = urldecode($_GET["src"]);
			
			$view->setContent("%heading%", "Image View");
			$view->setContent("%content%", "Click image return to main page");
		
			$pic = new downloadedPic($src);
		
			header('Content-Type: image/jpeg');
			imagejpeg($pic->returnImage(), NULL, 100);
			
			
		}

	

	
	}
	
	



?>
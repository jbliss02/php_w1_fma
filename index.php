<?php

	include_once('includes/functions.php');
	require('classes/picCollection.php');
	require('classes/template.php');
	require('classes/dal.php');
	
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
		
		//set the heading and content
		$view->setContent("%heading%", "Main Page");
		$view->setContent("%content%", "Click a thumbnail to view");
		echo $view->returnContent();	
				
		//create the object containing the collection of all images and print the thumbnail for each
		$pics = new picCollection(); 

		foreach($pics->imgList as $pic) {
			printThumbnail($pic);
		}

	}
	else if ($viewNumber == 2){
	
		//the view of a single image
	
		if(isset($_GET["src"])){
		
			$src = urldecode($_GET["src"]);
			
			$view->setContent("%heading%", "Image View");
			$view->setContent("%content%", "Click image return to main page");
		
			$pic = new downloadedPic($src);
			printImage($pic);
			
			//echo($src);
			$dal = new dal();
			$picInfo = $dal->getByFilePath($src);
			

			
			printImageInfo($picInfo);
			
		}//view 2 ends
	
	}//which view #
	
?>
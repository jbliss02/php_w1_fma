<?php

	//the main entry point to the application
	//has a number of different views, view is determined by the view URL parameter
	//view 1 is the defauly and will show if no URL is shown

	include_once('includes/functions.php');
	require('classes/picCollection.php');
	require('classes/template.php');
	require('classes/dal.php');
	require('config.php');
	require 'lang/'. $config['language'] .'.php';
	
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

		//create the object containing the collection of all images and print the thumbnail for each
		$pics = new picCollection(); 
		
		//set the heading and content
		$view->setContent("%heading%", $lang['header_1']);
		$view->setContent("%content%", $lang['headtag_1']);
			
		//print a thumbnail for each image
		$st = ''; //the html for all the images
		
		//add to the html for all images in the collection
		foreach($pics->imgList as $pic) {	
			$st = $st.returnThumbnail($pic);
		}
		
		//print the view
		$view->setContent("%data%", $st);
		echo $view->returnContent();

	}
	else if ($viewNumber == 2){
	
		//the view of a single image	
		if(isset($_GET["src"])){
		
			$src = urldecode($_GET["src"]); //get the image url from the get paramters
			
			//set the headings
			$view->setContent("%heading%", $lang['header_2']);
			$view->setContent("%content%", $lang['headtag_2']);
			
			//get and print the image 
			$pic = new downloadedPic($src);
	
			//get and print the info about the image
			$dal = new dal();
			$picInfo = $dal->getByFilePath($src);
			
			$st = returnPrintImage($pic);
			$st = $st.' '.returnPrintImageIngo($picInfo);
			$view->setContent("%data%", $st);
			
			//print the info
			echo $view->returnContent();
			
			
		}//if src is set
	}//view 2 ends
	else if ($viewNumber == 3){
		
		//upload view
		$view->setContent("%heading%",$lang['header_3']);
		$view->setContent("%content%", $lang['headtag_3']);
		
		//generate and show the upload form
		$view->setContent("%data%", returnUploadForm($lang["fileComments"], $lang['fileUpload']));
		echo $view->returnContent();

	}
	else if($viewNumber == 4){
	
		//user has succesfully uploaded
		$view->setContent("%heading%", $lang['header_4']);
		$view->setContent("%content%", $lang['headtag_4']);
		$view->setContent("%data%", '');

		echo $view->returnContent();
		
	}//which view

?>
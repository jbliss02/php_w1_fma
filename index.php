<?php

	include_once('includes/functions.php');
	require('classes/picCollection.php');
	require('classes/template.php');
	require('classes/dal.php');
	require('config.php');
	require 'lang/'. $config['language'] .'.php';
	include('includes/menu.html'); 
	
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
		$view->setContent("%heading%", $lang['header_1']);
		$view->setContent("%content%", $lang['headtag_1']);
		echo $view->returnContent();	
				
		//create the object containing the collection of all images and print the thumbnail for each
		$pics = new picCollection(); 

		//print a thumbnail for each image
		foreach($pics->imgList as $pic) {
			printThumbnail($pic);
		}

	}
	else if ($viewNumber == 2){
	
		//the view of a single image	
		if(isset($_GET["src"])){
		
			$src = urldecode($_GET["src"]); //get the image url from the get paramters
			
			//set the headings
			$view->setContent("%heading%", $lang['header_2']);
			$view->setContent("%content%", $lang['headtag_2']);
			echo $view->returnContent();
		
			//get and print the image 
			$pic = new downloadedPic($src);
			printImage($pic);
			
			//get and print the info about the image
			$dal = new dal();
			$picInfo = $dal->getByFilePath($src);
			printImageInfo($picInfo);
			
		}//if src is set
	}//view 2 ends
	else if ($viewNumber == 3){
	
		//set the headings			
		$view->setContent("%heading%",$lang['header_3']);
		$view->setContent("%content%", $lang['headtag_3']);
		echo $view->returnContent();
					
		include('upload.php'); //the upload a photo view
	
	}
	else if($viewNumber == 4){
	
		//user has succesfully uploaded
		$view->setContent("%heading%", $lang['header_4']);
		$view->setContent("%content%", $lang['headtag_4']);
		echo $view->returnContent();
		
	}//which view

?>
<?php

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

		$st = '';
		
		//set the heading and content
		$view->setContent("%heading%", $lang['header_1']);
		$view->setContent("%content%", $lang['headtag_1']);
			
		
	
		
		//print a thumbnail for each image
		foreach($pics->imgList as $pic) {
		
			//printThumbnail($pic);
			//echo($pic->filePath);
			//echo'hh';
			$st = $st.returnThumbnail($pic);
			//echo(returnThumbnail($pic));
		}
				
			//echo $st;
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
			
			
			//$view->setContent("%data%", returnPrintImage($pic));
			//$view->setContent("%data%", returnPrintImageIngo($picInfo));
			$st = returnPrintImage($pic);
			$st = $st.' '.returnPrintImageIngo($picInfo);
			$view->setContent("%data%", $st);
			
			//printImageInfo($picInfo);			
			echo $view->returnContent();
			
			
		}//if src is set
	}//view 2 ends
	else if ($viewNumber == 3){
	
		
		//upload
		$view->setContent("%heading%",$lang['header_3']);
		$view->setContent("%content%", $lang['headtag_3']);
		
		
		$view->setContent("%data%", returnUploadForm($lang["fileComments"], $lang['fileUpload']));
		echo $view->returnContent();
		


					
		
	
	}
	else if($viewNumber == 4){
	
		//user has succesfully uploaded
		$view->setContent("%heading%", $lang['header_4']);
		$view->setContent("%content%", $lang['headtag_4']);
		$view->setContent("%data%", '');
		
		$view->clearData(); 
		echo $view->returnContent();
		
	}//which view

?>
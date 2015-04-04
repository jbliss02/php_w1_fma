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
	 $pics = new picCollection();
	 
	 echo('<img src="thumbView.php?img='.urlencode($pics->imgList[0]->fileName).'" />');
	 
	 
	//$pics->loadAllImages();
	//$pics->displayThumbs();
	
	 //echo(count($pics->imgList[0]));
	
	  //echo('<img src="'.$pics->imgList[0]->fileName.'" />');
	

	
	}
	
	



?>
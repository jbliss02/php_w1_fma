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
	 
	foreach($pics->imgList as $pic) {
		echo('<img src="thumbView.php?img='.urlencode($pic->fileName).'" />');
	}
	 
	 //echo('<img src="thumbView.php?img='.urlencode($pics->imgList[0]->fileName).'" />');
	 
	 


	
	}
	
	



?>
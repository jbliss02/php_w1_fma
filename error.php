<?php

	//Generic error page that is shown to the user if an error is encountered
	
	include('includes/functions.php');
	require('classes/template.php');
	include_once('config.php');
		
	$view = new template('includes/templatePage.html'); 

	//default main view
	$view->setContent("%heading%", "Error");
	
	//print detailed or generic header message, depending on the debug mode
	if($config['debugMode'] == 1){
			if(isset($_GET["errText"])){
				$view->setContent("%content%",$_GET["errText"]);
			}
			else {
			$view->setContent("%content%",'No error in url paramater');
			}
	}
	else {
		$view->setContent("%content%", "Something has gone wrong. Try to re-install, see readme.txt");
	}
	
	echo $view->returnContent();
	
?>
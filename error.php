<?php

	//Generic error page that is shown to the user if an error is encountered
	
	include('includes/functions.php');
	require('classes/template.php');
	include_once('config.php');
	require 'lang/'. $config['language'] .'.php';
		
	$view = new template('includes/templatePage.html'); 

	//default main view
	$view->setContent("%heading%", $lang['errheader']);
	
	//print detailed or generic header message, depending on the debug mode
	if($config['debugMode'] == 1){
			if(isset($_GET["errText"])){
				$view->setContent("%content%",urldecode($_GET["errText"]));
			}
			else {
			$view->setContent("%content%",$lang['paramerror']);
			}
	}
	else {
		$view->setContent("%content%", $lang['errMsg']);
	}
	
	$view->setContent("%data%", '');
	echo $view->returnContent();
	
?>
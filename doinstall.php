<?php

	//used to do a fresh install of the application

	require('classes/template.php');
	require('config.php');
	require 'lang/'. $config['language'] .'.php';
	$view = new template('includes/templatePage.html'); //set the template object
	
	require('classes/installdb.php');
	$installdb = new installdb();
	$installdb->createTables();
	
		//set the heading and content
		//if here then an error page has not been called
		//so install is ok
		
		$view->setContent("%heading%", $lang['install']);
		$view->setContent("%content%", $lang['installok']);
		$view->setContent("%data%", '');
		echo $view->returnContent();	
		
		
?>
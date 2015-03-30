<?php
	require('classes/installdb.php');
	$installdb = new installdb();
	$installdb->createTables();
?>
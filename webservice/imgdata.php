<?php

//web service that returns information about images in the database
//if no url parameter is passed in then all images are returned
//if an id is passed in then information about the image linked to that id is returned
//if an title is passed in then information about the image linked to that title is returned
//if a filepath is passed in then information about the image linked to that filepath is returned

	require('db.php');
	$picDb = new db();
	
	//create the sql string based on any parameters sent in
	$sql = "SELECT id, filePath, imageTitle, imageDescription FROM imgStore"; //start the sql string

	if(isset($_GET["id"])){
		$sql = $sql." WHERE id = '".urldecode($_GET["id"])."'";
	}
	else if (isset($_GET["title"])){
		$sql = $sql." WHERE imageTitle = '".urldecode($_GET["title"])."'";
	}
	else if (isset($_GET["path"])){
		$sql = $sql." WHERE filePath = '".urldecode($_GET["path"])."'";
	}


	//query the database		
	$ret = array(); //the return array
	$result = $picDb->conn->query($sql);
	
	if($result === false) {
		//header('location: error.php?errText='.$picDb->conn->error);
		echo 'error '.$picDb->conn->error; //let the calling app deal with any error
	}
	
	while ($row = mysqli_fetch_assoc($result)) {
		
		//populate the return object
		$obj = array();
		$obj['id'] = $row['id'];
		$obj['filePath'] = $row['filePath'];
		$obj['imageDescription'] = $row['imageDescription'];
		$obj['imageTitle'] = $row['imageTitle'];
	
		$ret[] = $obj;

	}
			
	mysqli_free_result($result);
			
	//send the JSON back		
	header('Content-type: application/json');	
	echo json_encode($ret);
			
?>
<?php

	//class which holds a collection of pic objects
	//and contains appropriate methods and properties 
	//to manage them
	
	require('classes/downLoadedPic.php');
	//require('classes/picDb.php');
	
	class picCollection{
	
		public $imgList = array();  //an array that contains downloadedPic objects !!changr to private??
		
		
		public function __construct(){
			$this->loadAllImages();
			//$this->createThumbnails();
		}
		
		public function loadAllImages(){
			//creates the imgList and its component objects from the image information in the database
			//each image class is created which sets the thumbnail images and so on
										
			$picDb = new picDb();
			$sql = "SELECT id, filePath, imageTitle, imageDescription FROM imgStore";
			
			$result = $picDb->conn->query($sql);
	
			if($result === false) {
				header('location: error.php?errText='.$picDb->conn->error);
			}
			
			while ($row = mysqli_fetch_assoc($result)) {
				
				//create a new image class and add it to the collection
				$p = new downLoadedPic($row['filePath'], $row['imageDescription'], $row['imageTitle']);
				$this->imgList[] = $p;
			}
			
			mysqli_free_result($result);
		
		}//loadAllImages
		
			public function displayThumbs(){
			//will be moved
			
				foreach($this->imgList as $val) {
					
					//header('Content-Type: image/jpeg');
					
					//echo('<img src="'.imagejpeg($val->thumbNail, NULL, 90).'" />');
					//echo('<img src="'.$val->fileName.'" />');
					//imagejpeg($val->thumbNail, NULL, 90);
					
					header('Content-Type: image/jpeg');		
					echo($val->returnThumbnail());
					
				}
				
			}//displayThumbs
			
	}//class edns



?>
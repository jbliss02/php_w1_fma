<?php

	//class which holds a collection of pic objects
	//and contains appropriate methods and properties 
	//to manage them
	
	require('classes/downLoadedPic.php');
	//require('classes/picDb.php');
	//require('classes/dal.php');
	
	class picCollection{
	
		public $imgList = array();  //an array that contains downloadedPic objects !!changr to private??
			
		public function __construct(){
			$this->loadAllImages();
		}
		
		private function loadAllImages(){
			//calls the web service for all images in the database
			//creates the imgList and its component objects 
			//each image class is created which sets the thumbnail images and so on
			
			$dal = new dal();
			$pics = $dal->getAll();
			
			foreach($pics as $pic) {
				
				$p = new downLoadedPic($pic['filePath']);
				$p->setMetaData($pic['imageDescription'], $pic['imageTitle']);
				$this->imgList[] = $p;
			
			}
		
		}//loadAllImages
		
		private function loadAllImages2(){
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
				$p = new downLoadedPic($row['filePath']);
				$p->setMetaData($row['imageDescription'], $row['imageTitle']);
				$this->imgList[] = $p;

			}
			
			mysqli_free_result($result);
		
		}//loadAllImages
		
		public function returnThumb(){
					header('Content-Type: image/jpeg');		
					//echo($this->imgList[0]->returnThumbnail());
					return $this->imgList[0]->returnThumbnail();
		}
					
	}//class edns



?>
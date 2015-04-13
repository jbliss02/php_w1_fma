<?php

	//class which holds a collection of pic objects
	//and contains appropriate methods and properties 
	//to manage them
	
	require('downloadedPic.php');
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
															
				if(file_exists($pic['filePath'])){ //check the file exists

					$p = new downLoadedPic($pic['filePath']);
					$p->setMetaData($pic['imageDescription'], $pic['imageTitle']);
					$this->imgList[] = $p;
				}
		
			}//for each picture
		
		}//loadAllImages
				
		public function returnThumb(){
					header('Content-Type: image/jpeg');		
					//echo($this->imgList[0]->returnThumbnail());
					return $this->imgList[0]->returnThumbnail();
		}
					
	}//class edns



?>
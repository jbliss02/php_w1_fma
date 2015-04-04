<?php

//a class to represent a single image, used at any point during the lifecycle of an image
//holds the information about an image and contains the necessary methods to validate
//and alter the image in line with application requirments
//is used as a base class for an image
//extended by uploadedPic or downloadedPic

class pic {
	
	public $fileName; //the filename of this image
	public $origName; //the name of the file that the user uploaded
	public $description; //description user has entered
	protected $maxsize; //maximum size the server will accept, in px
	
	public function __construct(){
	
		
	}
		
		protected function returnResizedImage($src, $width, $newWidth, $height, $newHeight){
			//resizes the image that has been sent in by re-drawing an image with the 
			//new and passed in parameters. returns new image and destroys passed in image
			
			$new = imagecreatetruecolor($newWidth, $newHeight); //create a blank canvass
			imagecopyresampled($new, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height); 
			imagedestroy($src); //delete the original loaded image
			
			return $new;
			
		}//returnResizedImage
		
		protected function returnResizedDims($width, $height, $maxsize){
			//takes a width and height and returns an array for width and height
			//based on what the max size constraints
			//dimensions may have to be reduced more than once
	
			while($width > $maxsize|| $height > $maxsize) {
			
				//amend the width and height to fit
				if($width > $maxsize){
				
					$factor = $maxsize / $width;
					$width = $maxsize;
					$height = $height * $factor;		

				}
				else {
				
					$factor = $maxsize / $height;
					$height = $maxsize;
					$width = $width * $factor;					
				}
			
			}			
			$ret = array($width,$height);
			return $ret;
			
		}//returnResizedDims
	
		public function needsResize($width, $height){
		//whether the image needs to be resized to fit the specified dimensions
		
		if($width > $this->maxsize || $height > $this->maxsize){
			return true;
		}
		else{
			return false;
		}
	}//needsResize

}//class pic 

?>
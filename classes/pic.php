<?php

//a class to represent a single image, used at any point during the lifecycle of an image
//holds the information about an image and contains the necessary methods to validate
//and alter the image in line with application requirments
//is used as a base class for an image
//extended by uploadedPic or downloadedPic

class pic {
	
	public $fileName; //the filename of this image
	private $maxsize; //maximum size the server will accept, in px
	
	public function __construct(){
	

	}


}//class pic 

?>
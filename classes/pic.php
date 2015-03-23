<?php

//a class to represent a single image, used at any point during the lifecycle of an image
//holds the information about an image and contains the necessary methods to validate
//and alter the image in line with application requirments
require('classes/picTools.php');
class pic extends picTools{

	public $tempName; //where file is saved on server after upload
	public $fileName; //where file is saved for good
	public $origSize = array(); //original height and width 
	public $imageSize = array(); //adjusted size


}//class pic 

?>
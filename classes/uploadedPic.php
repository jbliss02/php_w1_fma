<?php

//a class for an image that is being uploaded
//the base class pic contains properties and methods for an image
//this contains properties and classes specifically for an image
//being uploaded

require('classes/pic.php');
require('classes/picDb.php');

class uploadedPic extends pic {

	public $supportedFile; //whether the file uploaded is valid
	public $anyErrors; //whether the transform and validate process has worked
	public $errMsg; //details of the last error encountered
	public $origName; //the name of the file that the user uploaded
	public $description; //description user has entered
	
	private $origExt; //original extension, allows program to be more easily extended from jpeg
	private $dbId; //the incremented number from the databse to add to the image name
	private $tempName; //where file is saved on server after upload
	private $tempInfo; //info about this tempfile
	private $uploadLocation; // where to save pictures
	
	public function __construct($tempFile, $origName, $description){
		//object can only be created if a reference to a file is passed in
		//this is the temporary file that has just been uploaded to the server
		//construtor calls the methods that runs the appropriate analysis on the document
		//and sets the appropriate properties
		
		$this->anyErrors = false;
		$this->setFileNames($tempFile, $origName, $description); //set the file attributes
		
		//create the database object and get the id to append to the name
		$picDb = new picDb();
		$this->dbId = $picDb->getNextId();

		//if upload all ok then copy image to server
		//resizing if necessary
		if($this->validateUpload()){
		
			$this->createSystemName();
			$this->updateFileInfo();
			
			if($this->supportedFile){
			
				if($this->needsResize()){
				$this->resizeTempImage(); //creates a new image and saves it
				}
				else{
					$this->makePermanent(); //saves the temp image
				}
				
				$picDb->addImage($this);
				
			}//if this file is supported
			
		}//if upload ok
								
	} //constructor
	
	private function setFileNames($tempFile, $origName, $description){
		//sets the file title, description etc (original name without the .ext) and the original extension
		
		$this->tempName = $tempFile;
		$this->origExt = pathinfo($origName, PATHINFO_EXTENSION);
		$this->origName = substr(basename($origName, $this->origExt), 0, -1);		
		$this->uploadLocation = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
		$this->maxsize = 600;	
		$this->addDescription($description);
	}
	
	private function validateUpload(){
		//checks whether the file has uploaded ok, returns a boolean
		
		if(is_uploaded_file($this->tempName)){
			return true;
		}
		else {
			$this->anyErrors = true;
			$this->errMsg = 'The upload failed';
			return false;
		}
		
	}//validateUpload
	
	private function createSystemName(){
		//generates a system file name for this image
		//concatenates a time stamp the database id and the first character of the 
		//original file name
		$this->fileName = $this->uploadLocation.time().$this->dbId.$this->origName[0].".".$this->origExt;	
	}
	
	private function updateFileInfo(){
		//updates the private property that contains the file info
		//also defines whether this is a valid file and filetype
				
		$this->tempInfo = getimagesize($this->tempName);
				
		if($this->tempInfo == FALSE || $this->tempInfo[2] != IMAGETYPE_JPEG){
			$this->supportedFile = FALSE;
			$this->anyErrors = true;
		}
		else {		
			$this->supportedFile = true;
		}
		
	}//updateFileInfo

	private function makePermanent(){
		//moves the temporary file into a permanent location
		//with the generated file name
		
		if (move_uploaded_file($this->tempName, $this->fileName.'.jpg')) {	
			//echo 'upload good';
		}
		else{
			$this->anyErrors = true;
			$this->errMsg = 'The file did not upload successfully';
		}
		
	}//makePermanent
		
	private function saveImage($image){
		//saves any image passed in with the generated name
		//if the image is resized then an image is created, rather
		//than us saving the temporary file
		
		imagejpeg($image, $this->fileName.'.jpg', 80); //save the file
		imagedestroy($image); //destroy the object
	}
		
	private function needsResize(){
		//whether the image needs to be resized to fit the specified dimensions
		
		if($this->tempInfo != false && $this->tempInfo[0] <= $this->maxsize && $this->tempInfo[1] <= $this->maxsize){
			return false;
		}
		else{
			return true;
		}
	}//needsResize
		
	private function resizeTempImage(){
		//defines the new width and height so the temp image
		//can be re-drawn
		
		if($this->supportedFile){
					
			$width = $this->tempInfo[0];
			$height = $this->tempInfo[1];
			$newWidth = $this->tempInfo[0]; //will be re-set
			$newHeight = $this->tempInfo[1];//will be re-set
			
			//amend the width and height to fit
			if($width > $this->maxsize){
			
				$factor = $this->maxsize / $width;
				$newWidth = $this->maxsize;
				$newHeight = $height * $factor;				
			}
			else {
			
				$factor = $this->maxsize / $height;
				$newHeight = $this->maxsize;
				$newWidth = $width * $factor;							
			}
			
			$this->createAndSaveResizedImage($newWidth, $newHeight); //create and save the new image
								
		}//if this is a supported file
					
	} //resizeTempImage
	
	private function createAndSaveResizedImage($newWidth, $newHeight){
		//creates a new image from the temporary image, based on the
		//dimensions already passed in. Validation has already 
		//occured on the image so no need to do it again
	
		$src = imagecreatefromjpeg($this->tempName); //get the temp file
		$new = imagecreatetruecolor($newWidth, $newHeight); //create a blank canvass
		
		//copy the old picture onto the canvass with the new dimensions
		imagecopyresampled($new, $src, 0, 0, 0, 0, $newWidth, $newHeight, $this->tempInfo[0], $this->tempInfo[1]); 
		
		//$this->tempName = $new; //
		imagedestroy($src); //delete the original loaded image
		$this->saveImage($new); //save the new image
				
	}//createAndSaveResizedImage
	
	private function addDescription($description){
		//adds a description that will be associated with this image
	
		$this->description = $description;
	
	}//addDescription
	
}//class ends

?>
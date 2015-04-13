<?php
//holds the information about an image that has exists on the server and is to be 
//shown to the user on screen

	require('pic.php');

class downLoadedPic extends pic{

	public $thumbNail; //the thumbnail image that we are going to create on the fly
	private $thumbNailSize; //the max size for a thumbnail image
	private $imgSize;
	
	public function __construct($filePath){
		//class can only be built when all file information is supplied
		//constructor assigns these values to the appropriate properties
		//and creates the thumbnail image
	
		$this->fileName = $filePath;
		$this->updateInfo();
		$this->createThumbnail();
		
	}//constructor
	
	public function setMetaData($description, $imageTitle){
		//sets the description and the title
		$this->description = $description;
		$this->origName = $imageTitle;
	}
	
	public function getMetaData(){
		//gets information from the web service about the image
		
		$dal = new dal();
		$meta = $dal->getByFilePath($this->filePath);
		
	}//getMetaData
	
	public function createThumbnail(){
		//returns a thumbnail image
		
		$newDim = $this->returnResizedDims($this->imgSize[0], $this->imgSize[1], $this->thumbNailSize);
		$src = imagecreatefromjpeg($this->fileName); //get the temp file
		$this->thumbNail  = $this->returnResizedImage($src, $this->imgSize[0], $newDim[0] , $this->imgSize[1], $newDim[1] ); 
		
	}//createThumbnail
	
	public function updateInfo(){
		//updates the properties in this class related to the image
		
		$this->thumbNailSize = 50; //set the thumbnail size
		$this->imgSize = getimagesize($this->fileName);	
		
	}//updateInfo
	
	public function returnImage(){
	
		$src = imagecreatefromjpeg($this->fileName); //get the temp file
		return $src;
	
	}//returnImage

}//downLoadedPic

?>
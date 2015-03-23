<?php

//a set of tools used for loading, saving and managing images
//created to be used as a base class for pic

class picTools {

		private $uploadLocation; // where to save pictures
		private $maxsize; //maximum size the server will accept, in px
		
		public function __construct(){
			$this->uploadLocation = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
			$this->maxsize = 600;
		}
		
		public function returnRandomFileNamePath(){
			//returns a random string, based on the date
			return $this->uploadLocation.time();
		}
		
		public function isSupportedType($filename){
			//checks whether the filename+path passed in is valid for this application
			if(pathinfo($filename, PATHINFO_EXTENSION) == 'jpg'){
				return true;
			}
			else{
				return false;
			}
		}//isSupportedType
		
		public function imageSizeOk($filename){
			//whether image is the correct size or not
			
			$details = getimagesize($filename);
			if($details != false && $details[0] <= $this->maxsize){
				return true;
			}
			else{
				return false;
			}
			
		}//imageSizeOk
		
		
		
		

		
}//class picTools


?>
<?php

//a database class specifically for managing the database entry and
//query of images into the image database
require('classes/db.php');

class picDb extends db{

	private $nextId; //stores the nextId taken from imgId

	public function getNextId(){
		//gets the next id available from the database
		
		$sql = "SELECT lastId 
						FROM imgId
						ORDER BY id DESC
						LIMIT 1";
		
		$result = $this->conn->query($sql);
		
		if($result === false) {
			$this->reportError();
		}

		while ($row = mysqli_fetch_assoc($result)) {
			$this->nextId = $row['lastId'] + 1;
		}
		mysqli_free_result($result);
			
		$this->takeNextId(); //add this id into the database so it cant be re-taken
		
		return $this->nextId;
			
	}//nextId
	
	private function takeNextId(){
		//takes the id that has just been extracted
		
		$sql = "UPDATE imgId SET lastId = ".$this->nextId." WHERE id = 1;";
		$result = $this->conn->query($sql);
		
		if($result === false) { 
			$this->reportError();
		}
		
		//mysqli_free_result($result);
				
	}//takeNextId
	
	public function addImage($pic){
	
		$sql = "INSERT INTO imgStore (filePath, imageTitle, imageDescription)
					  VALUES ('".$pic->fileName."', '".$pic->origName."', '".$pic->description."');";
										
		$result = $this->conn->query($sql);
		
		if($result === false) { $this->reportError(); }		
		//mysqli_free_result($result);
	
	}//addImage
	
	private function reportError(){
		header('location: error.php?errText='.$this->conn->error);
	}


}//picDb ends

?>
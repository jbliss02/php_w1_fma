<?php

//a generic class to allow us to catch errors during methods
//and report on them, or to report on a success

class errorCheck {

	private $ok;
	private $errorMsg = array();
	private $successMsg;
	
	public function __construct(){
		$this->ok = true;
	}
	
	public function addError($errorString){
		$this->ok = false;
		array_push($this->errorMsg ,$errorString);
	}
	
	public function clearErrors($errorString){
		$this->ok = true;
		$this->errorMsg = array();
	}
	
	public function addSuccess($successString){
		$this->ok = true;
		$this->successMsg = $successString;
	}
	
	public function hasError(){
		return !$this->ok;
	}
	
	public function returnErrorMessage(){
		return $this->errorMsg[0];
	}
	
	public function returnSuccessMessage(){
		return $this->successMsg;
	}

}//class

?>
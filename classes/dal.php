<?php

//class that enables the application to query the image web service
	
class dal {

	public function getAll(){
		//gets the information about all items in the database
		
		require('config.php');
		$my_curl = $this->returnCurl($config['webService']);
		return($this->executeCurl($my_curl));
		curl_close($my_curl);
		
	}//getAll
	
	public function getByFilePath($filePath){
		//gets information about a specific item, based on the filepath
		
		require('config.php');
		$my_curl = $this->returnCurl($config['webService'].'?path='.urlencode($filePath));
		return($this->executeCurl($my_curl));
		curl_close($my_curl);
	
	}

	private function returnCurl($url){
		$my_curl = curl_init();
		curl_setopt($my_curl, CURLOPT_URL, $url);
		curl_setopt($my_curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($my_curl, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($my_curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($my_curl, CURLOPT_FAILONERROR, true);
		return $my_curl;
	}

	private function executeCurl($curl){
		
		$result = curl_exec($curl);

		// Get the error codes and messages
		if(curl_errno($curl)) {

		 $err = curl_errno($curl).' - '.curl_error($curl);	 
		 header('location: ../error.php?errText='.urlencode($err));
		 
		} 
		else {

			$data = json_decode($result, true);

			if(json_last_error() == JSON_ERROR_NONE){		
			
				return $data;
			} 
			else{
			 header('location: ../error.php?errText='.urlencode(json_last_error()));		 
			}

		 }//error or not
		
	}//executeCurl
	
}//dal

?>
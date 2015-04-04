<?php

	$my_curl = curl_init();
	$url = 'http://127.0.0.1/fma/webservice/imgdata.php';
	curl_setopt($my_curl, CURLOPT_URL, $url);
	curl_setopt($my_curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($my_curl, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($my_curl, CURLOPT_TIMEOUT, 2);
	curl_setopt($my_curl, CURLOPT_FAILONERROR, true);
	$result = curl_exec($my_curl);

	// Get the error codes and messages
	if(curl_errno($my_curl)) {
	 echo 'Code: ' . curl_errno($my_curl); 
	 echo 'Message: ' . curl_error($my_curl);
	} 
	else {

		$data = json_decode($result, true);

		if(json_last_error() == JSON_ERROR_NONE){

			echo 'JSON is good... ';
			echo($data[1]);
		} 
		else{
		
		 echo 'Something is wrong with JSON...';
		 echo 'CODE: ' . json_last_error();
		 
		}

	 }
	curl_close($my_curl);


	// $url = 'http://127.0.0.1/fma/webservice/imgdata.php';
	// $raw_data = file_get_contents($url);

	// $data = json_decode($raw_data, true);

	
	// if(json_last_error() == JSON_ERROR_NONE){

		// echo 'JSON is good... ';
	// } 
	// else{
	
	 // echo 'Something is wrong with JSON...';
	 // echo 'CODE: ' . json_last_error();
	 
	// }

?>
<?php

	//called on the post when a user has tried to upload a picture
	//validates the upload process, and the file type
	//if successful copies the file into the local server

	require('classes/errorCheck.php');
	$errorCheck = new errorCheck();

	require ('classes/uploadedPic.php');
		
	if ($_FILES['userfile']['error'] == UPLOAD_ERR_OK) {

		//create the uploaded picture object
		$pic = new uploadedPic($_FILES['userfile']['tmp_name'], basename($_FILES['userfile']['name']), $_POST['comments']);

		if($pic->anyErrors){$errorCheck->addError($pic->errMsg);}
	}
	else {
	
		$errorCheck->addError('File upload failed '.$_FILES['userfile']['error']);
				
	}//if upload error

	if($errorCheck->hasError()){
		echo $errorCheck->returnErrorMessages()[0];
	}

?>
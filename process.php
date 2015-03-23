<?php

	//called on the post when a user has tried to upload a picture
	//validates the upload process, and the file type
	//if successful copies the file into the local server

	require('classes/errorCheck.php');
	$errorCheck = new errorCheck();
	
	require ('classes/pic.php');
	$pic = new pic();
	
	if ($_FILES['userfile']['error'] == UPLOAD_ERR_OK) {
	
		if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		
			$pic->tempName = $_FILES['userfile']['tmp_name']; //temp name of uploaded file
		
			//$tmpname = $_FILES['userfile']['tmp_name']; //temp name of uploaded file
			
			//get the uploaded name, choose a name we will use on our server
			$upfilename = basename($_FILES['userfile']['name']);
			$newname = $pic->returnRandomFileNamePath().'_'.$upfilename;
			
			//check this file type is supported
			if($pic->isSupportedType($upfilename)){
			
				
				//check the file size is within limits
				//if($pic->imageSizeOk($tmpname)){
				if($pic->imageSizeOk($pic->tempName)){
					echo'ok';
				}
				else {
					echo'wrong';
				}//check the size
			
				//move the file
				if (move_uploaded_file($tmpname, $newname)) {		 	 
					$errorCheck->addSuccess('File uploaded successfully');
					echo('all good');
				}
				else  {
					$errorCheck->addError('File upload failed');
				}
			}
			else{
			
				$errorCheck->addError('This type of file is not supported');				
			}
		}
		else{ //upload not ok
		
			$errorCheck->addError('File upload failed, try again');
			
		}//upload ok or not
	}//any error message
	
	else {
	
				$errorCheck->addError('File upload failed '.$_FILES['userfile']['error']);
				
	}//if upload error

	echo $errorCheck->hasError();
	
	
?>
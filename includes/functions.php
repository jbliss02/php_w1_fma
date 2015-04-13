<?php

	function returnThumbnail($pic){
	
			$src = 'thumbView.php?img='.urlencode($pic->fileName);
			
			$st = '<div class ="thumb">';
			$st = $st.'<a href="index.php?view=2&amp; src='.urlencode($pic->fileName).'">';
			$st = $st.'<img src="'.$src.'" alt="image"/>';
			$st = $st.'</a>';
			$st = $st.'<p>'.$pic->origName.'</p>';
			$st = $st.'</div>';
	
			return $st;
	
	}

	 // function printThumbnail($pic){

			// $src = 'thumbView.php?img='.urlencode($pic->fileName);
		
			// echo('<div class ="thumb">');
			// echo('<a href="index.php?view=2&src='.urlencode($pic->fileName).'">');
			// echo('<img src="'.$src.'" />');
			// echo('</a>');
			// echo('<p>'.$pic->origName.'</p>');
			// echo('</div>');
				
		// }//printThumbnail
	
		// function printImage($pic){
					
			// $src = 'picView.php?img='.urlencode($pic->fileName);
		
			// echo('<div class ="pic">');
			// echo('<p>'.$pic->origName.'</p>');
			// echo('<a href="index.php?view=1">');
			// echo('<img src="'.$src.'" />');
			// echo('</a>');
			// echo('<p>'.$pic->origName.'</p>');
			// echo('<p>'.$pic->description.'</p>');
			// echo('</div>');
		
		// }
		
		function returnPrintImage($pic){
		
			$src = 'picView.php?img='.urlencode($pic->fileName);
		
			$st = '<div class ="pic">';
			$st = $st.'<p>'.$pic->origName.'</p>';
			$st = $st.'<a href="index.php?view=1">';
			$st = $st.'<img src="'.$src.'"alt="image"/>';
			$st = $st.'</a>';
			$st = $st.'<p>'.$pic->origName.'</p>';
			$st = $st.'<p>'.$pic->description.'</p>';
			$st = $st.'</div>';
			
			return $st;
		}
		
		// function printImageInfo($picInfo){
		
			// echo('<div class ="picInfo">');
			// echo('<h2>'.$picInfo[0]['imageTitle'].'</h2>');
			// echo('<p>'.$picInfo[0]['imageDescription'].'</p>');
			// echo('</div>');
		// }
		
		function returnPrintImageIngo($picInfo){
		
			$st='<div class ="picInfo">';
			$st = $st.'<h2>'.$picInfo[0]['imageTitle'].'</h2>';
			$st = $st.'<p>'.$picInfo[0]['imageDescription'].'</p>';
			$st = $st.'</div>';
			
			return $st;
			
		}
		
		function returnUploadForm($fileComments, $fileUpload){
		
			$st = '<form enctype="multipart/form-data" action="process.php" method="post">';
			$st = $st.'<fieldset><input name="userfile" type="file" /></fieldset>';
			$st = $st.'<fieldset><label>'.$fileComments.' </label>';
			$st = $st.'<input type ="text" name="comments" id="comments" /></fieldset>';
			$st = $st.'<fieldset><input type="submit" value="'.$fileUpload.'" /></fieldset>';
			$st = $st.'</form>';
			
			return $st;
		
		}
		
?>
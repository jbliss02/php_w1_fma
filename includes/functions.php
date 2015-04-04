<?php

	 function printThumbnail($pic){

			$src = 'thumbView.php?img='.urlencode($pic->fileName);
		
			echo('<div class ="thumb">');
			echo('<a href="index.php?view=2&src='.urlencode($pic->fileName).'">');
			echo('<img src="'.$src.'" />');
			echo('</a>');
			echo('<p>'.$pic->origName.'</p>');
			echo('</div>');
				
		}//printThumbnail
	
		function printImage($pic){
					
			$src = 'picView.php?img='.urlencode($pic->fileName);
		
			echo('<div class ="pic">');
			echo('<p>'.$pic->origName.'</p>');
			echo('<a href="index.php?view=1">');
			echo('<img src="'.$src.'" />');
			echo('</a>');
			echo('<p>'.$pic->origName.'</p>');
			echo('<p>'.$pic->description.'</p>');
			echo('</div>');
		
		}
		
		function printImageInfo($picInfo){
		
			echo('<h2>'.$picInfo[0]['imageTitle'].'</h2>');
			echo('<p>'.$picInfo[0]['imageDescription'].'</p>');
		}
		
?>
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
	
		function printImage($src, $title, $lnk, $description){
		}
		
		function returnLink($lnk){
		
			
			
		}

?>
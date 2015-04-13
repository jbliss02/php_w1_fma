<?php
	require 'config.php';
	require 'lang/'. $config['language'] .'.php';
?>

<html>

 <body>
		<div id="form">
			<form enctype="multipart/form-data" action="process.php" method="post">
				 <fieldset><input name="userfile" type="file" /></fieldset>
				 <fieldset><label><?php echo $lang['fileComments'] ?></label>
				 <input type ="text" name="comments" id="comments" /></fieldset>
				 <fieldset><input type="submit" value="<?php echo $lang['fileUpload'] ?>" /></fieldset>
			</form>
		</div>
	 </body>
</html>



<?php
	require 'lang/'. $config['language'] .'.php';
?>

<form enctype="multipart/form-data" action="process.php" method="post">
 <input name="userfile" type="file" /><br /><br />
 <label><?php echo $lang['fileComments'] ?></label>
 <input type ="text" name="comments" id="comments" /><br /><br />
 <input type="submit" value="<?php echo $lang['fileUpload'] ?>" />
</form>



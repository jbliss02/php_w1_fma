<?php
	include_once('includes/functions.php');
	$name = randomFileName();
	echo'<p>'.$name.'</p>';

?>

<form enctype="multipart/form-data" action="process.php" method="post">

 <label>Upload this file:</label>
 <input name="userfile" type="file" />

 <input type="submit" value="Send File" />
</form>



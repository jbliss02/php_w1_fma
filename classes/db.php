<?php 

	//database class that contains all methods and properties required to access and 
	//update information in the database
	//inherits mysql base class
				
	class db extends mysqli 
	{
		public $conn; //the live connection
	
		public function __construct(){

			include('config.php');
		
			$this->conn = mysqli_connect($config['server'],$config['username'],$config['password'],$config['database']);
		
			//if error and not debug mode then show the error page
			if (mysqli_connect_errno()){
				header('location: error.php?errText='.mysqli_connect_error());
			}
			
		}//__construct
		

		
	}//db class ends

?>
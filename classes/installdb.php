<?php
	//class which contains all the methods and properties required to
	//set up the database tables and data for jbliss02_tma project
	//this is used when the user fresh installs the application sp
	//any existing tables are dropped and any data is lost
	
  require('classes/db.php');
	
	class installdb extends db{
	
		public function createTables() {
		
			echo 'Setting up databse';
			$sql = $this->returnCreateSql();
			
			for($i = 0; $i < count($sql); $i++){
			
				$result = $this->conn->query($sql[$i]);
				
				if($result === false)
				{
					header('location: error.php?errText='.$this->conn->error);
				}
				else
				{
					echo '<p>Database update '.($i + 1).' of '.count($sql).' successful</p>';
				}
			
			}//for each sql statement
			
		}//createTables()

		private function returnCreateSql(){
		
			$ret[0] = "DROP TABLE `imgStore`";
					
			$ret[1] =  "CREATE TABLE `imgStore` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`filePath` varchar(255) NOT NULL,
				`imageTitle` varchar(255) NOT NULL,
				`imageDescription` varchar(255),
				PRIMARY KEY (`id`));";
				
			$ret[2] = "DROP TABLE `imgId`";
			
			$ret[3] = "CREATE TABLE `imgId` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`lastId` int(11) NOT NULL,
				PRIMARY KEY (`id`));";
				
			$ret[4] = "INSERT INTO imgId (lastId) VALUES (0)";
			
			return $ret;
		
		}
	
	}//class ends
	


?>
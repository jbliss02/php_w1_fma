<?php

	//class that manages publishing template files
	//holds a reference to the template file and amends
	//the variable elements within that file
	
	class template {
	
		private $templateFile;
		private $content = array(); //array that holds content to be replaced in the template file
		
		public function __construct($fileName){	
			$this->templateFile = $fileName;
		}//constructor ends
		
		
		//sets the content array with content specific for this object
		public function setContent($key, $value){	
			$this->content[$key] = $value;	
		}
		
		public function returnContent() {
			
			if($this->templateFile === null){
				return "File reference is null"; //change this to a error file template
			}
			
			$content = file_get_contents($this->templateFile);
			
			//set the content
			foreach($this->content as $key => $value){

					$content = str_replace($key, $value, $content);
			
			}//for each bit of customised content
				
			return $content;
			
		}//returnContent()
	
	}//template class ends
	
?>
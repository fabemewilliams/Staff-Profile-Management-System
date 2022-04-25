<?php
// used to connect to the database
		
		$db_host = "localhost";
		$db_username = "root";
		$db_password = ""; //make it blank "" if phpmyadmin does not require password
		$db_name = "staff_profile";
		 
		/*try {
			$con = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_username, $db_password);
		}
		 
		// show error
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
		
		public function open_connection(){
			$this->con = null;
			
			try {
			$this->con = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_username, $this->db_password);
			
			}
			// show error
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}
			return $this->con;
	}

}*/

?>
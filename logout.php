<?php
	session_start();

	if((!isset($_SESSION['username']) && !isset($_SESSION['password']))) {

		if(!isset($_SESSION['acc_type'])){
				header('Location: index.php?paka');
			}
			exit();
	}
	else{

		$acctype = $_SESSION['acc_type']; 
		$acc_directory = $_SESSION['acc_directory'];
				switch($acctype){
				case $acctype:
					header("Location: $acc_directory");
					break;
				
				default: {
				//logout this person
						session_start();
						$_SESSION = array();
						if(isset($_COOKIE[session_name()]))
						{
							setcookie(session_name(),'',time()-60*60*24*365,'/');
						}
							session_destroy();
							header('Location: index.php?paka=retry');
					}

			}

	}


?>
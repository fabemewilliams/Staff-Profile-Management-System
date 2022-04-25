<?php 
//This is the main switching page it is also used to logout
require("ALPHA_authenticate.php"); 

$user = $_SESSION['username'];
$user_id = $_SESSION['id'];
$acctype = $_SESSION['acc_type'];
$acctype_des = $_SESSION['acc_type_des'];
$acc_directory = $_SESSION['acc_directory'];
switch($acctype){
	case $acctype:
		header("Location: ../$acc_directory");
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
		header('Location: ../logout.php?paka=retry');
		}

}

?>
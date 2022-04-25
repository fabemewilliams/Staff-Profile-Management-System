<?php
session_start();
if((!isset($_SESSION['username']) && !isset($_SESSION['password']))) {

if(!isset($_SESSION['acc_type'])){
		header('Location: ../logout.php?paka');
}
exit();
}

?>
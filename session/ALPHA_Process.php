<?php
class SESSION_CONNECT{
//MODIFY THESE VALUES
	 var $db_host = "localhost";
		var $db_username = "root";
		var $db_password = ""; //make it blank "" if phpmyadmin does not require password
		var $db_name = "staff_profile";
	
//DO NOT TOUCH THIS POINT
	var $connection; private $result;
	
	public function __construct(){
		try {
			$this->connection = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_username, $this->db_password);
			
		}
		// show error
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
		return $this->connection;
	}
	
	
	public function close_connection(){
		if(isset($this->connection)){
		$this->connection = NULL;
		//unset($this->con);
		}
	}
	
	public function just_notify($msg,$mode=1){
		if($mode==1){
		$msg = "    
		<div class='alert alert-success fade in out'>
		<a href='#' class='close' data-dismiss='alert'>&times;</a>
        $msg
		</div>";
			}
		else{
		$msg = "<div class='alert alert-danger fade in out'>
		<a href='#' class='close' data-dismiss='alert'>&times;</a>
        $msg 
		</div>";

		}
		return $msg;
	}
	
	public function goto_notify($addr="", $msg=""){
				if($addr!="" && $msg !=""){
				$addr = ($addr==1)? "javascript:history.back(1)":$addr;
				echo "
				<script>
				alert(\"$msg\");
				window.location = \"$addr\";
				</script>
				";
				}elseif($addr!=""){
				$addr = ($addr==1)? "javascript:history.back(1)":$addr;
				echo "
				<script>
				window.location = \"$addr\";
				</script>
				";
				}
				else{
				echo "
				<script>
				alert(\"$msg\");
				</script>
				";
				}
			exit();
			}
		
	public function get_this_data($targetfield,$fromtable,$sourcefield,$keyword){
	try{
			$data = "";
			$sql = "SELECT $targetfield FROM $fromtable WHERE $sourcefield = :sourcefield LIMIT 1";
			$stmt = $this->connection->prepare($sql);
			$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$data = ucwords($row[$targetfield]); 	
			}  
			return $data;
	}
	catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
	}		
	
	}
	
	public function wordify($word,$type=0){
		if($type==0) return htmlspecialchars(trim($word));
		else return htmlspecialchars(trim($word));
	}	
		
	public function printify($word,$type=0){
		if($type==0) return trim(ucwords(stripslashes(strtolower($word))));
		else return trim(stripslashes($word));
	}

	public function Login(){
		try{
		$count=0;
		session_start();
		//Check Already Logged???
		if(isset($_SESSION['usueboid'])){
		$_SESSION = array();
		if(isset($_COOKIE[session_name()]))
		{
		setcookie(session_name(),'',time()-60*60*24*365,'/');
		}
		session_destroy();
		header('Location: ../login.php?paka=jk45j345gj34g5j3g5345gkj4s');
		}
		if(!empty($_POST['username']) && !empty($_POST['passwrd'])) {
			$username = strtolower($this->wordify(stripslashes($_POST['username'])));
			//$username = $this->connection->real_escape_string(stripslashes($_POST['username']));
			$password = SHA1($_POST['passwrd']);
			
			$sql = "SELECT * FROM sp_users WHERE `username` = ? AND `password` = ?  LIMIT 1";
				$stmt = $this->connection->prepare($sql);
				$stmt->bindParam(1, $username);
				$stmt->bindParam(2, $password);
			
			if(!$stmt->execute())
				{
					die('Encountered an error while Trying to Login you in,please try again later ');
				}

		//Fetch Details of valid user
		while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
			$id 				= 	(int)$row['id'];
			$username 			= 	$this->printify($row['username']);
			$staff_id 			=  	$this->printify($row['staff_id']);
			$staff_code 		=  	$this->printify($row['staff_code']);
			$pwd 				= 	md5(SHA1($row['password']));
			$emcactive 			= 	(int)$row['active'];
			$acc_type 			= 	(int)$row['account_type'];
			$acc_type_des		= 	strtolower($this->get_this_data("category","sp_user_category","id",(int)$row['account_type']));
			$acc_directory 		= 	strtolower($this->get_this_data("user_directory","sp_user_directory","user_category_id",(int)$acc_type));
			$academic_session 	= 	$this->get_this_data("id","sp_academic_session","active",1);
			
			$count+=1;
			}		  
		if ($count>=1){
			session_start();
			if (isset($_POST['rememberme'])) {
				//COMBINE SESSION WITH COOKIE
			} else {
            /* Session expires after browser is closed */
				$_SESSION['id'] = $id;
				$_SESSION['username'] = $username;
				
				$_SESSION['staff_ID'] = $staff_ID;
				$_SESSION['staff_code'] = $staff_code;
				$_SESSION['password'] = md5($pwd);
				$_SESSION['emcactive'] = $emcactive;
				$_SESSION['acc_type'] = $acc_type;
				$_SESSION['acc_type_des'] = $acc_type_des;
				$_SESSION['acc_directory'] = $acc_directory;//$_SESSION['usuebosect'] = $sect;
				//$_SESSION['ftimer'] = $oldpass;	
				
				if(isset($_COOKIE["usertry"]))setcookie("usertry",$_COOKIE["usertry"], time()-60*60*24*356);
				}
			//Indicate Online Status	
			//$online_user = "UPDATE users SET online = 1, last_access = now() WHERE username='$usrid'";
			//$this->connection->query($online_user);
			header('Location: ALPHA_berekonwari.php');
        
		} else{
				
				$_SESSION['noaccountfound'] = 3;
				
				$_COOKIE["usertry"]++; 
				setcookie("usertry",$_COOKIE["usertry"], time()+60*60*1); //cookie that will block user from guessing password; will expire only after 1hour
				header('location: ../login.php?paka=invalid');
				}
		}else{
			header('Location: ../login.php?paka=jk45j345gj34g5j3g5345gkj4s');
			}
		}
		catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}
	}
	
	public function startAlpha($postedfname,$postedlname){
		if(((int)$postedfname !=0 ) || ((int)$postedlname !=0)){
		echo "
			<script>
			alert('Entered Name is Not Acceptable');
			window.location = 'javascript:history.back(1)';
			</script>
			";exit();
		}
	}
	
		
	public function testlength($val, $string, $length){
		if(strlen($val) < $length ){ 
			echo "<script>
					alert('$string is too short to be Valid');
					window.location = 'javascript:history.back(1)';
					</script>
					";
			exit();
		}
	}
	
	public function testshort($UserID,$Name){
			$seeshort = compact("UserID","Name");
			foreach($seeshort as $k => $v){
				if(strlen($v) <3 ){ 
				echo "
					<script>
					alert('$k is too short to be Valid');
					window.location = 'javascript:history.back(1)';
					</script>
					";exit();
				}
			}
	}//End of Testshort Function
	
	
	public function SHA($pd){
		$pd = SHA1(substr($_POST['username'],-3).$pd);	return $pd;
	}
	
	public function logout(){
		$logout = (int)$_GET['paka'];
		$usrid = isset($_SESSION['usueboid'])? stripslashes($_SESSION['usueboid']) : 0;
		session_start();
		$_SESSION = array();
		if(isset($_COOKIE[session_name()]))
		{
		setcookie(session_name(),'',time()-60*60*24*365,'/');
		}
		session_destroy();
		
		if($logout==1){
		header("location:../logout.php");
		exit();
		}else{header('Location:../logout.php');}
		exit();		
	}
	
	public function test_here($txt="", $mode=0){
			if($mode!=0){
			echo "
			<script>
			alert(\"$txt\");
			</script>
			";
			}
			else{ echo "$txt"; }
			exit();
	}
	
	

}//END of CLASS
$SESSCON = new SESSION_CONNECT;

	
	if(isset($_POST['adv_login'])){
		if(!empty($_POST['username']) && !empty($_POST['passwrd'])){
			
			$SESSCON->Login();	
			$SESSCON->close_connection();
			
		}
		
		else{
		
		header('location: ../logout.php?paka=invalid');
		}
	}elseif(isset($_POST['submitregform']))
		{
		$SESSCON->CreateNewUser();
		}
	elseif(isset($_POST['jambsignup']))
		{
		$SESSCON->registeruser();
		}		
	elseif(isset($_GET['paka']))
		{
		$SESSCON->logout();
		}
	elseif(!defined('MyInc')){
		require("ALPHA_authenticate.php"); 
		}

?>
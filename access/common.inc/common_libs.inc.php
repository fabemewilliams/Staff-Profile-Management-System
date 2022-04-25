<?php

require("db_libs.php");

class CommonInc{
		var $con;
		private $result;
		public $msgid, $sender_id, $reciever_id, $msg_subject, $msg_status, $date_sent, $date_read, $sess_id;
		public $unread_msgs;
		
	public function __construct(){
		global  $db_host,$db_name, $db_username, $db_password;
		try {
			$this->con = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_username, $db_password);
		}
		// show error
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
		return $this->con;
	}
	
	public function close_connection(){
		if(isset($this->con)){
		$this->con = NULL;
		//unset($this->con);
		}
	}
	
	//GENERAL FUNCTIONS STARTS HERE
	
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
	
	public function just_notify($msg,$mode=1){
		if($mode==1){
		$msg = "    
		<div class='alert alert-success fade in out'>
		<a href='#' class='close' data-dismiss='alert'>&times;</a>
        $msg
		</div>";
			}
		else{
		$msg = "<div class='alert alert-danger fade in out text-center'>
		<a href='#' class='close' data-dismiss='alert'>&times;</a>
        $msg 
		</div>";

		}
		return $msg;
	}
	
	public function just_close_notify($msg,$mode=1){
		if($mode==1){
		$msg = "    
		<div class='alert alert-success fade in out'>
		<a href='#' class='close' data-dismiss='alert'></a>
        $msg
		</div>";
			}
		else{
		$msg = "<div class='alert alert-danger fade in out'>
		<a href='#' class='close' data-dismiss='alert'></a>
        $msg 
		</div>";

		}
		return $msg;
	}
	
	public function test_form($strict=0){
	$exception = array("qualific","contaddr","kinaddress");
	$pattern = ($strict==1)?"/[^A-Za-z0-9\ \_]/":"/[^A-Za-z0-9\ \.\,\;\_\-\+\'\&\@\/]/";
		foreach($_POST as $k => $v){
		if(in_array($k,$exception)){continue;}
		if(is_array($v)){
			foreach($v as $i => $j){
			if(preg_match($pattern, $j)){
			$this->goto_notify(1,"$j Contains Invalid Characters");
			}
			}
		}
		else{
			if(preg_match($pattern, $v)){
			$this->goto_notify(1,"$k Contains Invalid Characters");
			}
			}
		}
	}
	
	public function test_array($assoc_array){
		foreach($assoc_array as $k => $v){
		if(is_array($v)){
			foreach($v as $i => $j){
			echo "$k=> $i  =  $j <br>";
			}
		}else{
		echo "$k  =  $v <br>";
		}
		exit();
		}
	}
	
	public function test_post(){
		foreach($_POST as $k => $v){
		if(is_array($v)){
			foreach($v as $i => $j){
			echo "$k=> $i  =  $j <br>";
			}
		}else{
		echo "$k  =  $v <br>";
		}
		}
		exit();
	}
	
	public function test_user_exist($id){
		if($this->get_this_data("username","exam_users","username",$id)==""){
				return $this->just_notify("Staff Number not found. Add this staff before granting access to the system",2);
		}	
	}
	
	public function printifyhtml($word,$type=0){
		if($type==0) return ucwords(stripslashes(strtolower($this->convert_RN(htmlspecialchars_decode(trim($word))))));
		else return stripslashes($this->convert_RN(htmlspecialchars_decode(trim($word))));
	}
	
	public function convert_RN($str){
	$str = nl2br($str);
	//This Function Converts all newlines in string written in \n\r to <br/>
	$order   = array("\\r\\n", "\\r", "\\n","<script","</script>","<?","?>");
	$replace = "";
	// Processes \r\n's first so they aren't converted twice.
	$newstr = str_replace($order, $replace, $str);
	return $newstr;
	}
	
	public function wordify($word,$type=0){
		if($type==0) return htmlspecialchars(trim($word));
		else if($type==5){//FOR ABBREVIATIONS
			return htmlspecialchars(trim(strtoupper($word)));
		} 
		else if($type==1){//FOR ABBREVIATIONS
			return htmlspecialchars(trim($word));
		} 
		else return htmlspecialchars(trim(ucwords(strtolower($word))));
	}	
	
	public function printify($word,$type=0){
		if($type==0) return trim(ucwords(stripslashes(strtolower($word))));
		if($type==5){//FOR ABBREVIATIONS
			return html_entity_decode(trim(stripslashes(strtoupper($word))));
		} 
		else return trim(stripslashes($word));
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

	public function goto_notify_with_close($addr="", $msg=""){
		if($addr!="" && $msg !=""){
		$addr = ($addr==1)? "javascript:history.back(1)":$addr;
		echo "
		<script>
		alert(\"$msg\");
		window.location = \"$addr\";window.close();
		</script>
		";
		}elseif($addr!=""){
		$addr = ($addr==1)? "javascript:history.back(1)":$addr;
		echo "
		<script>
		window.location = \"$addr\";window.close();
		</script>
		";
		}
		else{
		echo "
		<script>
		alert(\"$msg\");window.close();
		</script>
		";
		}
		exit();
	}

	//PUBLIC FUNCTION TO CHANGE USER PASSWORD
	public function reset_user_password($sess_id){
		try{
			
			$password		=	SHA1($_POST['newPassword']);
			$cpassword		=	SHA1($_POST['cNewPassword']);
			$username		=	$sess_id;
			
			if($password != $cpassword){
				return	$this->just_notify('Your passwords do not match. Check and try again.',2);
			}
			if($password == $cpassword){
				
				$query = 	"UPDATE sp_users
							SET `password` = :password
							WHERE id = :username
							";
				
				// prepare query for execution
				$stmt = $this->con->prepare($query);
				$stmt->bindParam(':password', $password);	
				$stmt->bindParam(':username', $username);	
				
				if(!$stmt->execute()){
					return $this->just_notify("There was an error performing this operation!",2);
				}
				else{
					return $this->goto_notify("./index.php?paka=1","You have successfull changed!.");
				}
			}
		
			
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		

	}
	
	
	public function get_this_data($targetfield,$fromtable,$sourcefield,$keyword){
	try{
			$data = "";
			$sql = "SELECT $targetfield FROM $fromtable WHERE $sourcefield = :sourcefield LIMIT 1";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$data = $row[$targetfield]; 	
			}  
			return $data;
	}
	catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
	}		
	
	}
	
	public function get_data_with_condition($targetfield,$fromtable,$condition){
	try{
			$data = "";
			$sql = "SELECT $targetfield FROM $fromtable WHERE $condition LIMIT 1";
			//echo $sql;exit();
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			//$stmt->execute();
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
	
	public function get_two_data($targetfield,$fromtable,$sourcefield,$keyword,$sourcefield2, $keyword2){
	$data = "";
	$sql = "SELECT $targetfield FROM $fromtable WHERE $sourcefield = '$keyword' AND $sourcefield2 = '$keyword2' LIMIT 1";
	if(!$result = $this->con->query($sql))
	{
	$this->goto_notify(1,'Error while fetching data '.$this->con->error);
	}
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
	$data = ucwords($row[$targetfield]);	
	}
	return $data;
	}
	
	public function get_three_data($targetfield,$fromtable,$sourcefield,$keyword,$sourcefield2, $keyword2,$sourcefield3, $keyword3){
	$data = "";
	$sql = "SELECT $targetfield FROM $fromtable WHERE $sourcefield = '$keyword' AND $sourcefield2 = '$keyword2' AND $sourcefield3 = '$keyword3' LIMIT 1";
	if(!$result = $this->con->query($sql))
	{
	$this->goto_notify(1,'Error while fetching data '.$this->con->error);
	}
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
	$data = ucwords($row[$targetfield]);	
	}
	return $data;
	}
	
	public function modal_notify($heading,$message){
			echo "<div class='modal fade' id='memberModal' tabindex='-1' role='dialog' aria-labelledby='memberModalLabel' aria-hidden='true'>
					<div class='modal-dialog'>
						<div class='modal-content'>
								<div class='modal-header'>
									<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
										<h4 class='modal-title' id='memberModalLabel'>$heading</h4>
								</div>
								<div class='modal-body'>
										<p>$message</p>
								</div>
								<div class='modal-footer'>
										<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button>
								</div>
						</div>
					 </div>
				</div>";
	}
 
	public function show_pagination($thesql,$total,$numofPages,$perPage,$startAt,$pageNo,$prev,$next){
		echo "  <div>
		<ul class='pagination'>";
		echo "
		<li><a href='?p=1&q=$perPage&all=1'>Show All</a></li>
		";
		if($pageNo > 1){

		echo "<li>
		  <a href='?p=$prev&q=$perPage'' aria-label='Previous'>
			<span aria-hidden='true'>&laquo;</span>
		  </a>
		</li>
		";	
		}
		$i = ($pageNo-5>0)?$pageNo-5:1;

		for(;$i<$numofPages;$i++){
		if($i < ($pageNo+10) && $i < ($pageNo+5)){

		echo "<li><a href='?p=$i&q=$perPage'>$i</a></li>";
		}
		if($i > ($pageNo+10) && $i < ($pageNo+20)){
		echo ".";
		}
		else{echo "";}
		}
		if($pageNo <  $numofPages){
		echo "<li><a href='?p=$numofPages&q=$perPage'>$numofPages</a></li>
		<li><a href='?p=$numofPages&q=$perPage'>Last</a></li>
		<li><a href='?p=$next&q=$perPage'>Next</a></li>
		<li>
		<a href='#' aria-label='Next'>
        <span aria-hidden='true'>&raquo;</span>
      </a>
    </li>
  </ul>
	</div>		
		";
		}		
	}/*End of showPagination Function*/
	
	public function paginator($thesql,&$total,&$numofPages,&$perPage,&$startAt,&$pageNo,&$prev,&$next){
	$total 	= (int)$this->count_sql($thesql);
	$total = ($total<=0)?1:$total;
	$perPage = (isset($_GET['q']) && $perPage == NULL)?(int)$_GET['q']:$perPage;
	$perPage = ($perPage<1)?50:$perPage; // use default 50 perPage
	$perPage = isset($_GET['all'])?$total:$perPage;
	$pageNo = isset($_GET['p'])?(int)$_GET['p']:1;
	$prev = $pageNo-1;
	$next = $pageNo+1;
	$numofPages = ceil($total/$perPage);
	$startAt = $perPage*($pageNo-1);

	if($pageNo < 1){
	$startAt = 0; $pageNo = 1;
	}elseif($pageNo > $numofPages){
	$pageNo = $startAt = $numofPages;
	}
	
	}
	
	public function count_sql($sqltocount){
	try{
			$result="";
			if($sqltocount != ""){
			$sql = "SELECT COUNT(*) " . $sqltocount;
			$result = $this->con->prepare($sql);
			$result->execute();
			$row = $result->fetchColumn();
			return $row;
			}
		}catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
 
	public function concat_two_fields($targetfield1,$targetfield2,$fromtable,$sourcefield,$keyword){
	try{
			$data = "";
			$sql = "SELECT CONCAT($targetfield1, ' ', $targetfield2) FROM $fromtable WHERE $sourcefield = :sourcefield LIMIT 1";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$row = $stmt->fetchColumn();
			return $row;
			
	}
	catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
	}		
	
}
	
	public function update_this_data($table,$updatefield,$updatevalue,$sourcefield,$keyword){
			try{
					$data = "";
					$sql = "UPDATE $table SET `$updatefield` = :updatefield WHERE `$sourcefield`= :sourcefield";
					
					$stmt = $this->con->prepare($sql);
					$stmt->bindParam(':updatefield', $this->wordify($updatefield));
					$stmt->bindParam(':sourcefield', $this->wordify($sourcefield));
					if($stmt->execute()){
						return $this->just_notify("passed ",2);
					}
					else{
						return $this->just_notify("failed ");
					}
					
				}
				catch(PDOException $exception){
						echo "Connection error: " . $exception->getMessage();
				}
	}
	
	public function update_two_data($table,$targetfield,$targetvalue,$targetfield2,$targetvalue2,$sourcefield,$keyword){
			$data = "";
			$sql = "UPDATE $table SET $targetfield  = '$targetvalue', 
			$targetfield2 = '$targetvalue2' WHERE $sourcefield ='$keyword'";
			if(!$result = $this->con->query($sql))
			{
			$this->goto_notify(1,'Error while updating data '.$this->con->error);
			}
			else{
			$this->goto_notify(1,'UPDATE SUCCESFUL '.$this->con->error);
		}
	}
	
	public function br2newline( $input ) {
		 $out = str_replace( "<br>", "\n", $input );
		 $out = str_replace( "<br/>", "\n", $out );
		 $out = str_replace( "<br />", "\n", $out );
		 $out = str_replace( "<BR>", "\n", $out );
		 $out = str_replace( "<BR/>", "\n", $out );
		 $out = str_replace( "<BR />", "\n", $out );
		 $out = str_replace( "rn", "<br>", $out );
		 $out = str_replace( "\r\n", "<br>", $out );
		 return $out;
	}
	
	public function quotes_replace($input) {
		 $out = str_replace( '"', "'", $input );
		 $out = str_replace( '&ldquo;', "&lsquo;", $input );
		 $out = str_replace( '&rdquo;', "&rsquo;", $input );
		 //$out = str_replace( '"', "'", $input );
		 return $out;
	}
	
	//FUNCTION TO ENTER LOG INFORMATION
	public function enter_log($sess_id, $action){
		try{$query = 	"insert into ams_log SET who = :who, did_what = :did_what, 
			date = :date, time = :time";
			$action_date = date("Y-m-d");
			$action_time = date("h:i:s");		
			// prepare query for execution
			$stmt = $this->con->prepare($query);
			$stmt->bindParam(':who', $sess_id);		
			$stmt->bindParam(':did_what', $action);		
			$stmt->bindParam(':date', $action_date);		
			$stmt->bindParam(':time', $action_time);		
			
			if(!$stmt->execute()){
				return $this->just_notify("Oops! There's an error ",2);
			}
			else{
				//return $this->just_notify("Log saved",1);
			}	
		}
		catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}
	}

	//FUNCTION TO EXTRACT FACULTY
	public function extract_user_type(){
		try{  
			$sql = "SELECT * FROM ams_user_category WHERE 1";
			$stmt = $this->con->prepare($sql);
			
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]						=	(int)$row['id'];
				$user_type[]			=	$this->printify($row['category_name']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$user_type[$i]</option>";
				}
			}			

		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	//FUNCTION TO EXTRACT FACULTY
	public function extract_title(){
		try{  
			$sql = "SELECT * FROM sp_title WHERE 1 ORDER BY id ASC";
			$stmt = $this->con->prepare($sql);
			
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]					=	(int)$row['id'];
				$title_name[]			=	$this->printify($row['title_name']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$title_name[$i]</option>";
				}
			}			

		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	//FUNCTION TO EXTRACT FACULTY
	public function extract_faculty(){
		try{
			$sql = "SELECT * FROM ams_faculty WHERE 1";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]					=	(int)$row['id'];
				$faculty[]				=	$this->printify($row['faculty'],1);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$faculty[$i]</option>";
				}
			}			

		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	
	//FUNCTION TO EXTRACT FACULTY
	public function extract_country(){
		try{
			$sql = "SELECT * FROM ae6_country WHERE 1";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]						=	(int)$row['id'];
				$country[]				=	$this->wordify($row['country']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$country[$i]</option>";
				}
			}			

		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	public function extract_fo_programmes($faculty_id){
		
		try{
			$sql ="SELECT * FROM `ams_programme` WHERE faculty_id =  $faculty_id";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]						=	(int)$row['id'];
				$programme_name[]			=	$this->wordify($row['programme_name']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$programme_name[$i]</option>";
				}
			}			

		}
		
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	public function extract_programme(){
		
		try{
			$sql ="SELECT * FROM `ams_programme` ORDER BY programme_name ASC ";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]						=	(int)$row['id'];
				$programme_name[]			=	$this->wordify($row['programme_name']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$programme_name[$i]</option>";
				}
			}			

		}
		
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	public function extract_department(){
		
		try{
			$sql ="SELECT * FROM `sp_department` ORDER BY faculty_id, id ASC ";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]						=	(int)$row['id'];
				$department_name[]			=	$this->wordify($row['department_name']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$department_name[$i]</option>";
				}
			}			

		}
		
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	public function extract_level(){
		
		try{
			$sql ="SELECT * FROM `ams_level` ";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]						=	(int)$row['id'];
				$level[]					=	$this->wordify($row['level']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$level[$i]</option>";
				}
			}			

		}
		
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	public function extract_reason(){
		
		try{
			$sql ="SELECT * FROM `ams_proposed_reason` ";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]						=	(int)$row['id'];
				$proposed_reason[]			=	$this->wordify($row['proposed_reason']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$proposed_reason[$i]</option>";
				}
			}			

		}
		
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	public function extract_entry_type(){
		
		try{
			$sql ="SELECT * FROM `ams_entry_type` ";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]						=	(int)$row['id'];
				$entry_type[]				=	$this->wordify($row['entry_type']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$entry_type[$i]</option>";
				}
			}			

		}
		
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	//PUBLIC FUNCTION TO CHANGE PASSWORD
	public function change_password($sess_id){
		try{
			if(isset($_POST['changePassword']))
			{
					$present_password = $previous_password = "";
					$verify_pwd_sql = "SELECT password,old_password FROM ams_users  WHERE id = :id LIMIT 1";
					
					$stmt = $this->con->prepare($verify_pwd_sql);
					$stmt->bindParam(':id', $sess_id); 
					$stmt->execute();
					$i=0;
					while($row = $stmt->fetch(PDO::FETCH_ASSOC))
					{  
					$present_password 			=  $row['password']; 	
					$previous_password			=  $row['old_password'];
					$i +=1;
					}
					
					$old_password				=		SHA1($_POST['oldPassword']);
					$new_password				=		SHA1($_POST['newPassword']);
					$new_password2				=		SHA1($_POST['newPassword2']);
					
					if($new_password != $new_password2){
						return	$this->just_notify('Your passwords do not match. Check and try again.',2);
					}
					if($new_password == $previous_password){
						return $this->just_notify('You have used this password recently. Please use another password.',2);
					}
					if($old_password != $present_password){
						return $this->just_notify("Your old password does not match with the password provided. Please check and try again!",2);
					}
				
				if($i>0){
					$read_sql = "update ams_users SET password = :password, old_password = :old_password WHERE id= :id";
					$result = $this->con->prepare($read_sql);
					$result->bindParam(':id', $sess_id); 
					$result->bindParam(':password', $new_password); 
					$result->bindParam(':old_password', $present_password); 
					if($result->execute()){
							
							echo "<script>alert('Password Change was successful. You would be logged out');</script>";
							return $this->goto_notify("index.php?paka=1");
					}
					else{
							echo "<script> 
							alert('Specified Current Password is Invalid');
							window.history.back(1);
							</script>";
					}
				}
			}
		}
		catch(PDOException $exception){
		echo "Connection error: " . $exception->getMessage();
		}		

	}
	
	public function setup_staff_profile($sess_id){
		
		$check_passport			= ("SELECT count(passport) FROM ams_users WHERE id = $sess_id LIMIT 1");
		$check_contact_details	= ("SELECT count(mobile) FROM ams_users WHERE id = $sess_id LIMIT 1");
		
		//$this->test_here($check_contact_details);
		
		//$check_biodata			= ("SELECT count(lastname) FROM ams_users WHERE id like '$sess_id' LIMIT 1");
		
		//$check_biodata = $this->count_sql("FROM ae6_student_biodata WHERE user_id like '$sess_id' LIMIT 1");
		//$check_olevel_data = $this->count_sql("FROM ae6_student_olevel_details WHERE user_id like '$sess_id' LIMIT 1");
		
		$combine = $check_passport && $check_contact_details;
		//$combine = $check_passport && $check_contact_details;
		
		if ($combine <1){
			
				echo "<div class='row m-t-md'>
						<div class='col-md-offset-3 col-md-6'>
							<div class='alert alert-danger alert-dismissible fade in' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
								<h4>Oh snap! You Have Not Completed Your Profile Setup</h4>
								<p> Please follow the instructions given below to complete your profile. <br/><b>NOTE: </b> <i>You will not be able to use this system without completing your profile setup.</i></p>
								<p>
									<button type='button' class='btn btn-danger'><a style='color:white;' href = 'add_new_user.php'>Setup Profile</a></button>
									<button type='button' class='btn btn-default'><a style='color:black;' href = './index.php?paka=1'>Logout</a></button>
								</p>
							</div>
						</div>
					</div>";
		}
	}

	//FUNCTION TO SEARCH CANDIDATE
	public function search_candidate(){
		try{
				if (isset($_POST['search_candidate'])){	
				
					$keyword	=  $this->wordify($_POST['keyword']);
					
				
				$sql = "SELECT * FROM ams_admitted_candidates WHERE candidate_name like  '%$keyword%' OR  jamb_reg_number like  '%$keyword%'  OR geo_zone like '%$keyword%' OR state like '%$keyword%'";
				
				$stmt = $this->con->prepare($sql);
				
				$stmt->execute();
				$this->id = array();
				//$this->gender = array();
			
			$k = 0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->id[]			=	(int)$row['id'];
				$this->candidate_name[]			=	$this->printify($row['candidate_name']);
				$this->jamb_reg_number[]		=	$this->printify($row['jamb_reg_number'],5);
				$this->gender[]					=	$this->printify($row['gender']);
				//$this->gender_id[]				=	$this->printify($row['gender']);
				$this->jamb_score[]				=	$this->printify($row['jamb_score']);
				$this->putme_score[]			=	(int)$row['putme_score'];
				$this->average_score[]			=	$row['average'];
				$this->entry_type[]				=	$this->printify($row['entry_type'],5);
				$this->academic_session_id[]	=	(int)$row['academic_session_id'];
				
				$this->faculty_id[]				=	$row['faculty_id'];
				$this->department_id[]			=	$row['department_id'];
				$this->programme_id[]			=	$row['programme_id'];
				
				$this->faculty[]				=	$this->printify($this->get_this_data("faculty","ams_faculty","id",$this->faculty_id[$k]),5);
				$this->programme[]				=	$this->printify($this->get_this_data("programme_name","ams_programme","id",$this->programme_id[$k]));
				$this->department[]				=	$this->printify($this->get_this_data("programme_name","ams_department","id",$this->department_id[$k]),5);
				$this->academic_session[]		=	$this->printify($this->get_this_data("id","ams_academic_session","id",$this->academic_session_id[$k]));
				
				
				$this->keyword					= $keyword;
				
				$k++;
				} 
				return true;
			}
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
		
	}
	
	
	
	
}


?>
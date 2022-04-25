<?php

require("adv.db_libs.php");

class FAMSAdmin {
		var $con;
		private $result;
		public $id, $staff_user_type, $user_directory;
		public $firstname, $middlename, $lastname, 	$username, $staff_id, $mobile, $email, $createdby, $last_pwd_date,$created_date;
		public $department,$faculty, $faculty_id, $faculty_code, $department_code, $department_name,$study_degree, $study_degree_id;
		public $study_programme,$study_programme_id, $programme;
		public $research_gate_id, $google_scholar_id, $linkedin_id, $twitter_handle, $official_email, $alternate_email, $staff_phone_number, $staff_job_title;
		
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
		$msg = "<div class='alert alert-danger fade in out'>
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
	
	public function wordify($word,$type=0){
		if($type==0) return htmlspecialchars(trim($word));
		else if($type==5){//FOR ABBREVIATIONS
			return htmlspecialchars(trim(strtoupper($word)));
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
				$id[]						=	(int)$row['id'];
				$faculty[]				=	$this->wordify($row['faculty']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>Faculty of $faculty[$i]</option>";
				}
			}			

		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	//FUNCTION TO EXTRACT LIST OF FACULTIES
	public function extract_faculty_list(){
		try{
			
			$sql = "SELECT * FROM sp_faculty ORDER BY id ASC";
						
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			
			$this->id = array();
			$k = 0;
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->id[]						=	(int)$row['id'];
				$this->faculty[]				=	$this->printify($row['faculty'],1);
				$this->faculty_code[] 			=	$this->printify($row['faculty_code'],5);
				
				$k++;
			} 
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	//FUNCTION TO EXTRACT FACULTY DETAILS
	public function extract_faculty_details($f_id){
		try{
			
			$sql = "SELECT * FROM sp_faculty
			WHERE	id =  $f_id";
						
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->id						=	(int)$row['id'];
				$this->faculty					=	$this->printify($row['faculty'],1);
				$this->faculty_code				=	$this->printify($row['faculty_code'],1);
				
				//$this->programme				=	$this->printify($this->get_this_data("programme_name","ams_programme","id",$this->programme_id));
				
			} 
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	//FUNCTION TO EXTRACT FACULTY DEAN's DETAILS
	public function extract_dean_details($f_id){
		try{
			$this->dean_staff_id			=	$this->printify($this->get_this_data("dean_id","sp_faculty","id",$f_id));
			$this->dean_title_id			=	$this->printify($this->get_this_data("title_id","sp_t_staff_profile","id",$this->dean_staff_id));
			$this->dean_passport			=	$this->printify($this->get_this_data("passport","sp_staff_passport","staff_id",$this->dean_staff_id));
			
			$this->dean_title				=	$this->printify($this->get_this_data("title_name","sp_title","id",$this->dean_title_id));
			
			$this->dean_f_name				=	$this->printify($this->get_this_data("firstname","sp_t_staff_profile","id",$this->dean_staff_id));
			$this->dean_m_name				=	$this->printify($this->get_this_data("middle_name","sp_t_staff_profile","id",$this->dean_staff_id));
			$this->dean_l_name				=	$this->printify($this->get_this_data("lastname","sp_t_staff_profile","id",$this->dean_staff_id),2); 
			$this->dean_m_name_initial		=	substr($this->dean_m_name, 0, 1);
			
			$this->dean_fullname			=	$this->dean_title."	".$this->dean_l_name." ".$this->dean_m_name_initial.". ".$this->dean_f_name;
			
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	//FUNCTION TO EXTRACT FACULTY INFORMATION
	public function extract_faculty_info($f_id){
		try{
			
			$this->dean_welcome			=	$this->printify($this->get_this_data("dean_welcome","sp_faculty","id",$f_id),2); 
			$this->faculty_vision		=	$this->printify($this->get_this_data("vision","sp_faculty","id",$f_id),2); 
			$this->faculty_mission		=	$this->printify($this->get_this_data("mission","sp_faculty","id",$f_id),2); 
			$this->faculty_philosophy	=	$this->printify($this->get_this_data("philosophy","sp_faculty","id",$f_id),2); 
			
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	//FUNCTION TO EXTRACT LIST OF DEPARTMENTS IN FACULTY
	public function extract_department_list($f_id){
		try{
			
			$sql = "SELECT * FROM sp_department WHERE faculty_id = $f_id ORDER BY id ASC";
						
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			
			$this->id = array();
			$k = 0;
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->id[]						=	(int)$row['id'];
				$this->department_name[]		=	$this->printify($row['department_name'],1);
				
				$k++;
			} 
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	//FUNCTION TO EXTRACT STAFF DETAILS
	public function extract_staff_details($s_id){
		try{
			
			$this->staff_title_id				=	$this->printify($this->get_this_data("title","sp_personal_details","user_id",$s_id));
			$this->staff_title					=	$this->printify($this->get_this_data("title_name","sp_title","id",$this->staff_title_id));
			
			$this->staff_job_title_id			=	$this->printify($this->get_this_data("job_title","sp_personal_details","user_id",$s_id));
			$this->staff_job_title				=	$this->printify($this->get_this_data("job_title","sp_t_staff_job_title","id",$this->staff_job_title_id),0);
			
			$this->staff_faculty_id				=	$this->printify($this->get_this_data("faculty_id","sp_personal_details","user_id",$s_id));
			$this->the_staff_faculty 			=	$this->printify($this->get_this_data("faculty","sp_faculty","id",$this->staff_faculty_id),2);
			
			$this->staff_department_id			=	$this->printify($this->get_this_data("department_id","sp_personal_details","user_id",$s_id));
			$this->the_staff_department			=	$this->printify($this->get_this_data("department_name","sp_department","id",$this->staff_department_id),2);
			
			$this->staff_passport				=	$this->printify($this->get_this_data("passport","sp_staff_passport","user_id",$s_id));
			
			
			$this->staff_f_name					=	$this->printify($this->get_this_data("firstname","sp_personal_details","user_id",$s_id),2);
			$this->staff_m_name					=	$this->printify($this->get_this_data("middle_name","sp_personal_details","user_id",$s_id));
			$this->staff_l_name					=	$this->printify($this->get_this_data("lastname","sp_personal_details","user_id",$s_id),2); 
			
			$this->official_email				=	$this->printify($this->get_this_data("funai_email_address","sp_contact_details","user_id",$s_id),2); 
			$this->alternate_email				=	$this->printify($this->get_this_data("alternate_email_address","sp_contact_details","user_id",$s_id),2); 
			
			$this->google_scholar_id			=	$this->printify($this->get_this_data("google_scholar_id","sp_staff_details","user_id",$s_id),2); 
			$this->research_gate_id				=	$this->printify($this->get_this_data("research_gate_id","sp_staff_details","user_id",$s_id),2); 
			
			$this->orc_id						=	$this->printify($this->get_this_data("orc_id","sp_staff_details","user_id",$s_id),2); 
			
			$this->staff_biography				=	nl2br($this->printify($this->get_this_data("biography","sp_personal_details","user_id",$s_id),2)); 
			
			//$this->staff_m_name_initial			=	substr($this->staff_m_name, 0, 1);
			
			$this->staff_fullname				=	$this->staff_title."	".$this->staff_l_name." ".$this->staff_f_name;
			
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	//FUNCTION TO EXTRACT STAFF PUBLICATIONS
	public function extract_staff_publications($s_id){
		try{
			$sql = "SELECT * FROM sp_publication WHERE user_id = $s_id ORDER BY id ASC";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			//$this->publication_id = array();
			
			
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->publication_id			=	(int)$row['id'];
				$this->the_publication			=	$this->printify($row['publication'],1);
				
			}  
				return true;
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	//FUNCTION TO EXTRACT LIST OF STAFF LIST
	public function extract_faculty_t_staff_list($f_id){
		try{
			
			$sql = "SELECT * FROM sp_personal_details WHERE faculty_id = $f_id ORDER BY id ASC";
						
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			
			$this->staff_id = array();
			$k = 0;
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->staff_id[]				=	$row['user_id'];
				
				$this->staff_title_id[]		=	$this->printify($this->get_this_data("title","sp_personal_details","user_id",$this->staff_id[$k]));
				$this->staff_title[]		=	$this->printify($this->get_this_data("title_name","sp_title","id",$this->staff_title_id[$k]),2);
				
				$this->staff_passport[]		=	$this->printify($this->get_this_data("passport","sp_staff_passport","user_id",$this->staff_id[$k]));
				
				$this->staff_job_title_id[]	=	$this->printify($this->get_this_data("job_title","sp_personal_details","user_id",$this->staff_id[$k]));
				$this->staff_job_title[]	=	$this->printify($this->get_this_data("job_title","sp_t_staff_job_title","id",$this->staff_job_title_id[$k]),2);
				
				$this->staff_f_name[]		=	$this->printify($row['firstname'],2);
				$this->staff_m_name[]		=	$this->printify($row['middlename'],2);
				$this->staff_l_name[]		=	$this->printify($row['lastname'],2);
				
				$k++;
			} 
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	
}

$tuwo = new FAMSAdmin;

?>
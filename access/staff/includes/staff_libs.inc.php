<?php

require("../common.inc/common_libs.inc.php");

//require ("../../resources/shared/mail/class.phpmailer.php");
//require ("../../resources/shared/mail/class.smtp.php");

class FAMSAdmin extends CommonInc{
		var $con;
		private $result;
		public $id, $staff_user_type, $user_directory,$myGender, $myGenderCode;
		public $firstName, $otherName, $lastname, $admission_percentage, $username, $phone_number, $email, $createdby, $last_pwd_date,$created_date, $staff_fullname, $passport;
	
		
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
	
	
	public function date_to_text($date){
		$explode_date						=			explode("-", $date);
		$year								=			$explode_date[0];
		$month								=			$explode_date[1];
		$day								=			$explode_date[2];
		switch($month){
			case 01:	
						$month = "January";
						break;
			case 02:	
						$month = "February";
						break;
			case 03:	
						$month = "March";
						break;
			case 04:	
						$month = "April";
						break;
			case 05:	
						$month = "May";
						break;
			case 06:	
						$month = "June";
						break;
			case 07:	
						$month = "July";
						break;
			case '08':	
						$month = "August";
						break;
			case '09':	
						$month = "September";
						break;
			case 10:	
						$month = "October";
						break;
			case 11:	
						$month = "November";
						break;
			case 12:	
						$month = "December";
						break;
			default:
						$month = "";
						break;
		}
		
		$date = implode(" ",array($month,$day));
		$date = implode(",",array($date,$year));
		return $date;
	}
	
	//FUNCTION TO EXTRACT STUDENT BIO DATA
	public function extract_staff_data($sess_id){
		try{
			
			$sql = "SELECT * FROM ams_users WHERE `user_id` LIKE ? LIMIT 1";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(1, $sess_id);
			$stmt->execute();
			
		
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
					
				$this->id								=	(int)$row['id'];
				$this->lastname							=	$this->wordify($row['lastname']);
				$this->middlename						=	$this->wordify($row['middlename']);
				$this->firstname						=	$this->wordify($row['firstname']);
				
				$this->fullname							=	$this->lastname.' '.$this->middlename.' '.$this->firstname;
				$this->title							=	$this->wordify($row['title']);
				$this->state							=	$this->wordify($row['state']);
				$this->lga								=	$this->wordify($row['lga']);
				$this->disability_id					=	(int)$row['disability'];
				$this->religion_id						=	(int)$row['religion'];
				$this->marital_status_id				=	(int)$row['marital_status'];
				$this->highest_qualification_id			=	(int)$row['highest_qualification'];
				
				$this->permanent_address				=	$this->wordify($row['permanent_address']);
				$this->contact_address					=	$this->wordify($row['contact_address']);
				$this->contact_city						=	$this->wordify($row['contact_city']);
				$this->contact_state					=	$this->wordify($row['contact_state']);
				$this->date_of_birth					=	$this->date_to_text($this->wordify($row['date_of_birth']));
				$this->dateOfBirth						=	$row['date_of_birth'];
				$this->place_of_birth					=	$this->wordify($row['place_of_birth']);
				$this->town_of_birth					=	$this->wordify($row['town_of_birth']);
				$this->state_of_birth					=	$this->wordify($row['state_of_birth']);
				$this->hometown							=	$this->wordify($row['hometown']);
				$this->health_condition					=	$this->wordify($row['health_condition']);
				$this->extra_curricular					=	$this->wordify($row['extra_curricular']);
				$this->previous_university				=	$this->wordify($row['previous_university']);
				
				$this->gender						=		$this->get_this_data("gender_name","ams_gender","id",$this->gender_id);
				$this->myGender						=		$this->get_this_data("gender_name","ams_gender","id",$this->gender_id);
				$this->myGenderCode					=		$this->get_this_data("gender_code","ams_gender","id",$this->gender_id);
				//echo $this->myGender; exit();
				
				$this->country						=		$this->get_this_data("country","ae6_country","id",$this->country_id);
				//$this->state						=		$this->get_this_data("state","ae6_state","id",$this->state_id);
				//$this->lga							=		$this->get_this_data("lga","ae6_lga","id",$this->lga_id);
				$this->disability					=		$this->get_this_data("disability","ae6_disability","id",$this->disability_id);
				$this->religion						=		$this->get_this_data("religion","ae6_religion","id",$this->religion_id);
				$this->marital_status				=		$this->get_this_data("maritalstatusname","ae6_maritalstatus","id",$this->marital_status_id);
				$this->highest_qualification		=		$this->get_this_data("qualification","ae6_qualification","id",$this->highest_qualification_id);
				if($this->myGender == 'Male'){
					$this->student_title = "Mr";
				}
				else{
					$this->student_title = "Mrs./Miss";
				}
				
			}  
			return true;
			
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	
	//FUNCTION TO SETUP FRESHER PROFILE ACADEMIC DATA
	public function setup_profile($sess_id){
		
		//$this->check_account_activation		=	$this->count_sql("FROM ae6_unique_id WHERE used_by LIKE '$sess_username' AND pin_usage = 1");
		
		$check_staff_details = $this->count_sql("FROM sp_staff_details WHERE user_id = '$sess_id' LIMIT 1");
		$check_personal_details = $this->count_sql("FROM sp_personal_details WHERE user_id like '$sess_id' LIMIT 1");
		$check_contact_details = $this->count_sql("FROM sp_contact_details WHERE user_id like '$sess_id' LIMIT 1");
		$check_staff_passport = $this->count_sql("FROM sp_staff_passport WHERE user_id like '$sess_id' LIMIT 1");
		//$check_olevel_data = $this->count_sql("FROM ae6_student_olevel_details WHERE user_id like '$sess_id' LIMIT 1");
		
		$combine = $check_staff_details && $check_personal_details && $check_contact_details && $check_staff_passport;
		
		if ($combine <1)
			{
				echo "<div class='col-md-6 col-md-offset-3 center'>
					<div class='panel panel-success'>
						<div class='panel-body'>
							 <div class='clearfix'></div>
								<p class='text-center'><strong>
									You have successfully created your account.<br/>Please follow the instructions below to complete your registration forms.</strong>
								</p>
								<a href='add_personal_details.php'><button type='button' class='btn btn-success btn-addon m-b-sm btn-lg center'><i class='fa fa-plus'></i>  Setup Profile</button>
								</a>
							<div class='clearfix'></div>
						</div>
					</div>	
				</div>";			
			}
		elseif ($combine >=1)
			{
				echo "<div class='col-md-6 col-md-offset-3 center'>
					<div class='panel panel-success'>
						<div class='panel-body'>
							 <div class='clearfix'></div>
								<p>
									You have successfully completed your profile setup.<br/>Click on <b>ADD PUBLICATIONS</b> menu below to upload publications to FURA.<br/>
									
									Thank you!
								</p>
								<a href='add_publications.php'><button type='button' class='btn btn-success btn-addon m-b-sm btn-lg center'><i class='fa fa-plus'></i>  Add Publications</button>
							<div class='clearfix'></div>
						</div>
					</div>	
				</div>";			
			}
		
	}
	
	//FUNCTION TO VERIFY UPLOADS
	public function pass_personal_details($sess_id){
		
		$pass_staff_details = $this->count_sql("FROM sp_personal_details WHERE user_id LIKE '$sess_id' LIMIT 1");
		
		 if ($pass_staff_details>=1){
			$this->goto_notify("add_contact_details.php");	 
		 }
	}
	
	public function pass_contact_details($sess_id){
		
		$pass_staff_details = $this->count_sql("FROM sp_contact_details WHERE user_id LIKE '$sess_id' LIMIT 1");
		
		 if ($pass_staff_details>=1){
			$this->goto_notify("add_staff_data.php");	 
		 }
	}
	
	
	public function pass_staff_details($sess_id){
		
		$pass_staff_details = $this->count_sql("FROM sp_staff_details WHERE user_id LIKE '$sess_id' LIMIT 1");
		
		 if ($pass_staff_details>=1){
			$this->goto_notify("upload_passport.php");	 
		 }
	}
	
	
	public function pass_passport($sess_id){
		
		$pass_passport = $this->count_sql("FROM sp_staff_passport WHERE user_id LIKE '$sess_id' LIMIT 1");
		
		 if ($pass_passport){
			$this->goto_notify("add_publications.php");	 
		 }
	}
	
	public function pass_publications($sess_id){
		
		$pass_staff_details = $this->count_sql("FROM sp_publication WHERE user_id LIKE '$sess_id' LIMIT 1");
		
		 if ($pass_staff_details>=1){
			$this->goto_notify("index.php","Your profile is complete, kindly use the edit links to update your profile.");	 
		 }
	}
	
	//FUNCTION TO EXTRACT STAFF TITLE
	public function extract_title(){
		
		try{
			$sql ="SELECT * FROM `sp_title` ORDER BY id";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			$title_name = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]			=	(int)$row['id'];
				$title_name[]	=	$this->wordify($row['title_name']);
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
	
	//FUNCTION TO EXTRACT STAFF JOB TITLE
	public function extract_job_title(){
		
		try{
			$sql ="SELECT * FROM `sp_t_staff_job_title` ORDER BY id";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			$job_title = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]			=	(int)$row['id'];
				$job_title[]	=	$this->wordify($row['job_title']);
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$job_title[$i]</option>";
				}
			}			

		}
		
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	//FUNCTION TO EXTRACT YEAR
	public function extract_year(){
		try{
			$sql = "SELECT * FROM ae6_year WHERE 1";
			$stmt = $this->con->prepare($sql);
			//$stmt->bindParam(':sourcefield', $keyword); 
			$stmt->execute();
			$id = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$id[]						=	(int)$row['id'];
				$yyyy[]						=	(int)$row['yyyy'];
			}  
			$count_data = count($id);
			
			if($count_data<1){	
				echo "<tr colspan ='2'>
                                            There is no record in this table</tr>";	
			}
			else{
				//echo "<tbody>";
				for($i= 0; $i<$count_data; $i++){
					
						echo "<option value = '$id[$i]'>$yyyy[$i]</option>";
				}
			}			

		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
	}
	
	//PUBLIC FUNCTION TO ADD CONTACT DETAILS
	public function add_staff_details($sess_id){
		try{
				
				$this->google_scholar_id			=  $this->wordify($_POST['google_scholar_id']);
				$this->research_gate_id				=  $this->wordify($_POST['research_gate_id']);
				$this->orc_id						=  $this->wordify($_POST['orc_id']);
				
				$createddate 					=	date('d-m-Y');
				//$isactive						=	1;
				
				$query = "INSERT INTO sp_staff_details SET
						user_id						=	:user_id,
						
						google_scholar_id			= 	:google_scholar_id,
						research_gate_id			= 	:research_gate_id,
						orc_id						= 	:orc_id,
						
						createdby 					= 	:createdby, 
						createddate 				= 	:createddate;";
				
				// prepare query for execution
				$stmt = $this->con->prepare($query);
				$stmt->bindParam(':user_id', $sess_id);		
				
				$stmt->bindParam(':google_scholar_id', $this->google_scholar_id);	
				$stmt->bindParam(':research_gate_id', $this->research_gate_id);	
				$stmt->bindParam(':orc_id', $this->orc_id);	
				
				$stmt->bindParam(':createdby', $sess_id);		
				$stmt->bindParam(':createddate', $createddate);	

				if(!$stmt->execute()){
					return $this->just_notify("Oops! There's an error. ",2);
				}
				else{
					return $this->goto_notify("upload_passport.php");
				}
			
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
	}
	
	//PUBLIC FUNCTION TO ADD PERSONAL DETAILS
	public function add_personal_details($sess_id){
		try{
				$this->staff_title_id			=  	(int)$_POST['title_id'];
				$this->staff_job_title_id		=  	(int)$_POST['job_title_id'];
				$this->department_id			=  	(int)$_POST['department_id'];
				$this->faculty_id				=  	$this->get_this_data("faculty_id","sp_department","id",$this->department_id);
				
				$this->last_name				=  	$this->wordify($_POST['last_name']);
				$this->middle_name				=  	$this->wordify($_POST['middle_name']);
				$this->first_name				=  	$this->wordify($_POST['first_name']);
				
				$this->biography				=  	$this->wordify($_POST['biography']);
				
				$createddate 					=	date('d-m-Y');
				
				//$isactive						=	1;
				
				$query = "INSERT INTO sp_personal_details SET
						
							user_id			=	:user_id,
							
							title			= 	:title_id, 
							job_title		= 	:jobtitle_id, 
							faculty_id		= 	:faculty_id, 
							department_id	= 	:department_id,
							
							lastname		= 	:lastname,
							middlename		= 	:middlename,
							firstname		= 	:firstname,
							biography		= 	:biography,
							
							createdby 		= 	:createdby, 
							createddate 	= 	:createddate";
				
				// prepare query for execution
				$stmt = $this->con->prepare($query);
				$stmt->bindParam(':user_id', $sess_id);	
				
				$stmt->bindParam(':title_id', $this->staff_title_id);	
				$stmt->bindParam(':jobtitle_id', $this->staff_job_title_id);	
				$stmt->bindParam(':faculty_id', $this->faculty_id);	
				$stmt->bindParam(':department_id', $this->department_id);	
				
				$stmt->bindParam(':lastname', $this->last_name);		
				$stmt->bindParam(':middlename', $this->middle_name);		
				$stmt->bindParam(':firstname', $this->first_name);
				$stmt->bindParam(':biography', $this->biography);
				
				$stmt->bindParam(':createdby', $sess_id);		
				$stmt->bindParam(':createddate', $createddate);	
				
				if(!$stmt->execute()){
					return $this->just_notify("Oops! There's an error. ",2);
				}
				else{
					return $this->goto_notify("add_contact_details.php");
				}
			
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
	}
	
	//PUBLIC FUNCTION TO ADD CONTACT DETAILS
	public function add_contact_details($sess_id){
		try{
				
				$this->funai_email				=	$this->wordify($_POST['funai_email']);
				$this->alternate_email			=  	$this->wordify($_POST['alternate_email']);
				
				$this->phone_number				=  $_POST['phone_number'];
				
				$createddate 					=	date('d-m-Y');
				
				//$isactive						=	1;
				
				$query = "INSERT INTO sp_contact_details SET
						user_id						=	:user_id,
						
						phone_number				= 	:phone_number, 
						funai_email_address			= 	:funai_email_address,
						alternate_email_address		= 	:alternate_email_address,
						
						createdby 					= 	:createdby, 
						createddate 				= 	:createddate;";
				
				// prepare query for execution
				$stmt = $this->con->prepare($query);
				$stmt->bindParam(':user_id', $sess_id);		
				
				$stmt->bindParam(':funai_email_address', $this->funai_email);		
				$stmt->bindParam(':alternate_email_address', $this->alternate_email);	
				$stmt->bindParam(':phone_number', $this->phone_number);
				
				$stmt->bindParam(':createdby', $sess_id);		
				$stmt->bindParam(':createddate', $createddate);	
				
				if(!$stmt->execute()){
					return $this->just_notify("Oops! There's an error. ",2);
				}
				else{
					return $this->goto_notify("add_staff_data.php");
				}
			
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
	}
	
	//PUBLIC FUNCTION TO ADD CONTACT DETAILS
	public function add_staff_publication($sess_id){
		try{
				//$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$this->publication = isset($_POST['publication'])?$this->convert_rn($_POST['publication']):"";
				
				//$this->publication			=	$_POST['publication'];
				
				$createddate 				=	date('d-m-Y');
				
				//$isactive						=	1;
				
				$query = "INSERT INTO sp_publication SET
						user_id			=	:user_id,
						
						publication		= 	:publication, 
						
						createdby 		= 	:createdby, 
						createddate 	= 	:createddate;";
				
				// prepare query for execution
				$stmt = $this->con->prepare($query);
				$stmt->bindParam(':user_id', $sess_id);		
				
				$stmt->bindParam(':publication', $this->publication);	
				
				$stmt->bindParam(':createdby', $sess_id);		
				$stmt->bindParam(':createddate', $createddate);	
				
				if(!$stmt->execute()){
					return $this->just_notify("Oops! There's an error. ",2);
				}
				else{
					return $this->goto_notify("index.php","Your publications have been added successfully!");
				}
			
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
	}
	
	//FUNCTION TO SEARCH CANDIDATE
	public function extract_staff_publications($sess_id){
		try{
				
				$sql = "SELECT * FROM sp_publication WHERE user_id = $sess_id";
				
				$stmt = $this->con->prepare($sql);
				
				$stmt->execute();
				$this->id = array();
				$this->publication = array();
				
				//$this->gender = array();
			
			$k = 0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->id[]						=	(int)$row['id'];
				$this->publication[]			=	$this->printify($row['publication'],1);
				
				
				$k++;
				} 
				return true;
			
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
		
	}
	
	//FUNCTION TO SEARCH CANDIDATE
	public function extract_staff_details($sess_id){
		try{
				
				$sql = "SELECT * FROM sp_personal_details WHERE user_id = $sess_id";
				
				$stmt = $this->con->prepare($sql);
				
				$stmt->execute();
				
				//$this->gender = array();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->title_id			=	(int)$row['title'];
				$this->job_title_id		=	(int)$row['job_title'];
				$this->department_id	=	(int)$row['department_id'];
				
				$this->staff_title		=	$this->printify($this->get_this_data("title_name","sp_title","id",$this->title_id),2);
				$this->job_title		=	$this->printify($this->get_this_data("job_title","sp_t_staff_job_title","id",$this->job_title_id),0);
				$this->department		=	$this->printify($this->get_this_data("department","sp_department","id",$this->department_id),0);
				
				$this->lastname			=	$this->printify($row['lastname'],2);
				$this->middlename		=	substr($this->printify($row['middlename'],2),0,1);
				$this->firstname		=	$this->printify($row['firstname'],2);
				
				$this->staff_fullname	=	$this->staff_title." ".$this->lastname." ".$this->firstname;
				
				//$this->test_here($this->staff_title);
				
				} 
				return true;
			
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}		
		
	}
	
	//PUBLIC FUNCTION TO UPLOAD PASSPORT
	public function upload_staff_passport($sess_id){
			$att_error = 0;
			$att_reply = "";
			if($_FILES['uploaded']['size'] > 0){
				
				return $this->staff_passport_manager($sess_id);
			}
			else 	
			{
			$att_error = 1;
			$att_reply = $this->just_notify("Sorry, there was a problem uploading the passport, it may be empty or invalid. Check the size of the file and try again",2);
			return $att_reply;
			//$att_reply = "Sorry, there was a problem uploading your file, it may be empty or invalid";
			}
	}
	
	public function staff_passport_manager($sess_id){
			
			global $att_reply, $uploaded_time, $ext,$att_error;
			$user_id =$sess_id;
			
			$createddate 					=	date('d-m-Y');
			
			$ext = pathinfo($_FILES['uploaded']['name'], PATHINFO_EXTENSION);
			$uploaded_time = time();
			$allowedExts = array("JPG", "jpg", "JPEG", "jpeg", "PNG", "png");
			$targetpath = "../common.inc/staff_passport/"; 
			$target = $targetpath . basename( $_FILES['uploaded']['name']) ;
			$filename = basename( $_FILES['uploaded']['name']); 
			$file_size = $_FILES['uploaded']['size'];
			$file_type = strtolower($_FILES["uploaded"]["type"]);
			if(!in_array($ext,$allowedExts)){
			$att_reply = $this->just_notify("$file_type . is an Invalid File Type. Upload the extension .JPEG | .jepg |.JPG | .jpg | .PNG or .png",2); 
			return $att_reply;
			$att_error = 2;
			}
	
			if ($_FILES['uploaded']['size'] > 307200) {$att_error = 3; $att_reply = $this->just_notify("File Exceeds Max_Limit of 300kb",2); return $att_reply; } 

			 if($att_error != 0){
			 return ;
			 }
			if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
				{
					$file_name = $sess_id . "_" . $uploaded_time . ".".$ext;
					
					$newname = $targetpath . $file_name; 
					if(file_exists($newname)){
					unlink($target);
					$att_error = 4;
					$att_reply = $this->just_notify("Sorry There was An Error With The Attachment, Please Try re-attaching it",2); 
					return $att_reply;
					}
					else{
					if(!rename($target,$newname))  {$att_error = 5; $att_reply = $this->just_notify("Could Not Attach File Try Later",2); return $att_reply;}
						else{
							if($att_error == 0){
						//Insert Info of uploaded  into Database here
						$att_reply =  $newname;
						
						$sql = "INSERT into sp_staff_passport SET 
						`user_id`  		= 	:user_id, 
						`passport`  	= 	:passport,
						createdby 		= 	:createdby, 
						createddate 	= 	:createddate
						";
						
						$result = $this->con->prepare($sql);
						$result->bindParam(':passport', $file_name);
						$result->bindParam(':user_id', $sess_id);
						
						$result->bindParam(':createdby', $sess_id);		
						$result->bindParam(':createddate', $createddate);	
											
							if($result->execute()){
									return $this->goto_notify("add_personal_details.php","Staff Staff Profile Setup is completed!");
										
							}
						}
						else{
									return $this->just_notify("OOPS!!! Unable to upload Passport. Please try again. ",1);
						}
					}
				}
			} 
	}
	
	//FUNCTION TO EXTRACT PERSONAL DETAILS FOR EDIT
	public function get_personal_details_for_edit($sess_id){
		try{
			
			$sql = "SELECT * FROM sp_personal_details
			WHERE	user_id =  $sess_id";
						
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->staff_title_id			=  	(int)$row['title'];
				$this->staff_title				=	$this->printify($this->get_this_data("title_name","sp_title","id",$this->staff_title_id));
				$this->staff_job_title_id		=  	(int)$row['job_title'];
				$this->staff_job_title			=	$this->printify($this->get_this_data("job_title","sp_t_staff_job_title","id",$this->staff_job_title_id));
				
				$this->department_id			=  	(int)$row['department_id'];
				$this->department				=  	$this->get_this_data("department_name","sp_department","id",$this->department_id);
				$this->faculty_id				=  	(int)$row['faculty_id'];
				$this->faculty					=	$this->printify($this->get_this_data("faculty","sp_faculty","id",$this->faculty_id));
				
				
				$this->last_name				=  	$this->wordify($row['lastname']);
				$this->middle_name				=  	$this->wordify($row['middlename']);
				$this->first_name				=  	$this->wordify($row['firstname']);
				
				$this->biography				=  	$this->wordify($row['biography'],0);

			} 
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	
	//PUBLIC FUNCTION TO UPDATE PERSONAL DETAILS
	public function update_personal_details($sess_id){
		try{
				
				$this->staff_title_id			=  	(int)$_POST['title_id'];
				$this->staff_job_title_id		=  	(int)$_POST['job_title_id'];
				$this->department_id			=  	(int)$_POST['department_id'];
				$this->faculty_id				=  	$this->get_this_data("faculty_id","sp_department","id",$this->department_id);
				
				$this->last_name				=  	$this->wordify($_POST['last_name']);
				$this->middle_name				=  	$this->wordify($_POST['middle_name']);
				$this->first_name				=  	$this->wordify($_POST['first_name']);
				
				$this->biography				=  	$this->wordify($_POST['biography']);
					
				
				$dateupdated 					=	date('d-m-Y');
				
				//$isactive						=	1;
				
				$query = "UPDATE sp_personal_details SET
						
							user_id			=	:user_id,
							
							title			= 	:title_id, 
							job_title		= 	:jobtitle_id, 
							faculty_id		= 	:faculty_id, 
							department_id	= 	:department_id,
							
							lastname		= 	:lastname,
							middlename		= 	:middlename,
							firstname		= 	:firstname,
							biography		= 	:biography,
							
							dateupdated		= 	:dateupdated";
				
				// prepare query for execution
				$stmt = $this->con->prepare($query);
				$stmt->bindParam(':user_id', $sess_id);	
				
				$stmt->bindParam(':title_id', $this->staff_title_id);	
				$stmt->bindParam(':jobtitle_id', $this->staff_job_title_id);	
				$stmt->bindParam(':faculty_id', $this->faculty_id);	
				$stmt->bindParam(':department_id', $this->department_id);	
				
				$stmt->bindParam(':lastname', $this->last_name);		
				$stmt->bindParam(':middlename', $this->middle_name);		
				$stmt->bindParam(':firstname', $this->first_name);
				$stmt->bindParam(':biography', $this->biography);
				
				$stmt->bindParam(':dateupdated', $dateupdated);	
				
				if(!$stmt->execute()){
					return $this->just_notify("There was an error performing this operation",2);
				}
				else{
					return $this->just_notify("Personal Details updated successfully!",1);
				}
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
	}
	
	//FUNCTION TO EXTRACT PERSONAL DETAILS FOR EDIT
	public function get_contact_details_for_edit($sess_id){
		try{
			
			$sql = "SELECT * FROM sp_contact_details
			WHERE	user_id =  $sess_id";
						
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->funai_email				=	$this->wordify($row['funai_email_address']);
				$this->alternate_email			=  	$this->wordify($row['alternate_email_address']);
				
				$this->phone_number				=  $row['phone_number'];
			
			} 
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	
	//PUBLIC FUNCTION TO UPDATE CONTACT DETAILS
	public function update_contact_details($sess_id){
		try{
				$this->funai_email				=	$this->wordify($_POST['funai_email']);
				$this->alternate_email			=  	$this->wordify($_POST['alternate_email']);
				
				$this->phone_number					=  $_POST['phone_number'];
				
				$dateupdated 					=	date('d-m-Y');
				
				//$isactive						=	1;
				
				$query = "UPDATE sp_contact_details SET
						
						phone_number				= 	:phone_number, 
						funai_email_address			= 	:funai_email_address,
						alternate_email_address		= 	:alternate_email_address,
						
						dateupdated 				= 	:dateupdated
						
						WHERE user_id				=	:user_id
						
						";
				
				// prepare query for execution
				$stmt = $this->con->prepare($query);
				$stmt->bindParam(':user_id', $sess_id);		
				
				$stmt->bindParam(':funai_email_address', $this->funai_email);		
				$stmt->bindParam(':alternate_email_address', $this->alternate_email);	
				$stmt->bindParam(':phone_number', $this->phone_number);
				
				$stmt->bindParam(':dateupdated', $dateupdated);	
				
				
				if(!$stmt->execute()){
					return $this->just_notify("There was an error performing this operation!",2);
				}
				else{
					return $this->just_notify("Contact Details updated successfully!",1);
				}
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
	}
	
	//FUNCTION TO EXTRACT PERSONAL DETAILS FOR EDIT
	public function get_staff_data_for_edit($sess_id){
		try{
			
			$sql = "SELECT * FROM sp_staff_details
			WHERE	user_id =  $sess_id";
						
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->google_scholar_id			=  $this->wordify($row['google_scholar_id']);
				$this->research_gate_id				=  $this->wordify($row['research_gate_id']);
				$this->orc_id						=  $this->wordify($row['orc_id']);
			
			} 
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	
	//PUBLIC FUNCTION TO UPDATE STAFF DATA
	public function update_staff_data($sess_id){
		try{
				$this->google_scholar_id			=  $this->wordify($_POST['google_scholar_id']);
				$this->research_gate_id				=  $this->wordify($_POST['research_gate_id']);
				$this->orc_id						=  $this->wordify($_POST['orc_id']);
				
				$dateupdated 					=	date('d-m-Y');
				//$isactive						=	1;
				
				$query = "UPDATE sp_staff_details SET
						
						google_scholar_id		= 	:google_scholar_id,
						research_gate_id		= 	:research_gate_id,
						orc_id					= 	:orc_id,
						
						dateupdated 			= 	:dateupdated
						
						WHERE user_id			=	:user_id
						";
				
				// prepare query for execution
				$stmt = $this->con->prepare($query);
				$stmt->bindParam(':user_id', $sess_id);		
				
				$stmt->bindParam(':google_scholar_id', $this->google_scholar_id);	
				$stmt->bindParam(':research_gate_id', $this->research_gate_id);	
				$stmt->bindParam(':orc_id', $this->orc_id);	
				
				$stmt->bindParam(':dateupdated', $dateupdated);	

				
				
				if(!$stmt->execute()){
					return $this->just_notify("There was an error performing this operation!",2);
				}
				else{
					return $this->just_notify("Details updated successfully!",1);
				}
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
	}
	
	//FUNCTION TO EXTRACT STAFF PUBLICATION FOR EDIT
	public function get_staff_publication_for_edit($sess_id){
		try{
			
			$sql = "SELECT * FROM sp_publication
			WHERE	user_id =  $sess_id";
						
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->id				=	(int)$row['id'];
				$this->user_id			=	(int)$row['user_id'];
				$this->publication		=	$this->printify($row['publication']);
			} 
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	
	//PUBLIC FUNCTION TO UPDATE STAFF PUBLICATIONS
	public function update_staff_publication($sess_id){
		try{
				
				//$this->publication		=	$this->wordify($_POST['publication'],1);
				
				$this->publication = isset($_POST['publication'])?$this->convert_rn($_POST['publication']):"";
				
				$dateupdated 			=	date('d-m-Y');
				//$isactive				=	1;
				
				$query = "UPDATE sp_publication SET
						
						publication		= 	:publication,
						dateupdated		=	:dateupdated
						
						WHERE user_id	=	:user_id
						";
				
				// prepare query for execution
				$stmt = $this->con->prepare($query);
				$stmt->bindParam(':user_id', $sess_id);		
				
				$stmt->bindParam(':publication', $this->publication);	
				
				$stmt->bindParam(':dateupdated', $dateupdated);	

				
				
				if(!$stmt->execute()){
					return $this->just_notify("There was an error performing this operation!",2);
				}
				else{
					return $this->just_notify("<p>Details updated successfully!</p><br/><a target='_blank' href = 'https://staffprofile.funai.edu.ng/staff_profile.php?s_id=$sess_id' class = 'btn btn-info center'><b>Click here to go back to your publication list.</b></a>",1);
				}
		}
		catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
	}
	
	//FUNCTION TO EXTRACT STAFF FOR EDIT
	public function get_staff_passport_for_edit($sess_id){
		try{
			
			$sql = "SELECT * FROM sp_staff_passport
			WHERE	user_id =  $sess_id";
						
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{  
				$this->id				=	(int)$row['id'];
				$this->passport			=	$this->printify($row['passport']);
			} 
				return true;
		}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}		
	}
	
	
	//PUBLIC FUNCTION TO UPLOAD PASSPORT
	public function update_staff_passport($sess_id){
			$att_error = 0;
			$att_reply = "";
			if($_FILES['uploaded']['size'] > 0){
				
				return $this->update_staff_passport_manager($sess_id);
			}
			else 	
			{
			$att_error = 1;
			$att_reply = $this->just_notify("Sorry, there was a problem uploading the passport, it may be empty or invalid. Check the size of the file and try again",2);
			return $att_reply;
			//$att_reply = "Sorry, there was a problem uploading your file, it may be empty or invalid";
			}
	}
	
	public function update_staff_passport_manager($sess_id){
			
			global $att_reply, $uploaded_time, $ext,$att_error;
			$user_id =$sess_id;
			
			$createddate 					=	date('d-m-Y');
			
			$ext = pathinfo($_FILES['uploaded']['name'], PATHINFO_EXTENSION);
			$uploaded_time = time();
			$allowedExts = array("JPG", "jpg", "JPEG", "jpeg", "PNG", "png");
			$targetpath = "../common.inc/staff_passport/"; 
			$target = $targetpath . basename( $_FILES['uploaded']['name']) ;
			$filename = basename( $_FILES['uploaded']['name']); 
			$file_size = $_FILES['uploaded']['size'];
			$file_type = strtolower($_FILES["uploaded"]["type"]);
			if(!in_array($ext,$allowedExts)){
			$att_reply = $this->just_notify("$file_type . is an Invalid File Type. Upload the extension .JPEG | .jepg |.JPG | .jpg | .PNG or .png",2); 
			return $att_reply;
			$att_error = 2;
			}
	
			if ($_FILES['uploaded']['size'] > 307200) {$att_error = 3; $att_reply = $this->just_notify("File Exceeds Max_Limit of 300kb",2); return $att_reply; } 

			 if($att_error != 0){
			 return ;
			 }
			if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
				{
					$file_name = $sess_id . "_" . $uploaded_time . ".".$ext;
					
					$newname = $targetpath . $file_name; 
					if(file_exists($newname)){
					unlink($target);
					$att_error = 4;
					$att_reply = $this->just_notify("Sorry There was An Error With The Attachment, Please Try re-attaching it",2); 
					return $att_reply;
					}
					else{
					if(!rename($target,$newname))  {$att_error = 5; $att_reply = $this->just_notify("Could Not Attach File Try Later",2); return $att_reply;}
						else{
							if($att_error == 0){
						//Insert Info of uploaded  into Database here
						$att_reply =  $newname;
						
						$sql = "UPDATE sp_staff_passport SET 
						`user_id`  		= 	:user_id, 
						`passport`  	= 	:passport,
						dateupdated 	= 	:dateupdated
						WHERE
						user_id			=	:user_id
						";
						
						$result = $this->con->prepare($sql);
						$result->bindParam(':passport', $file_name);
						$result->bindParam(':user_id', $sess_id);
						
						$result->bindParam(':dateupdated', $dateupdated);		
											
							if($result->execute()){
									return $this->just_notify("<p>Passport updated successfully!</p><br/><a target='_blank' href = 'https://staffprofile.funai.edu.ng/staff_profile.php?s_id=$sess_id' class = 'btn btn-info center'><b>Click here to go back to your homepage.</b></a>",1);
										
							}
						}
						else{
									return $this->just_notify("OOPS!!! Unable to upload Passport. Please try again. ",1);
						}
					}
				}
			} 
	}
	
	//FUNCTION TO SETUP FORM UPDATE MENU
	public function setup_update_menu($sess_id){
		
		$valid_result = 2;
		
		$test_staff_details = $this->count_sql("FROM sp_staff_details WHERE user_id = '$sess_id' LIMIT 1");
		$test_personal_details = $this->count_sql("FROM sp_personal_details WHERE user_id like '$sess_id' LIMIT 1");
		$test_contact_details = $this->count_sql("FROM sp_contact_details WHERE user_id like '$sess_id' LIMIT 1");
		
		if ($test_staff_details ==  1)
			{
				$this->staff_details_link = "<li><a href='update_staff_data.php' target='_blank'>Update Staff Details</a></li>";			
			}
		else
			{
				$this->staff_details_link = "";			
			}
		//$this->test_here($this->staff_details_link);
		
		if ($test_personal_details == 1)
			{
				$this->personal_details_link = "<li><a href='update_personal_details.php' target='_blank'>Update Personal Details</a></li>";			
			}
		else
			{
				$this->personal_details_link = "";			
			}
		//$this->test_here($this->personal_details_link);
		
		if ($test_contact_details == 1)
			{
				$this->contact_details_link = "<li><a href='update_contact_details.php' target='_blank'>Update Contact Details</a></li>";			
			}
		else
			{
				$this->contact_details_link = "";			
			}
		//$this->test_here($this->personal_details_link);
	}
	
}

$tuwo = new FAMSAdmin;
if(isset($_GET['paka']))$tuwo->goto_notify("../../session/ALPHA_Process.php?paka=1");
?>
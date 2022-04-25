<?php require("ALPHA_authenticate.php"); ?>
<!DOCTYPE html> 
<HEAD>
<TITLE>Create New User</TITLE>	 
<META http-equiv="content-type" content="text/html; charset=utf-8">	 
<META name="author" content="Thesent George">	 
<LINK  rel="stylesheet" type="text/css" href="style/screen.css">	 
<link rel="stylesheet" type="text/css" href="styles.css">
</HEAD> 
<BODY>
<div style="position:absolute;"><a href='javascript:history.back(1)'>&lt;&lt;Back</a></div>
<DIV id="formbox">
	<H2 style="margin:auto auto;text-align:center;width:450px;">New Account Registration</H2>
	<FORM action="ALPHA_igbedigi.php" method="POST" onsubmit="return checkForm()">
	<P>Please complete the form below.</P>
	<FIELDSET class="login"><LEGEND>Login Details</LEGEND>			 
	<DIV>
	<LABEL for="username">Username</LABEL> 
	<INPUT name="username" id="username" type="text" required>			 
	</DIV>
	<DIV>
	<LABEL for="password">Password</LABEL> 
	<INPUT name="password" id="password" type="password" required>			 
	</DIV>
	<DIV>
	<LABEL for="password2">Retype Password</LABEL> 
	<INPUT name="password2" id="password2" type="password" required>			 
	</DIV>
	<DIV>
	<LABEL for="acc_type">Account Type</LABEL> 
	<select name="acc_type" id="acc_type" required>
	<option value="standard" />Standard User</option>
	<option value="admin" />Administrator</option>
	</select>

	</DIV>
	</FIELDSET>
	<FIELDSET class="contact">
	<LEGEND>User Details</LEGEND>			 
	<DIV>
	<LABEL for="firstname">First Name</LABEL> 
	<INPUT name="firstname" id="firstname" type="text" required>			 
	</DIV>
	<DIV>
	<LABEL for="lastname">Last Name</LABEL> 
	<INPUT name="lastname" id="lastname" type="text" required>			 
	</DIV>
	<DIV class="radio">
	<FIELDSET>
	<LEGEND>
	<SPAN>Gender</SPAN>
	</LEGEND>					 
	<DIV>
	<INPUT name="gender" id="male" type="radio" value="male" checked> 
	<LABEL for="male">Male</LABEL>					 
	</DIV>
	<DIV>
	<INPUT name="gender" id="female" type="radio" value="female"> 
	<LABEL for="female">Female</LABEL>
	</DIV>
	</FIELDSET>
	</DIV>

	<DIV>
	<LABEL for="email">Email</LABEL>
	<INPUT name="email" class="email" id="email" type="email">			 
	</DIV></FIELDSET>

	<DIV>
	<BUTTON id="submit-go" name="submitregform" type="submit">CREATE USER</BUTTON>
	</DIV>
	</FORM>
</DIV>
</BODY>
</HTML>

<script>
<!--
document.forms[0].elements[1].focus();
//-->

function checkForm(){
var err = 0;
	var pwd = document.getElementById("password").value;
	var pwd2 = document.getElementById("password2").value;
	var userid = document.getElementById("username").value;
	if((pwd == "") || (pwd == "")){
	alert("All Fields Must Be filled Out");
	return false;
	}else if(pwd != pwd2){
	alert("New Password Fields Must Match");
	return false;
	}
	else if(pwd.length<6){
	alert("Password Should Be at least 6 characters Long");
	return false;
	}
	if(userid.length<3){
	alert("Username is Too short to be Valid");
	return false;
	}
	else{
	return true;
	}

}
</script>
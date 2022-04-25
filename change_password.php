<?php	
		
		include("incs/libs.header.incs.php");	

		
		require("incs/check_libs.inc.php");
		
		$notification = "";

		if (isset($_POST['change_passwrd'])) $notification = $tuwo->reset_user_password();
		
?> 


    </head>
    <body class="page-forgot">
        <main class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
					 <div class="row">
                        <div class="col-md-4 center">
							<div class="login-box panel panel-white">
								<div class="panel-body">
									<a href="index.html" class="logo-name text-lg text-center">AE-FUNAI CAMS</a>
									<p class="text-center m-t-md">Use the form below to reset your password</p>
									<div class="col-md-12"><?php echo $notification; ?></div>
									<form method="POST" name="change_passwrd" class="m-t-md">
										<div class="form-group">
											<input type="text" name="username" class="form-control" placeholder="Username" required>
										</div>
										<div class="form-group">
											<input type="password" name='newPassword' class="form-control" placeholder="Password" required>
										</div>
										<div class="form-group">
											<input type="password" name='cNewPassword' class="form-control" placeholder="Confirm Password" required>
										</div>
										<div class="form-group">
											<select class="form-control m-b-md" name = "user_type" id = "user_type"required>
												<option value="">Login as</option>
												<option value = '2'>Fresher</option>
												<option value = '1'>Staff</option>
											</select>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-primary btn-block"  value="Change Password" >
											<input type = "hidden" name = "change_passwrd">
										</div>
										
										
										
										
										<a href="index.php" class="btn btn-default btn-block m-t-md">Back</a>
									</form>
									<p class="text-center m-t-xs text-sm">Copyright &copy; 2017 - <?php echo date("Y"); ?>. <b>CAMS</b> Powered by <b>AE-FUNAI ICT.</b></p>
								</div>
							</div>
                        </div>
                    </div><!-- Row -->
				</div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
	
<?php	include("incs/libs.footer.incs.php");	?>
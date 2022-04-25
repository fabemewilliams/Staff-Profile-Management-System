<?php	
		include_once("includes/sp.staff.header.inc.php");
		
		//$tuwo->extract_fresher_admission_data($sess_username);
		
		//$tuwo->test_here($sess_username);
		
		$notification = "";

		//$tuwo->check_jamb_admission($sess_username,$sess_fullname);
		//$tuwo->check_acceptance_fee($sess_username,$sess_fullname);
		
		//$tuwo->pass_contact_details($sess_id);
		
		if (isset($_POST['change_passwrd'])) $notification = $tuwo->reset_user_password($sess_id);
	
	?>
	<div class="page-inner">
		
		<div class="page-title">
			<div class="container">
				<h3><?php echo $page_title; ?></h3>
			</div>
		</div>
		<div id="main-wrapper" class="container">
			
		<?php	//include("includes/fresher.statsbar.lib.inc.php");	?>
		
		    <div class="row">
				<div class="col-md-4 center">
					<div class="login-box panel panel-white">
						<div class="panel-body">
							<p class="text-center m-t-md">Use the form below to reset your password</p>
							<div class="col-md-12"><?php echo $notification; ?></div>
							<form method="POST" name="change_passwrd" class="m-t-md">
								<div class="form-group">
									<input type="password" name='newPassword' class="form-control" placeholder="Password" required>
								</div>
								<div class="form-group">
									<input type="password" name='cNewPassword' class="form-control" placeholder="Confirm Password" required>
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-primary btn-block"  value="Change Password" >
									<input type = "hidden" name = "change_passwrd">
								</div>
								
								
								
								
								<a href="index.php" class="btn btn-default btn-block m-t-md">Home</a>
							</form>
							
						</div>
					</div>
				</div>
			</div><!-- Row -->
                
	
	
		</div><!-- Main Wrapper -->	
	
		<script>
			
			$(document).ready(function() {
			  $("#word_count").on('keyup', function() {
				var words = 0;

				if ((this.value.match(/\S+/g)) != null) {
				  words = this.value.match(/\S+/g).length;
				}

				if (words > 200) {
				  // Split the string on first 250 words and rejoin on spaces
				  var trimmed = $(this).val().split(/\s+/, 200).join(" ");
				  // Add a space at the end to make sure more typing creates new words
				  $(this).val(trimmed + " ");
				}
				else {
				  $('#display_count').text(words);
				  $('#word_left').text(200-words);
				}
			  });
			}); 

		</script>	
				
	<?php	include("includes/staff.footer.lib.inc.php")	?>  
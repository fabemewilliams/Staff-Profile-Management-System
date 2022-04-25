<?php	
		include_once("includes/sp.staff.header.inc.php");
		
		//$tuwo->extract_fresher_admission_data($sess_username);
		
		//$tuwo->test_here($sess_username);
		
		$notification = "";

		//$tuwo->check_jamb_admission($sess_username,$sess_fullname);
		//$tuwo->check_acceptance_fee($sess_username,$sess_fullname);
		
		//$tuwo->pass_contact_details($sess_id);
		
		$tuwo->get_contact_details_for_edit($sess_id);
		
		if (isset($_POST['update_contact_details'])) $notification = $tuwo->update_contact_details($sess_id);
	
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
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-white">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">Contact Details</h4>
						</div>
						<div class="panel-body">
							<div class="col-md-12">
								<?php echo $notification; ?>
							</div>
							<div class="col-md-12">
								<div class="row">
									<form name = "update_contact_details" method="POST" >
										<div class="form-group col-md-12">
											<div class="form-group">
												<label>Phone Number</label>
												<?php echo "<input type='tel' name='phone_number' class = 'form-control' pattern='[0-9]{11}' value = '$tuwo->phone_number' autocomplete = 'off' data-toggle = 'tooltip' title = 'Enter Phone Number' required = 'required'>"; ?>
											</div>
										</div>
										<div class="form-group col-md-12">
											<div class="form-group">
												<label>Institutional Email Address</label>
												<?php echo "<input type='email' name='funai_email' class = 'form-control' value = '$tuwo->funai_email' autocomplete = 'off' data-toggle = 'tooltip' title = 'Enter Institutional Email Address' required = 'required'>"; ?> 
											</div>
										</div>
										<div class="form-group col-md-12">
											<div class="form-group">
												<label>Alternate Email Address</label>
												<?php echo "<input type='email' name='alternate_email' class = 'form-control' value = '$tuwo->alternate_email' autocomplete = 'off' data-toggle = 'tooltip' title = 'Enter Alternate Email Address' required = 'required'>"; ?>
											</div>
										</div>
										
										<div class="form-group col-md-12">
											<div class="form-group">
												<button type="submit" name = "update_contact_details" class='btn btn-success btn-addon m-b-sm btn-md'><i class='fa fa-plus-square'></i>Update Personal Details</button>
												<input type = "hidden" name = "update_contact_details">
											</div>
										</div>
									</form>
								</div>
							</div>
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
<?php	
		include_once("includes/sp.staff.header.inc.php");
		
		//$tuwo->extract_fresher_admission_data($sess_username);
		
		//$tuwo->test_here($sess_username);
		
		$notification = "";

		
		$tuwo->pass_personal_details($sess_id);
		
		if (isset($_POST['add_personal_details'])) $notification = $tuwo->add_personal_details($sess_id);
	
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
				<div class="col-md-10 col-md-offset-1">
					<div class="panel panel-white">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">Personal Details</h4>
						</div>
						<div class="panel-body">
							<div class="col-md-12">
								<?php echo $notification; ?>
							</div>
							<div class="col-md-12">
								<div class="row">
									<form name = "add_personal_details" method="POST" >
										<div class="form-group col-md-6">
											<label for="title">Title</label>
											<select class="form-control" name = "title_id" id="title_id" data-toggle = "tooltip"  title = "Select Title" required>
												<option value = "">Select Staff's Title</option>
												<?php $tuwo->extract_title(); ?>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="title">Staff Job Title</label>
											<select class="form-control" name = "job_title_id" id="job_title_id" data-toggle = "tooltip"  title = "Select Title" required>
												<option value = "">Select Staff's Job  Title</option>
												<?php $tuwo->extract_job_title(); ?>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="title">Department</label>
											<select class="form-control" name = "department_id" id="department_id" data-toggle = "tooltip"  title = "Select Title" required>
												<option value = "">Select Department</option>
												<?php $tuwo->extract_department(); ?>
											</select>
										</div>
										
										<div class="form-group col-md-6">
											<div class="form-group">
												<label>Last Name</label>
												<input type='text' name='last_name' class = 'form-control'  placeholder='Enter Last Name'	required='required'>
											</div>
										</div>
										
										<div class="form-group col-md-6">
											<div class="form-group">
												<label>Middle Name</label>
												<input type='text' name='middle_name' class = 'form-control'  placeholder='Enter Middle Name'>
											</div>
										</div>
										
										<div class="form-group col-md-6">
											<div class="form-group">
												<label>First Name</label>
												<input type='text' name='first_name' class = 'form-control'  placeholder='Enter First Name'	required='required'>
											</div>
										</div>
										<div class="form-group col-md-12">
											<label>Biography <br/>
														<small>
															(Education/Professional Experience/Professional Accomplishments)
														</small>
												</label>
												<div class="compose-message">
													 <textarea class="summernote form-control" name="biography" id="word_count" rows="12" data-toggle = "tooltip"  title = "Limit Biography to 200 words to avoid truncation" maxlength='1500' required='required'> </textarea>
													 
												</div>
												
												<small>Total word count: <span id="display_count" >0</span> words. Words left: <span id="word_left">200</span></small>
										</div>
										<div class="form-group col-md-12">
											<div class="form-group">
												<button type="submit" name = "add_contact_details" class='btn btn-success btn-addon m-b-sm btn-md'><i class='fa fa-plus-square'></i>Add Personal Details</button>
												<input type = "hidden" name = "add_personal_details">
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
		var max_count = 200;
		$(document).ready(function() {
		  var wordCounts = {};

		  $("#word_count").on('keyup', function() {
			var words = this.value.match(/\S+/g).length;
			if (words > max_count) {
			  // Split the string on first 200 words and rejoin on spaces
			  var trimmed = $(this).val().split(/\s+/, max_count).join(" ");
			  // Add a space at the end to keep new typing making new words
			  $(this).val(trimmed + " ");
			} else {
			  $('#display_count').html(words);
			  $('#count_left').html(max_count - words);
			}
		  });


		}).keyup();
	
	
	</script>
	
	<?php	include("includes/staff.footer.lib.inc.php")	?>  
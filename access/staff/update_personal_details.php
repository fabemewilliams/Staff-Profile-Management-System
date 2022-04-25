<?php	
		include_once("includes/sp.staff.header.inc.php");
		
		$notification = "";

		$tuwo->get_personal_details_for_edit($sess_id);
		
		if (isset($_POST['update_personal_details'])) $notification = $tuwo->update_personal_details($sess_id);
	
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
							<h4 class="panel-title">Personal Details</h4>
						</div>
						<div class="panel-body">
							<div class="col-md-12">
								<?php echo $notification; ?>
							</div>
							<div class="col-md-12">
								<div class="row">
									<form name = "update_personal_details" method="POST" >
										<div class="form-group col-md-6">
											<label for="title">Title</label>
											<select class="form-control" name = "title_id" id="title_id" data-toggle = "tooltip"  title = "Select Title" required="required">
												<?php echo "<option value = '{$tuwo->staff_title_id}'>$tuwo->staff_title</option>"; 
													$tuwo->extract_title(); ?>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="title">Staff Job Title</label>
											<select class="form-control" name = "job_title_id" id="job_title_id" data-toggle = "tooltip"  title = "Select Title" required="required">
												<?php echo "<option value = '{$tuwo->staff_title_id}'>$tuwo->staff_job_title</option>"; 
												$tuwo->extract_job_title(); ?>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="title">Department</label>
											<select class="form-control" name = "department_id" id="department_id" data-toggle = "tooltip"  title = "Select Title" required="required">
												<?php	echo "<option value = '{$tuwo->department_id}'>$tuwo->department</option>";	
														$tuwo->extract_department();	?>
											</select>
										</div>
										
										<div class="form-group col-md-6">
											<div class="form-group">
												<label>Last Name</label>
												<?php echo "<input type='text' class='form-control' name = 'last_name' value = '$tuwo->last_name' autocomplete = 'off' data-toggle = 'tooltip' title = 'Enter your Last Name' required = 'required'>"; ?>
												
											</div>
										</div>
										
										<div class="form-group col-md-6">
											<div class="form-group">
												<label>Middle Name</label>
												<?php echo "<input type='text' class='form-control' name = 'middle_name' value = '$tuwo->middle_name' autocomplete = 'off' data-toggle = 'tooltip' title = 'Enter your Middle Name'>"; ?>
											</div>
										</div>
										
										<div class="form-group col-md-6">
											<div class="form-group">
												<label>First Name</label>
												<?php echo "<input type='text' class='form-control' name = 'first_name' value = '$tuwo->first_name' autocomplete = 'off' data-toggle = 'tooltip' title = 'Enter your First Name' required='required'>"; ?>
											</div>
										</div>
										<div class="form-group col-md-12">
											<div class="form-group">
												<label>Biography <br/>
														<small>
															(Education/Professional Experience/Professional Accomplishments)
														</small>
												</label>
												<div class="compose-message">
													
													<textarea class='form-control' name='biography' id='word_count' rows='12' autocomplete = 'off' data-toggle = 'tooltip'  title = 'Limit Biography to 200 words to avoid truncation'   required='required'><?php echo $tuwo->biography	?></textarea>
													
												</div>
												<small>Total word count: <span id="display_count" >0</span> words. Words left: <span id="word_left">200</span></small>
											</div>
										</div>
										<div class="form-group col-md-12">
											<div class="form-group">
												<button type="submit" name = "update_personal_details" class='btn btn-success btn-addon m-b-sm btn-md'><i class='fa fa-plus-square'></i>Update Personal Details</button>
												<input type = "hidden" name = "update_personal_details">
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
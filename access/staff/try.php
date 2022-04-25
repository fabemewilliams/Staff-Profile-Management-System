<?php	
		include_once("includes/sp.staff.header.inc.php");
		
		//$tuwo->extract_fresher_admission_data($sess_username);
		
		//$tuwo->test_here($sess_username);
		
		$notification = "";

		//$tuwo->check_jamb_admission($sess_username,$sess_fullname);
		//$tuwo->check_acceptance_fee($sess_username,$sess_fullname);
		
		//$tuwo->pass_personal_details($sess_id);
		
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
									<form name = "add_personal_details" method="POST" >
										<div class="form-group col-md-12">
											<div class="form-group">
												<label>Biography <br/>
														<small>
															(Education/Professional Experience/Professional Accomplishments)
														</small>
												</label>
												<div class="compose-message">
														<div class="word_count">
														<span></span>
														</div>
														<textarea id="textarea"></textarea>
													 
												</div>
												
												
											</div>
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
			
			var maxWords = 20;
jQuery('textarea').keypress(function() {
    var $this, wordcount;
    $this = $(this);
    wordcount = $this.val().split(/\b[\s,\.-:;]*/).length;
    if (wordcount > maxWords) {
        jQuery(".word_count span").text("" + maxWords);
        alert("You've reached the maximum allowed words.");
        return false;
    } else {
        return jQuery(".word_count span").text(wordcount);
    }
});

jQuery('textarea').change(function() {
    var words = $(this).val().split(/\b[\s,\.-:;]*/);
    // console.log(words.length);
    if (words.length > maxWords) {
        words.splice(maxWords);
        $(this).val(words.join(""));
        alert("You've reached the maximum allowed words. Extra words removed.");
    }
    // console.log(words.length);
});
		</script>	
				
	<?php	include("includes/staff.footer.lib.inc.php")	?>  
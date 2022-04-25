<?php	
		include_once("includes/sp.staff.header.inc.php");
		
		//$tuwo->extract_fresher_admission_data($sess_username);
		
		//$tuwo->test_here($sess_username);
		
		$notification = "";

		
		$tuwo->pass_staff_details($sess_id);
		
		if (isset($_POST['add_staff_data'])) $notification = $tuwo->add_staff_details($sess_id);
	
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
						<div class="panel-body">
							<div class="col-md-12">
								<?php echo $notification; ?>
							</div>
							<div class="col-md-12">
								<div class="row">
									<form name = "add_staff_data" method="POST" >
										<div class="form-group col-md-12">
											<div class="form-group">
												<label>Research Gate Link</label>
												<input type='url' name='research_gate_id' class = 'form-control' placeholder='Enter Research Gate ID'	required='required'>
											</div>
										</div>
										<div class="form-group col-md-12">
											<div class="form-group">
												<label>Google Scholar Link</label>
												<input type='url' name='google_scholar_id' class = 'form-control' placeholder='Enter Google Scholar ID'	required='required'>
											</div>
										</div>
										<div class="form-group col-md-12">
											<div class="form-group">
												<label>ORCID</label>
												<input type='text' name='orc_id' class = 'form-control' placeholder='Enter ORCID'	required='required'>
											</div>
										</div>
										<div class="form-group col-md-12">
											<div class="form-group">
												<button type="submit" name = "add_staff_data" class='btn btn-success btn-addon m-b-sm btn-md'><i class='fa fa-plus-square'></i>Add Staff Details</button>
												<input type = "hidden" name = "add_staff_data">
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
			
				
	<?php	include("includes/staff.footer.lib.inc.php")	?>  
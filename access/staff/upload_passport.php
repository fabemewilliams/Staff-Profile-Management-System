<?php	
		include_once("includes/sp.staff.header.inc.php");
		
		//$tuwo->extract_fresher_admission_data($sess_username);
		
		//$tuwo->test_here($sess_username);
		
		$notification = "";

		$tuwo->pass_passport($sess_id);
		
		if (isset($_POST['upload_passport'])) $notification = $tuwo->upload_staff_passport($sess_id);
	
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
									<form  method="post" enctype="multipart/form-data" name="upload_passport">
									<div class="tab-content">
										<div class="tab-pane active fade in" id="tab1">
											<div class="row m-b-lg">
												<div class="col-md-12">
													<div class="row">
														<div class="form-group col-md-12">
															<label>Staff Passport</label><br/>
															<small>
															Formats allowed: jpg,png | Max File Size: 300kb
														</small>
															<input type="file" id="uploaded" name = "uploaded" class="form-control" required>
														</div>	
													</div>	
												</div>	
											
										
												<div class="form-group col-md-12">
													<div class="form-group">
														<button type="submit" name = "upload_passport" class='btn btn-success btn-addon m-b-sm btn-md'><i class='fa fa-plus-square'></i>Add Passport</button>
														<input type = "hidden" name = "upload_passport">
													</div>
												</div>
											</div>
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
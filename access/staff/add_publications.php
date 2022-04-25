<?php	
		include_once("includes/sp.staff.header.inc.php");
		
		//$tuwo->extract_fresher_admission_data($sess_username);
		
		//$tuwo->test_here($sess_username);
		
		$notification = "";

		
		//$tuwo->pass_staff_details($sess_id);
		
		if (isset($_POST['add_publication'])) $notification = $tuwo->add_staff_publication($sess_id);
	
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
				<div class="col-md-8 center">
					<div class="panel panel-white">
						<div class="panel-body">
							<div class="col-md-12">
								<?php echo $notification; ?>
							</div>
							<div class="col-md-12">
								<div class="row">
									<form name = "add_publication" method="POST" >
										<div class="form-group col-md-12">
											<div class="form-group">
												<label>Publication <br/>
														<small>
															Use the textarea below to paste the title of each of your publications or links and click <b>Add Publication</b> to save publication into database.
														</small>
												</label>
												<div class="compose-message">
													 <textarea class="form-control" name="publication" id="staff_publication" rows="6" data-toggle = "tooltip"  title = "Paste Staff Publications or Links" required> </textarea>
												</div>
											</div>
										</div>
										
										<div class="form-group col-md-12">
											<div class="form-group">
												<button type="submit" name = "add_publication" class='btn btn-success btn-addon m-b-sm btn-md'><i class='fa fa-plus-square'></i>Add Publication</button>
												<input type = "hidden" name = "add_publication">
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
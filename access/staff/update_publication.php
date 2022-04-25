<?php	
		include_once("includes/sp.staff.header.inc.php");
		
		$notification = "";

		//$p_id = isset($_REQUEST['p_id']) ?  (int)$_REQUEST['p_id'] : $tuwo->goto_notify("add_publications.php","No such publication in the database!");
		
		$tuwo->get_staff_publication_for_edit($sess_id);
		
		if (isset($_POST['update_publication'])) $notification = $tuwo->update_staff_publication($p_id);
	
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
									<form name = "update_publication" method="POST" >
										<div class="form-group col-md-12">
											<div class="form-group">
												<label>Publication <br/>
														<small>
															Use the textarea below to paste the title of each of your publications or links and click <b>Update Publication</b> saved in the database.
														</small>
												</label>
												<div class="compose-message">
													 <textarea class="form-control" name="publication" id="publication" rows="6" data-toggle = "tooltip"  title = "Paste Staff Publication or Link" required><?php	echo $tuwo->publication;	?> </textarea>
												</div>
											</div>
										</div>
										
										<div class="form-group col-md-12">
											<div class="form-group">
												<button type="submit" name = "update_publication" class='btn btn-success btn-addon m-b-sm btn-md'><i class='fa fa-plus-square'></i>Update Publication</button>
												<input type = "hidden" name = "update_publication">
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
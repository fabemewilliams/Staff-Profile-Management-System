<?php	
	include_once("includes/sp.staff.header.inc.php");
	
	//$tuwo->test_here($sess_id);
	
	$tuwo->extract_staff_data($sess_id);
?>
	<div class="page-inner">
		
		<div class="page-title">
			<div class="container">
				<h3><?php echo $page_title; ?></h3>
			</div>
		</div>
		<div id="main-wrapper" class="container">
			
			<?php	//include("includes/staff.statsbar.lib.inc.php");	?>
			
			<div class="row">
				<div class="col-md-6 col-md-offset-3 center">
					<div class="alert alert-success text-center" role="alert">
						<b><?php echo "WELCOME $tuwo->staff_fullname";	?></b>
					</div>
				</div>
				
				<?php $notification = $tuwo->setup_profile($sess_id);	?>
				
			</div>
		
		</div><!-- Main Wrapper -->	
			
				
	<?php	include("includes/staff.footer.lib.inc.php");	?>  
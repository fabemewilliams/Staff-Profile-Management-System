<div class="col-lg-12">
	<div class="section-title with-desc text-left clearfix">
		<div class="title-header">
			<h5><?php	//echo $tuwo->faculty; ?></h5>
			<h2 class="title">Teaching Staff</h2>
		</div>
	</div><!-- section title end -->
</div>
<?php 
		

		
	
		$count_result = count($tuwo->staff_id);
		
		
		if($count_result<1){	
				echo "<p>There is no staff profile for this faculty yet!</p>
				";
				return;							
			}
		else{
				for($i=0; $i<$count_result; $i++){	
				
				
				if($tuwo->staff_passport[$i] ==""){
					echo"<div class='col-md-4 col-lg-3 col-sm-4 col-xs-2'>
						<!-- featured-imagebox-services -->
						<div class='product'><!-- product -->
							<div class='featured-thumbnail'><!-- featured-thumbnail -->
								<img class='img-fluid' src='images/user-passport.png' alt='Staff Passport' style='width:294px; height:190px;'>
								<div class='ttm-blog-overlay-iconbox'>
									<a href='single-blog.html'><i class='ti ti-plus'></i></a>
								</div>
								<div class='ttm-box-view-overlay'></div>
							</div>
							<div class='product-content text-left'><!-- product-content -->
								<div class='product-title'><!-- product-title -->
									<p style='text-align:center; margin-bottom:-10px; margin-top:-10px;'><b>{$tuwo->staff_title[$i]} {$tuwo->staff_l_name[$i]}  {$tuwo->staff_f_name[$i]}</b>
									<br>{$tuwo->staff_job_title[$i]}</p>
									<hr/>
									<p style='text-align:center; margin-bottom:-10px; margin-top:-10px;'><a href='staff_profile.php?s_id={$tuwo->staff_id[$i]}' target='_blank'><b>View Personal Profile</b></a></p>
								</div>
							</div>
						</div>
					</div>";
				}
				else{
					echo"<div class='col-md-4 col-lg-3 col-sm-4 col-xs-2'>
						<!-- featured-imagebox-services -->
						<div class='product'><!-- product -->
							<div class='featured-thumbnail'><!-- featured-thumbnail -->
								<img class='img-fluid' src='access/common.inc/staff_passport/{$tuwo->staff_passport[$i]}' alt='Staff Passport' style='width:294px; height:190px;'>
								<div class='ttm-blog-overlay-iconbox'>
									<a href='single-blog.html'><i class='ti ti-plus'></i></a>
								</div>
								<div class='ttm-box-view-overlay'></div>
							</div>
							<div class='product-content text-left'><!-- product-content -->
								<div class='product-title'><!-- product-title -->
									<p style='text-align:center; margin-bottom:-10px; margin-top:-10px;'><b>{$tuwo->staff_title[$i]} {$tuwo->staff_l_name[$i]}  {$tuwo->staff_f_name[$i]}</b>
									<br>{$tuwo->staff_job_title[$i]}</p>
									<hr/>
									<p style='text-align:center; margin-bottom:-10px; margin-top:-10px;'><a href='staff_profile.php?s_id={$tuwo->staff_id[$i]}' target='_blank'><b>View Personal Profile</b></a></p>
								</div>
							</div>
						</div>
					</div>";
				}
				
				
			}
		}
		
	
?>

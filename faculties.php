<?php	include("includes/adv.header.libs.php");	?>	

        <!--site-main start-->
        <div class="site-main">

            <!-- aboutus-section -->
            <section class="ttm-row aboutus-section-style2 clearfix">
                <div class="container">
					<div class="row no-gutters align-items-center"><!-- row -->
                        
						
						<div class="row m-0 mt-35">
							<div class="col-lg-12">
								<div class="row box-shadow spacing-11">
									<div class="col-md-6 col-lg-12 col-xl-6">
										<div class="ttm_single_image-wrapper">
											<img class="img-fluid" src="images/best-graduand.png" alt="Best Graduand">
										</div>
									</div>
									<div class="col-md-6 col-lg-12 col-xl-6">
										<p class="mb-30 res-1199-mt-20">Alex Ekwueme Federal University, Ndufu-Alike (AE-FUNAI) runs its academic programmes through the faculty and collegiate system. 
										Each faculty/college houses various departments.</p>
											
											<?php	$tuwo->extract_faculty_list(); 	
													
													if($tuwo->id <=0)
														{
															$count_data = 0;

															echo "<ul class='ttm-list ttm-list-style-icon'>
																	<li><i class='fa fa-check-circle ttm-textcolor-skincolor'></i>
																		<span class='ttm-list-li-content'>
																			There is no record in this table
																		</span></li>
																	</ul>";	
														}
													
													else
														{			
															$count_data = count($tuwo->id);
															
															for($i=0,$j=1; $i<$count_data; $i++,$j++){
																
																echo "<ul class='ttm-list ttm-list-style-icon'>";
																	echo "<li><i class='fa fa-check-circle ttm-textcolor-skincolor'></i><span class='ttm-list-li-content'>
																		  <a href='faculty.php?f_id={$tuwo->id[$i]}' target='_blank'>{$tuwo->faculty[$i]}</a>
																		  </span></li>";
																echo "</ul>";	
															}
														}
											?>
											
									</div>
								</div>
							</div>
							</div>

                    </div>
                    <!-- row end -->
                </div>
            </section>
            <!-- aboutus-section end -->
		</div><!--site-main end-->

<?php	include("includes/adv.footer.libs.php");	?>
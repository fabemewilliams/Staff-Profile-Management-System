<?php	
		include("includes/adv.header.libs.php");	

		$notification = '';
		
		$s_id 	= 	$_REQUEST['s_id']?(int)$_REQUEST['s_id']:0;
		if($s_id <=0) $tuwo->goto_notify("faculties.php");
		
		$tuwo->extract_staff_details($s_id);
		
		$tuwo->extract_staff_publications($s_id);
		
		//$tuwo->extract_staff_contact_details($s_id);

?>

        <!-- page-title -->
        <div class="ttm-page-title-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="title-box text-center">
                            <div class="page-title-heading">
                                <h1 class="title">Staff Profile</h1>
                            </div><!-- /.page-title-captions -->
                            <div class="breadcrumb-wrapper">
                                <span>
                                    <a title="Homepage" href="index.html"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                                </span>
                                <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                                <span><?php echo $tuwo->staff_fullname;	?></span>
                            </div>  
                        </div>
                    </div><!-- /.col-md-12 -->  
                </div><!-- /.row -->  
            </div><!-- /.container -->                      
        </div><!-- page-title end-->

        <!--site-main start-->
        <div class="site-main">

            <!-- team-details-section -->
            <section class="ttm-row team-details-section clearfix">
                <div class="container">
                    <div class="row"><!-- row -->
                     
						<?php	include("includes/staff_profile_contact_details.php");	?>
					
					</div>
                    <!-- row end -->
                    <div class="row"><!-- row -->
                        <div class="col-md-12">
                            
                            <!-- progress-bar -->
                            <div class="ttm-progress-bar" data-percent="100%">
                                <div class="progress-bar-inner">
                                    <div class="progress-bar progress-bar-color-bar_skincolor"></div>
                                </div>
                            </div>
                            <!-- progress-bar END -->
                        </div>
                    </div>
                    <!-- row end -->
                    <div class="row mt-40">
                        <div class="col-md-12">
							<h4>Biography</h4>
							<?php	
									if($tuwo->staff_biography == ""){
										echo "<p class='mb-40'>No information yet!</p>";
									}
									
									else{
										echo "<p class='mb-40'>$tuwo->staff_biography </p>";
									}
							?>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-12" id="publicationss">
                            <h4>Selected Publications (Articles and Journals)</h4>
                           <?php	include("includes/staff_profile_publications.php");	?>
                        </div>
                    </div>
					
                    
                </div>
            </section>
            <!-- team-details-section -->
           
            
        </div><!--site-main end-->

<?php	include("includes/adv.footer.libs.php");	?>
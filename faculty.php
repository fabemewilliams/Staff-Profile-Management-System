<?php	include("includes/adv.header.libs.php");	?>

<?php
		$notification = '';
		
		$f_id 	= 	$_REQUEST['f_id']?(int)$_REQUEST['f_id']:0;
		
		if($f_id <=0) $tuwo->goto_notify("faculties.php");
		
		$tuwo->extract_faculty_details($f_id);
		

		$tuwo->extract_faculty_t_staff_list($f_id);
		
		//$tuwo->extract_faculty_info($f_id);
		
		
?>
        <!-- page-title -->
        <div class="ttm-page-title-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="title-box text-center">
                            <div class="page-title-heading">
                                <h1 class="title"> Faculty Home</h1>
                            </div><!-- /.page-title-captions -->
                            <div class="breadcrumb-wrapper">
                                <span>
                                    <a title="Homepage" href="faculties.php"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                                </span>
                                <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                                <span> <?php	echo $tuwo->faculty; ?></span>
                            </div>  
                        </div>
                    </div><!-- /.col-md-12 -->  
                </div><!-- /.row -->  
            </div><!-- /.container -->                      
        </div><!-- page-title end-->
		
        <!--site-main start-->
        <div class="site-main">
        <!-- sidebar -->
        <div class="sidebar ttm-sidebar ttm-bgcolor-white clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 content-area order-lg-2">
                        <!-- ttm-service-single-content-are -->
                        <!-- ttm-service-single-content-are -->
                        <div class="ttm-service-single-content-area">
                            <!-- row -->
							<div class="row">
								<?php	include("includes/adv_faculty_t_staff_profile_list.php");	?> 
							</div><!-- row end -->
							
                        <!-- ttm-service-single-content-are end -->
                    </div>
                    </div>
					
                   
                </div><!-- row end -->
            </div>
        </div>
        <!-- sidebar end -->
    </div><!--site-main end-->


    <?php	include("includes/adv.footer.libs.php");	?>
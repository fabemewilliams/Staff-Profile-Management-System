<?php
function just_notify($msg,$mode=1){
		if($mode==1){
		$msg = "    
		<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert'>&times;</a>
        $msg
		</div>";
			}
		else{
		$msg = "<div class='alert alert-danger'>
		<a href='#' class='close' data-dismiss='alert'>&times;</a>
        $msg 
		</div>";

		}
		return $msg;
	}
	$errmsg = '';
	if(isset($_GET['paka'])){
		if($_GET['paka'] == 'invalid'){
			$errmsg = just_notify("Invalid username or password, please try again",2);
		}
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="HTML5 Template" />
<meta name="description" content="AE-FUNAI, Staff Profile" />
<meta name="author" content="https://www.fabwilliams.com" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>AE-FUNAI</title>

<!-- favicon icon -->
<link rel="shortcut icon" href="images/favicon.ico" />

<!-- bootstrap -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

<!-- animate -->
<link rel="stylesheet" type="text/css" href="css/animate.css"/>

<!-- owl-carousel -->
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">

<!-- fontawesome -->
<link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>

<!-- themify -->
<link rel="stylesheet" type="text/css" href="css/themify-icons.css"/>

<!-- flaticon -->
<link rel="stylesheet" type="text/css" href="css/flaticon.css"/>


<!-- REVOLUTION LAYERS STYLES -->

<link rel="stylesheet" type="text/css" href="revolution/css/rs6.css">

<!-- prettyphoto -->
<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">

<!-- shortcodes -->
<link rel="stylesheet" type="text/css" href="css/shortcodes.css"/>

<!-- main -->
<link rel="stylesheet" type="text/css" href="css/main.css"/>

<!-- responsive -->
<link rel="stylesheet" type="text/css" href="css/responsive.css"/>

</head>

<body>

    <!--page start-->
    <div class="page">

        <!-- preloader start -->
        <div id="preloader">
          <div id="status">&nbsp;</div>
        </div>
        <!-- preloader end -->

        <!--header start-->
        <header id="masthead" class="header ttm-header-style-01">
            <!-- ttm-topbar-wrapper -->
            <div class="ttm-topbar-wrapper clearfix">
                <div class="container">
                    <div class="ttm-topbar-content">
                        <ul class="top-contact text-left">
                            <li><i class="fa fa-map-marker"></i>Ndufu-Alike, Ebonyi State, NIGERIA.</li>
                            <li><i class="fa fa-envelope-o"></i><a href="mailto:profiles@funai.edu.ng">profiles@funai.edu.ng</a></li>
                        </ul>
                        <div class="topbar-right text-right">
                            <ul class="top-contact">
                                <li><i class="fa fa-clock-o"></i>Office Hour: 08:00am - 6:00pm</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- ttm-topbar-wrapper end -->
            <!-- ttm-header-wrap -->
            <div class="ttm-header-wrap">
                <!-- ttm-stickable-header-w -->
                <div id="ttm-stickable-header-w" class="ttm-stickable-header-w clearfix">
                    <div id="site-header-menu" class="site-header-menu">
                        <div class="site-header-menu-inner ttm-stickable-header">
                            <div class="container">
                                <!-- site-branding -->
                                <div class="site-branding">
                                    <a class="home-link" href="index.php" title="Altech" rel="home">
                                        <img id="logo-img" class="img-center" src="images/funai_logo.png" alt="logo">
                                    </a>
                                </div><!-- site-branding end -->
                                <!--site-navigation -->
                                <div id="site-navigation" class="site-navigation">
                                    <div class="ttm-rt-contact">
                                        <!-- header-icons -->
                                        <div class="ttm-header-icons ">
                                            <div class="ttm-header-icon ttm-header-search-link">
                                                <a href="#"><i class="ti ti-search"></i></a>
                                                <div class="ttm-search-overlay">
                                                    <form method="get" class="ttm-site-searchform" action="#">
                                                        <div class="w-search-form-h">
                                                            <div class="w-search-form-row">
                                                                <div class="w-search-input">
                                                                    <input type="search" class="field searchform-s" name="s" placeholder="Enter Staff Name Then Enter...">
                                                                    <button type="submit">
                                                                        <i class="ti ti-search"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- header-icons end -->
                                    </div>
									<div class="ttm-menu-toggle">
                                        <input type="checkbox" id="menu-toggle-form" />
                                        <label for="menu-toggle-form" class="ttm-menu-toggle-block">
                                            <span class="toggle-block toggle-blocks-1"></span>
                                            <span class="toggle-block toggle-blocks-2"></span>
                                            <span class="toggle-block toggle-blocks-3"></span>
                                        </label>
                                    </div>
                                    <nav id="menu" class="menu">
										<ul class="dropdown">
											<li><a href="index.php">Home</a></li>
											<li><a href="faculties.php">Faculties</a></li>
										</ul>
                                    </nav>
                                </div><!-- site-navigation end-->
                            </div>
                        </div>
                    </div>
                </div><!-- ttm-stickable-header-w end-->
            </div><!--ttm-header-wrap end -->

        </header><!--header end-->
	    <!--site-main start-->
        <div class="site-main">

            <div class="ttm-row only-one-section ttm-bgcolor-white clearfix">
                <div class="container">
					<div class="clearfix" style="margin-top: 30px;"></div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="coupon_toggle">
                                <div class="coupon_code">
                                    Have an account? <b>Login Using the form below!</b>
                                </div>
                            </div>
							<?php echo $errmsg;?>
                        </div>
						
						<div class="col-lg-4"></div>
						
						<div class="col-lg-4">	
							<form name="adv_login" action = "session/ALPHA_Process.php" method="POST" class="checkout row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Username<abbr>*</abbr></label>
                                                <input type="text" name="username" required placeholder="Enter Username" autofocus class="form-control border">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Password<abbr>*</abbr></label>
                                                <input type="password" name="passwrd" required placeholder="*************" class="form-control border">
                                            </div>
                                        </div>
										<br>
										<div class="col-sm-12" style="margin-top: 20px;">
                                            <div class="form-group">
                                                <div class="ttm-btn-box pr-20 pb-20">
													<button type="submit" name="adv_login" class="ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-border ttm-icon-btn-right ttm-btn-color-skincolor">Login <i class="ti ti-hand-point-right"></i></button>
													<input  type="hidden" name="adv_login">
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
						
						<div class="col-lg-4 center"></div>
                    </div><!-- row end -->
                </div>
            </div>
            <!-- sidebar end -->
		</div><!--site-main end-->

<?php	include_once("includes/adv.footer.libs.php");	?>	
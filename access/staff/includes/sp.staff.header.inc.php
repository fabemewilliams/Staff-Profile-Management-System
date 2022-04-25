<?php 
	session_start();
	if(!isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['acc_type'])){
	header('Location: ../../index.php');}
    //echo $_SESSION['acc_type'];exit();
	if (($_SESSION['acc_type_des'] != "staff") )
	{
		header('Location: ../../index.php?paka=bereofori897665');
	}
	else{
		$sess_id  				=	$_SESSION['id'];
		$sess_username   		=  	$_SESSION['username'];
		
		$sess_acc_type  		=  	$_SESSION['acc_type'];
		
		}
	require_once("staff_libs.inc.php");
	
	$page_title = basename($_SERVER['SCRIPT_FILENAME'], '.php');
	$page_title = str_replace('_', ' ', $page_title);
	if ($page_title == 'index') {
		$page_title = 'Dashboard';
	}

	$page_title = ucwords($page_title);
	
	$staff_lastname = $tuwo->get_this_data("lastname","sp_personal_details","user_id",$sess_id);
	
	$staff_title_id = $tuwo->get_this_data("title","sp_personal_details","user_id",$sess_id);
	$staff_title 	= $tuwo->get_this_data("title_name","sp_title","id",$staff_title_id);
	
	$the_passport = $tuwo->get_this_data("passport","sp_staff_passport","user_id",$sess_id);
	
	if($the_passport == ""){
		$passport = "images.jpg";
	}	
	else{
		$passport = $the_passport;
	}
	
	if($staff_lastname == ""){
		$the_staff_fulname = $sess_username;
	}	
	else{
		$the_staff_fulname = $staff_lastname;
	}
	
	if($staff_title_id == ""){
		$the_staff_title = "User";
	}	
	else{
		$the_staff_title = $staff_title;
	}
	
	$tuwo->extract_staff_details($sess_id);
	$tuwo->setup_update_menu($sess_id);
   
	

    //$tuwo->test_here($passport);
?>

<!DOCTYPE html>
<html>
    <head>
        
        <!-- Title -->
       
	   <title>SPMS | <?php if (isset($page_title)) {echo "{$page_title}";} ?></title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="SPMS Admin Dashboard" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Fab-Eme Williams" />
		
		<!-- favicon icon -->
		<link rel="shortcut icon" href="../../assets/images/favicon.ico" />

        
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href="../../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="../../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="../../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>	
        <link href="../../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../../assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>	
		<link href="../../assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../../assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>		
        <link href="../../assets/plugins/summernote/dist/summernote.css" rel="stylesheet" type="text/css"/>
		
		 
        	
        <!-- Theme Styles -->
        <link href="../../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="../../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
		 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		
		
		
		
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="page-header-fixed compact-menu page-horizontal-bar">
        <div class="overlay"></div>
        <main class="page-content content-wrap">
            <div class="navbar">
                <div class="navbar-inner container">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="index.php" class="logo-text"><span>SPMS</span></a>
                    </div><!-- Logo Box -->
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-left">
                                <li>		
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                                </li>
                                <li>
                                    <a href="#cd-nav" class="waves-effect waves-button waves-classic cd-nav-trigger"><i class="fa fa-diamond"></i></a>
                                </li>
                                <li>		
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-md dropdown-list theme-settings" role="menu">
                                        <li class="li-group">
                                            <ul class="list-unstyled">
                                                <li class="no-link" role="presentation">
                                                    Fixed Header 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right fixed-header-check">
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li-group">
                                            <ul class="list-unstyled">
                                                <li class="no-link" role="presentation">
                                                    Fixed Sidebar 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right fixed-sidebar-check">
                                                    </div>
                                                </li>
                                                <li class="no-link" role="presentation">
                                                    Toggle Sidebar 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right toggle-sidebar-check">
                                                    </div>
                                                </li>
                                                <li class="no-link" role="presentation">
                                                    Compact Menu 
                                                    <div class="ios-switch pull-right switch-md">
                                                        <input type="checkbox" class="js-switch pull-right compact-menu-check" checked>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="no-link"><button class="btn btn-default reset-options">Reset Options</button></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                               <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <span class="user-name">Welcome <?php	echo $the_staff_title." ".$the_staff_fulname;	?><i class="fa fa-angle-down"></i></span>
                                        <img class="img-circle avatar" src="../common.inc/staff_passport/<?php echo $passport; ?>" width="40" height="40" alt="">
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
										<li role="presentation"><a href="change_password.php"><i class="fa fa-lock"></i>Change Password</a></li>
										<li role="presentation" class="divider"></li>
                                        <li role="presentation"><a href="./index.php?paka=1"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                    </ul>
                                </li>
                            </ul><!-- Nav -->
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div><!-- Navbar -->
          
			<?php	include("includes/sp.staff.menu.inc.php");		?>
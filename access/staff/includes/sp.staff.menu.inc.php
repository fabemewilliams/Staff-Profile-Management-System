
	<div class="page-sidebar sidebar horizontal-bar">
		<div class="page-sidebar-inner">
			<ul id="menu" class="menu accordion-menu">
				<li class="nav-heading"><span>Navigation</span></li>
				<li><a href="index.php" target="_blank"><span class="menu-icon icon-speedometer active"></span><p>Dashboard</p></a></li>
				 
				<li class="droplink"><a href="#"><span class="menu-icon icon-notebook  active"></span><p> Update Details</p><span class="arrow"></span></a>
					<ul class="sub-menu">
						<li><a href="add_publications.php" target="_blank">View Publications</a></li>
						<?php	echo $tuwo->staff_details_link;	?>
						<?php	echo $tuwo->personal_details_link;	?>
						<?php	echo $tuwo->contact_details_link;	?>
					</ul>
				</li> 
				<li class="droplink"><a href="#"><span class="menu-icon icon-user  active"></span><p> Actions</p><span class="arrow"></span></a>
					<ul class="sub-menu">
						<li role="presentation"><a href="change_password.php"><i class="fa fa-lock m-r-xs"></i> Change Password</a></li>
						<li role="presentation" class="divider"></li>
						<li role="presentation"><a href="./index.php?paka=1"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
						
					</ul>
				</li>
			</ul>
		</div><!-- Page Sidebar Inner -->
	</div><!-- Page Sidebar -->
  
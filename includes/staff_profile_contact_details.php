   <div class="col-lg-4">
		<div class="ttm-featured-wrapper"> 
			<div class="featured-thumbnail text-center">
			<?php
				if($tuwo->staff_passport ==""){
					echo"<img class='img-fluid' src='images/user-passport.png' style='width:320px; height:375px;' alt='Staff Passport--'>";
				}
				else{
					echo"<img class='img-fluid' src='access/common.inc/staff_passport/$tuwo->staff_passport' style='width:320px; height:375px;' alt='Staff -- Passport'>";
				}
			?>
			
			</div> 
		</div>
	</div>
	<div class="col-lg-8">
		<div class="ttm-team-member-content shadow-box res-991-mt-30">
			<div class="ttm-team-member-single-list">
				<h2 class="ttm-team-member-single-title"><?php echo $tuwo->staff_fullname;	?></h2>
				<span class="ttm-team-member-single-position">
					<?php 
						if($tuwo->staff_job_title == ""){
							echo "--";
						}
						else{
							echo $tuwo->staff_job_title;	
						}
					?>
				</span>
				<!-- separator -->
				<div class="separator">
					<div class="sep-line mt-25 mb-25"></div>
				</div>
				<!-- separator -->
				<div class="ttm-team-data">
					<div class="ttm-team-details-wrapper">
						<ul class="ttm-team-details-list clearfix">
							<li>
								<div class="ttm-team-list-title"><i class="fa fa-home"></i> Faculty :</div>
								<div class="ttm-team-list-value">
									<?php 
										if($tuwo->the_staff_faculty == ""){
											echo "--";
										}
										else{
											echo $tuwo->the_staff_faculty;	
										}
									?>
								</div>
							</li>
							<li>
								<div class="ttm-team-list-title"><i class="fa fa-home"></i> Department :</div>
								<div class="ttm-team-list-value">
									<?php 
										if($tuwo->the_staff_department == ""){
											echo "--";
										}
										else{
											echo $tuwo->the_staff_department;	
										}
									?>
								</div>
							</li>
							<li>
								<div class="ttm-team-list-title"><i class="ti ti-email"></i> Official Email :</div>
								<div class="ttm-team-list-value">
									<a href="#">
										<?php 
											if($tuwo->official_email == ""){
												echo "--";
											}
											else{
												echo $tuwo->official_email;	
											}
										?>
									</a>
									</div>
							</li>
							<li>
								<div class="ttm-team-list-title"><i class="ti ti-email"></i> Alternate Email :</div>
								<div class="ttm-team-list-value">
									<?php 
										if($tuwo->alternate_email == ""){
											echo "--";
										}
										else{
											echo $tuwo->alternate_email;	
										}
									?>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- separator --> <!-- separator -->
				<div class="separator">
					<div class="sep-line mt-25 mb-25"></div>
				</div>
				<!-- separator -->
				<div class="ttm-team-data">
					<div class="ttm-team-details-wrapper">
						<ul class="ttm-team-details-list clearfix">
							<li>
								<div class="ttm-team-list-title"><i class="ti ti-google"></i> Google Scholar ID :</div>
								<div class="ttm-team-list-value">
									<?php 
										if($tuwo->google_scholar_id == ""){
											echo "--";
										}
										else{
											echo $tuwo->google_scholar_id;	
										}
									?>
								</div>
							</li>
							<li>
								<div class="ttm-team-list-title"><i class="ti ti-book"></i> Research Gate ID :</div>
								<div class="ttm-team-list-value">
									<?php 
										if($tuwo->research_gate_id == ""){
											echo "--";
										}
										else{
											echo $tuwo->research_gate_id;	
										}
									?>
								</div>
							</li>
							<li>
								<div class="ttm-team-list-title"><i class="ti ti-linkedin"></i> ORCID :</div>
								<div class="ttm-team-list-value">
									<?php 
										if($tuwo->orc_id == ""){
											echo "--";
										}
										else{
											echo $tuwo->orc_id;	
										}
									?>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<br/>
				<br/>
				<!-- separator -->
				<div class="separator">
					<div class="sep-line mt-15 mb-25"></div>
				</div>
				<!-- separator -->
			</div>
		</div>
	</div>
                    
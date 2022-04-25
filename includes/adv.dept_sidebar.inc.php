<aside class="widget widget-text">
	<h3 class="widget-title">The HOD</h3>
	<div class="ttm-author-widget">
		<div class="author-widget_img">
		<?php
			if($tuwo->hod_passport ==""){
				echo"<img class='author-img img-fluid' src='mods/common.inc/staff_passport/user-passport.png' alt='HOD Passport' style='width:294px; height:190px;'>";
			}
			else{
				echo"<img class='author-img img-fluid' src='mods/common.inc/staff_passport/$tuwo->hod_passport' alt='HOD Passport' style='width:294px; height:190px;'>";
				
			}
			?>
			
		</div>
		<?php	//$tuwo->extract_hod_details($d_id); 	?>
		<p style="text-align:center; margin-bottom:10px; margin-top:-10px;"><b><?php	echo $tuwo->hod_fullname; 		?></b></p>
		<p style="text-align:center; margin-bottom:-10px;"><?php echo "<a href='staff_profile.php?s_id=$tuwo->hod_staff_id' target='_blank'>";	?><b>View Personal Profile</b></a></p>
	</div>
</aside>






<aside class="widget widget-categories">
	<h3 class="widget-title">Programme</h3>
	<?php 

		if($tuwo->programme_id <=0){
			$count_data = 0;
			
			echo "<ul>
					<li><a href='#'>No record found in this Database</a></li>
				  </ul>
				";
		}
		else{
				$count_data = count($tuwo->programme_id);
					
					for($i=0,$j=1; $i<$count_data; $i++,$j++){
						echo "<ul>";
								echo"<li>
										<a href='department.php?d_id={$tuwo->programme_id[$i]}' >{$tuwo->the_programme_name[$i]}</a>
									</li>";
						echo "</ul>";
					}
		}
	?>
</aside>

<aside class="widget widget-text">
	<h3 class="widget-title">The Dean</h3>
	<div class="ttm-author-widget">
		<div class="author-widget_img">
			<?php
				if($tuwo->dean_passport ==""){
					echo"<img class='img-fluid' src='images/user-passport.png' style='width:320px; height:375px;' alt='Staff Passport--'>";
				}
				else{
					echo"<img class='img-fluid' src='mods/common.inc/staff_passport/$tuwo->dean_passport' style='width:320px; height:375px;' alt='Staff Passport'>";
					
				}
			?>
		</div>
		<?php	$tuwo->extract_dean_details($f_id); 	?>
		<p style='text-align:center;'><b><?php	echo $tuwo->dean_fullname; 		?></b></p>
		<p style='text-align:center;'><?php echo "<a href='staff_profile.php?s_id=$s_id' target='_blank'>";	?><b>View Personal Profile</b></a></p>
	</div>
</aside>






<aside class="widget widget-categories">
	<h3 class="widget-title">Departments</h3>
	<?php 
		$tuwo->extract_department_list($f_id);
		
		if($tuwo->id <=0){
			$count_data = 0;
			
			echo "<ul>
					<li><a href='#'>No record found in this Database</a></li>
				  </ul>
				";
		}
		else{
				$count_data = count($tuwo->id);
					
					for($i=0,$j=1; $i<$count_data; $i++,$j++){
						echo "<ul>";
								echo"<li>
										<a href='department.php?d_id={$tuwo->id[$i]}'>{$tuwo->department_name[$i]}</a>
									</li>";
						echo "</ul>";
					}
		}
	?>
</aside>

<?php
								
	//$count_result = count($tuwo->publication_id);
	
			if(!isset($tuwo->publication_id)){	
			echo"<table id='example' class='table responsive' style='width: 100%; cellspacing: 0;'>
			<tbody>";
			echo "<tr>
					<td colspan ='4'>
						There is no record in this table
					</td>
				</tr>";
			echo"		
			</tbody>
		</table>";
			}
			else{
				
			echo $tuwo->the_publication;
				}
			
?>
<br/>
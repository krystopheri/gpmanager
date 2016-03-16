  
                        <button class="btn btn-blue" onclick="print()"> Print </button>
					 	<div class='row' style='padding-top:20px;'>
                                                    <center>  <h3 class="well"> OUTSTANDING COURSES </h3> </center>
						<div class='col-lg-10 col-md-10 '>
                                                    
                                                
     <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>SN</th> 
                                                                <td> Student </td>
                                                                <td> Reg No </td>
                                                                <td> Department </td>
                                                                <th>Courses </th>  
                                                                
                                                            </tr>
                                                            
                                                        </thead>   <tbody>
                                                            
<?php $counter = 0; 
foreach($outstanding_courses as $course){  
   
  echo "<tr>";  
  $counter+=1;?>                                       
                                                        <td> <?php echo $counter;?> </td>
                                                        <td> <?php echo $course['name'];?> </td>
                                                        <td> <?php echo $course['reg_no'];?> </td>
                                                        <td> <?php echo $course['department'];?> </td> 
                                                        <td> <?php echo $course['outstanding'];?> </td>
                                                                <?php    echo "</tr>";} ?>
</tbody>
                                                        
                                                    </table>
						</div>
				 
						</div>
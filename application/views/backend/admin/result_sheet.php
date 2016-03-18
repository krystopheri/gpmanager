 
			<!--	  <div class="col-md-4 col-lg-4">
                        <a href="<?php echo base_url(). "index.php?admin/add_result/".$class_id;; ?>"   role="button" class="btn btn-primary pull-right" style="float:right;">Add Result</a> 
                        </div>
	 
				-->
				
				<div id='console'>
				
				</div>
				 
			<table class='table table-bordered'>
			<thead>
				<tr>
				<th>Student Details    </th> 
		
				<th> Result Details </th> 
				<tr>
			</thead>
			
			<tr>
				<td> 
					 <table>
                                             <tr> <td> <strong> Name: </strong>  </td> <td> <?php echo $gp['name']; ?> </td> </tr>
                                             <tr> <td> <strong> Reg No:  </strong> </td> <td> ESUT<?php echo $gp['details']['reg_no']; ?> </td> </tr>
                                             <tr> <td> <strong> Department: </strong>  </td> <td> <?php echo $gp['department']; ?> </td>  </tr>
                                             <tr> <td>  <strong> Level:  </strong> </td> <td>	 <?php  echo $gp['details']['level']; ?> </td>   </tr> 
					 
					 </table>
				</td> 
				<td> 
					 <table>
                                             <tr> <td><strong>Total Grade Points: </strong> </td> <td> <?php echo $gp['total_grade']; ?> </td> </tr>
                                             <tr> <td> <strong> Total Credit Unit </strong> </td> <td> <?php  echo $gp['total_units']; ?>
					</td> </tr> 
                                             <tr> <td> <strong> FCGPA: </strong> </td> <td> <?php echo $gp['general_gp']; ?></td>   </tr>
                                             <tr> <td> <strong> Class of Degree: </strong> </td> <td> <?php echo $gp['degree']; ?></td> </tr> 
 					 
					 </table>
				</td>
				 
			 
			</tr>
			
			
			</table>
	<?php for ($k = 0; $k < count($gp['gp']); $k++){ ?>
                                <div class='row'> 
                                    <center>   <h3 class='well'> <?php echo $gp['gp'][$k][1][0]['session'];?>  SESSION </h3> </center>
                                    <div class='col-md-5 col-lg-5'>
               <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                    <h3> 1st Semester </h3>
                            <th><div>S/N</div></th> 
							
							<th><div>C. Code </div> </th>
							<th><div>C. Title </div> </th>
							<th><div>CR </div> </th> 
							<th><div>GRADE </div> </th> 
               <th><div>GP</div> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    $counter = 0;
                        for($i = 0; $i < (count($gp['gp'][$k][1])-1); $i++){
                           
                           $score = $gp['gp'][$k][1][$i];
                         ?>
                               
                        <tr>
							<?php $counter+=1; ?>
                            <td> <?php echo $counter; ?> </td>
							<td> <?php   echo $score['code'];?> </td> 
							<td> <?php   echo $score['course'];?> </td>
							<td> <?php   echo $score['unit'];?> </td>
							<td> <?php 	 echo $score['grade']; ?> </td> 
                                                        <td> <?php echo $score['grade_point'];?> </td>
							  
							
								
                           
                        </tr>
                        <?php } ; ?>
                        <tr> <td  colspan='6' align='right'>  Total Credits:  <?php echo $gp['gp'][$k]['semester1_credits']; ?> , Total Points: <?php echo $gp['gp'][$k]['semester1_points']; ?> </td> </tr>
                        <tr> <td colspan="4"> Semester GP </td> <td> <?php echo $gp['gp'][$k][1]['sgp'];?> </td> </tr>
                    </tbody>
                </table>
                                        
                                    </div>
                                     <div class='col-md-4 col-lg-5 col-md-offset-1 col-lg-offset-1'>
                                         <h3> 2nd Semester </h3>
              <table class="table table-bordered table-responsive">
                    <thead>
                        <tr> 
                            <th><div>S/N</div></th> 
							
							<th><div>C. Code </div> </th>
							<th><div>C. Title </div> </th>
							<th><div>CR </div> </th> 
							<th><div>GRADE </div> </th> 
              <th> <div>GP </div> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                     $counter = 0;
                        for($i = 0; $i < (count($gp['gp'][$k][2])-1); $i++){
                            
                           $score = $gp['gp'][$k][2][$i];
                         ?>
                               
                        <tr>
							<?php $counter+=1; ?>
							<td> <?php echo $counter; ?> </td>	 
							<td> <?php   echo $score['code'];?> </td> 
							<td> <?php   echo $score['course'];?> </td>
							<td> <?php   echo $score['unit'];?> </td>
							<td> <?php 	 echo $score['grade']; ?> </td> 
                                                        <td> <?php echo $score['grade_point'];?> </td>
							  
							
								
                           
                        </tr>
                        <?php } ; ?>
                       <tr> <td  colspan='6' align='right'>  Total Credits:  <?php echo $gp['gp'][$k]['semester2_credits']; ?> , Total Points: <?php echo $gp['gp'][$k]['semester2_points']; ?> </td> </tr>
                       
		<tr> <td colspan="4"> Semester GP </td> <td> <?php echo $gp['gp'][$k][2]['sgp'];?> </td> </tr>				
						
                    </tbody>
                </table>
                                                    </div>
                                </div>
                        <center>SESSION GP:<span style='font-weight:bold;'><?php echo $gp['gp'][$k]['session_gp'];?> </span> </center>
                                
                                
        <?php } ?>
                                
                                
                                
                                
                                
				
					 	<div class='row' style='padding-top:20px;'>
                                                    <center>  <h3 class="well"> OUTSTANDING COURSES </h3> </center>
						<div class='col-lg-8 col-md-8 col-lg-offset-2 col-lg-offset-2'>
                                                    
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr><!--
                                                                <th></th> 
                                                                <th>Course Code </th> 
                                                                <th> Course Title</th> 
                                                                <th> Level </th> 
                                                                <th> Semester </th>
                                                                <th> Credit Load </th>-->
                                                            </tr>
                                                            
                                                        </thead>
                                                        
                                                        <tbody>
                                                        <td>
                                                            <?php 
                                                            $counter = 0;
                                                            //die(var_dump($gp['outstanding_courses']));
                                                            $cour = $gp['outstanding_courses']; 
                                                            
                                                             echo $cour['outstanding'];
                                                           
                                                             ?>
                                                        </td> 
                                                        </tbody>
                                                        
                                                    </table>
						</div>
				 
						</div>


				


			
				
<!--  DATA TABLE EXPORT CONFIGURATIONS  -->                      
<script type="text/javascript">
 
 
	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
	
	 
	function update_teacher(student, session, term, class_id){
	
	 session = "<?php echo $session; ?>" ;
	alert("clicked " + "- " +student + "- " + session + "- " + term + "- " +class_id + $("#teacher_comment").val());
	$("#teacher_comment_button").attr("disabled", "disabled");
	
	
	
	$.post("<?php echo base_url()."index.php?admin/update_teacher_comment/"; ?>",
    {
        student_id: student,
        comment: $("#teacher_comment").val(),
		sessionp: session,
		termp: term,
		classid: class_id
    },
    function(data, status){
       alert("Data: " + data + "\nStatus: " + status);   
		$("#teacher_comment_button").removeAttr('disabled');
    });
	
	}
	
	
	function update_principal(student, session, term, class_id){
	
	session = "<?php echo  $session; ?>" ;
	alert("clicked " + "- " +student + "- " + session + "- " + term + "- " +class_id);
	$("#teacher_comment_button").attr("disabled", "disabled");
	
	
	
	$.post("<?php echo base_url()."index.php?admin/update_principal_comment/"; ?>",
    {
        student_id: student,
        comment: $("#principal_comment").val(),
		sessionp: session,
		termp: term,
		classid: class_id
    },
    function(data, status){
       alert("Data: " + data + "\nStatus: " + status);   
		$("#principal_comment_button").removeAttr('disabled');
    });
	
	
	}

</script>
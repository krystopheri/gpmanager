 
			<!--	  <div class="col-md-4 col-lg-4">
                        <a href="<?php echo base_url(). "index.php?admin/add_result/".$class_id;; ?>"   role="button" class="btn btn-primary pull-right" style="float:right;">Add Result</a> 
                        </div>
	 
				-->
				
				<div id='console'>
				
				</div>
				 
			<table class='table table-bordered datatable'>
			<thead>
				<tr>
				<th>Student Details    </th> 
		
				<th> Result Details </th> 
				<tr>
			</thead>
			
			<tr>
				<td> 
					 <table>
					 <tr> <td> Name: </td> <td> <?php echo $student_name; ?> </td> </tr>
					 <tr> <td> Admission No: </td> <td> <?php echo $student_id; ?> </td> </tr>
					 <tr> <td> Class: </td> <td> <?php echo $class_name; ?> </td>  </tr>
					 <tr> <td> Class Population: </td> <td>	 <?php  echo $class_member_count; ?> </td>   </tr>
					 <tr> <td> Year </td> <td> <?php echo $year; ?> </td> </tr>  
					 
					 </table>
				</td> 
				<td> 
					 <table>
					 <tr> <td> Total Score: </td> <td> <?php echo $total ?> </td> </tr>
					 <tr> <td> Average: </td> <td> <?php  echo $average; ?>
					</td> </tr> 
					 <tr> <td> Position: </td> <td> <?php echo $position; ?></td>   </tr>
					 <tr> <td> Term: </td> <td> <?php echo $term; ?></td> </tr>
					 <tr> <td> Session : </td> <td> <?php echo $session; ?></td> </tr>
 					 
					 </table>
				</td>
				 
			 
			</tr>
			
			
			</table>
			 
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div>S/N</div></th> 
							<th><div>Subjects </div> </th>
							<th><div>Teacher </div> </th>
							<th><div> Assignment </div> </th> 
							<th><div> Project </div> </th>
							<th> <div> Test </div> </th>
							<th><div> Exam  </div> </th>  
							<th><div> Total Score </div> </th>
							<th><div> Grade </div> </th> 
							<th><div> Remarks </div> </th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
								$counter  = 0; 
								
                                foreach($scores as $score): ?>
                               
                        <tr>
							<?php $counter+=1; ?>
							<td> <?php echo $counter; ?> </td>	
                            <td> <?php    echo $score['subject']; ?> </td>
														 
							<td> </td>
							<td> <?php   echo $score['assignment'];?> </td> 
							<td> <?php   echo $score['project'];?> </td>
							<td> <?php   echo $score['test'];?> </td>
							<td> <?php 	 echo $score['exam']; ?> </td>
							</td>
							<td>
							<?php 
							 
							echo $score['total']; 
							?>
							</td>
							<td>  <?php  echo $score['grade']; ?> </td> 
							<td> <?php echo $score['remarks']; ?> </td>
							
								
                           
                        </tr>
                        <?php endforeach ; ?>
						
						
                    </tbody>
                </table>
			 
				
						<div class='row'>
						<div class='col-md-6'>
						<label for='teacher_comment'> Teacher's Comment </label>
						<textarea id='teacher_comment' class='form-control' ><?php  echo trim($teacher_comment);?></textarea>  
						  <button class='btn btn-primary' id='teacher_comment_button' onclick="update_teacher(<?php echo $student_id; ?>, <?php echo $session;?>, 4 , <?php echo $class_id; ?>)"> Update Teacher Comment</button>  
 
  
						
						
						</div>
						
						<div class='col-md-6'>
						<label for='principal_comment'> Principal's Comment </label>
						<textarea id='principal_comment' class='form-control'> <?php  echo trim($principal_comment); ?> </textarea> 
						<button class='btn btn-primary' id='principal_comment_button' onclick="update_principal(<?php echo $student_id; ?>, '<?php echo $session ;?>', 4, <?php echo $class_id; ?>)"> Update Principal Comment</button>
						
						</div>



						</div>
						<div class='row' style='padding-top:20px;'>

						<div class='col-lg-4'>

							<!-- <a class='btn btn-primary' href="index.php?admin/general_result/<?php echo $student_id; ?>/<?php echo $class_id;?>/<?php echo $session; ?>/<?php echo $numeric_term;?>"> View General Result </a> -->

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
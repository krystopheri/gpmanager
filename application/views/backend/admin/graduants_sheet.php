 
			<!--	  <div class="col-md-4 col-lg-4"> -->
                        
                        <button class="btn btn-blue" onclick="print()"> Print </button>
                        <div class='container'>
                            
                            <div class='row'>
                                 <div class='col-md-6 col-md-offset-3'>
                        <div class="form-group">
                        <Label class="control-label">Perspective </label>
                        <select id="view_changer" class="form-control" onchange="change_perspective()" sytle="float:center">
                            <option value="2">List</option>
                            <option value="1">Sheets</option>
                        </select>
                        </div>
                                 </div>
                            </div>
                        </div>
                        
                         <div id ="view2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr> <th>S/N </th> <th> JAMB NO </th> <th> REG NO </th> <th>NAME </th> <th>OPTION</th> <th>MODE OF ENTRY </th> <th>SEX </th> <th>STATE </th> <th>MARITAL STATUS </th> <th> DATE OF BIRTH </th> <th> YEAR1 TC </th> <th>YEAR 1 TP </th> <th> YEAR 2 TC </th> <th>YEAR 2 TP </th> <th> YEAR3 TC </th> <th>YEAR3 TP </th>  <th> YEAR4 TC </th> <th>YEAR4 TP </th> <th> YEAR5 TC </th> <th>YEAR5 TP </th> <th>TC</th> <th>TP</th><th>FCGPA</th> <th>CLASS OF DEGREE </th> </tr> 
                                </thead>
                               <?php
                               $counter = 0;
                               foreach($gps as $gp){ ?>
                                <tr>
                                    <td><?php echo ++$counter;?> </td>
                                    <td> <?php echo $gp['info']['jamb'];?> </td>
                                    <td> <?php echo $gp['details']['reg_no'];?> </td>
                                    <td> <?php echo $gp['name'];?> </td>
                                    <td> <?php echo $gp['department'];?> </td>
                                    <td> <?php echo $gp['info']['m_o_e'];?> </td>
                                    <td> <?php echo $gp['info']['sex'];?> </td>
                                    <td> <?php echo $gp['info']['state'];?> </td>
                                    <td> <?php echo $gp['info']['marital_status'];?> </td>
                                    <td> <?php echo $gp['info']['dob'];?> </td>
                                    <td> <?php echo $gp['gp'][1]['tc'];?> </td>
                                     <td> <?php echo $gp['gp'][1]['tp'];?> </td>
                                    <td> <?php echo $gp['gp'][2]['tc'];?> </td>
                                     <td> <?php echo $gp['gp'][2]['tp'];?> </td>
                                    <td> <?php echo $gp['gp'][3]['tc'];?> </td>
                                     <td> <?php echo $gp['gp'][3]['tp'];?> </td>
                                    <td> <?php echo $gp['gp'][4]['tc'];?> </td>
                                     <td> <?php echo $gp['gp'][4]['tp'];?> </td>>
                                    <td> <?php echo $gp['gp'][5]['tc'];?> </td>
                                     <td> <?php echo $gp['gp'][5]['tp'];?> </td> 
                                         <td> <?php echo $gp['total_units'];?> </td>
                                         <td> <?php echo $gp['total_grade'];?> </td>
                                         <td> <?php echo $gp['general_gp'];?> </td>
                                         <td> <?php echo $gp['degree'];?> </td>
                                </tr>
                               <?php } ?>
                            </table>
                        </div>
                        
                        
                        
                        
                        <div id="view1" hidden>
   <?php foreach($gps as $gp){ ?>
                        <p style="margin-top:20px;"> </p>
                        <hr/>
			<hr/>
				
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
                                             <tr> <td> <strong> Reg No:  </strong> </td> <td> <?php echo $gp['details']['reg_no']; ?> </td> </tr>
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
							  
							
								
                           
                        </tr>
                        <?php } ; ?>
						
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
							  
							
								
                           
                        </tr>
                        <?php } ; ?>
		<tr> <td colspan="4"> Semester GP </td> <td> <?php echo $gp['gp'][$k][1]['sgp'];?> </td> </tr>				
						
                    </tbody>
                </table>
                                                    </div>
                                </div>
                        
                                
        <?php } ?>
                                
                                
                                 


   <?php } ;?>
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
        
        
        function change_perspective(){
            
          var view = parseInt($("#view_changer").val());
           
           
           if(view===2){ 
               $("#view1").hide(500);
               $("#view2").show(500);
        }
        else{
            
               $("#view2").hide(500);
               $("#view1").show(500);
            
        }
    }

</script>
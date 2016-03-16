	<?php
		 
                
	?>
				  

			 
				 

			<table class='table table-bordered '  >
			<thead>
				<tr>
                                    <th>Department: <strong> <?php echo $department;?> </strong></th>  
                                    <th> Session: <strong> <?php echo $session; ?> </strong></th>
                                    <th> Level: <strong> <?php echo $level;?> </strong></th> 
				<tr>
			</thead>
	 
			
			
			</table>

				<?php echo validation_errors();?>
			 <?php echo form_open('admin/add_result/create/'.$session_id, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
<table class='table'>
    <tr> 
        <td> <label>Session Total Unit Load  </label> <br> <input id='total_unit' name='total_unit' value='<?php echo $total_unit;?>' required readonly> </td>
        <td> <label>1st Semester Unit Load  </label> <br> <input id='unitload1' name='unitload1' value='<?php echo $unitload1;?>' required > </td>
        <td> <label>2nd  Semester Unit Load  </label><br> <input id='unitload2' name='unitload2' value='<?php echo $unitload1;?>' required > </td>
</tr>
</table>
               
<center> <h3> First Semester </h3> </center>
<table class="table table-bordered"  >
                    <thead>
                        <tr>
                            <th><div>S/N</div></th>
                            <th><div>Course</div></th> 
                            <th><div> Score </div> </th>   
                             <th> <div>Grade </div> </th>
                            <th><div>UnitLoad</div></th> 
                        </tr>
                    </thead>
                    <tbody id='table1'> 
                        
                        
                        <?php
                        
                        $courses = $this->result_model->get_class_courses($level, $departmentId, 1);
                        $p_f_c = $this->result_model->get_potential_failed_courses($level, $departmentId, 1);
                        $PFC1 = "";
                        
                        for($i = 0; $i < count($p_f_c); $i++){
                            if(isset($p_f_c[$i])){
                            $PFC1= $PFC1. "<option value='".$p_f_c[$i]['id']."'>".$p_f_c[$i]['title']."</option>";                             }
                        }
                        
                        $t_unit1 = 0;
                        for($i = 0; $i< count($courses); $i++){ 
                            $j = $i+1;
                            ?>
                        
                        
                        <tr id ='sem1row<?php echo $j;?>'> 
                            <td><div id='seria1'><?php echo $j;?></div></td>
                                   <td>
                                       <select id="sem1course<?php echo $j;?>" name="sem1course<?php echo $j;?>" required>
                                           <option>Select Course</option>
                                   <?php 
                                    
                                   $counter = 0;
                                   
                                   foreach($courses as $course){
                                       
                                       if($counter==$i){
                                       echo "<option value='".$course['id']."' selected>".$course['title']."</option>";                                $c_course = $course;
                                       
                                       }
                                       else{
                                          echo "<option value='".$course['id']."'>".$course['title']."</option>";
                                         
                                       }
                                       
                                       $counter+=1;
                                   }
                                   echo $PFC1;
                                   ?>
                                       </select>
                                
                            </td>
                            
                             <td>
                                 <input name="sem1score<?php echo $j;?>"  id='sem1score<?php echo $j;?>' required/>
                                      
                            </td>
                            
                            <td>
                                 <input name="sem1grade<?php echo $j;?>"  id='sem1grade<?php echo $j;?>' readonly required/>
                                      
                            </td>
                            
                            
                             <td>
                                 <input name="sem1unit<?php echo $j;?>" value='<?php 
                                 $t_unit1+=intval($c_course['units']); echo $c_course['units'];?>' id='sem1unit<?php echo $j;?>' readonly required/>
                                      
                            </td>
                            
                        </tr>
                        <?php } ?>
                                </tbody>
                                <tr>
                                    <td>
                                <a href="javascript:add_row('1');" <td colspan='2'>  <image onclick='add_row('1')') width='32' height='32' src="<?php echo base_url();?>assets/images/add.jpg" alt="add"/>  </a></td> 
                                     
                                 <td colspan='2'>
                                 <center>
                                <a href="javascript:remove('1');"> <image width='32' height='32' src="<?php echo base_url();?>assets/images/delete.jpg" alt="delete"/> </a>  
                                 </center>
                                 </td>
                                  <td> No of Courses: </td> <td> <input id="row_counter1" value='<?php $semester_count1= $j; echo $j; ?>' name='no_of_courses1' readonly/></td>
</tr>
           
                </table>
                               

<center> <h3> Second Semester </h3> </center>
<table class="table table-bordered"  >
                    <thead>
                        <tr>
                            <th><div>S/N</div></th>
                            <th><div>Course</div></th> 
                            <th><div> Score </div> </th>   
                             <th> <div>Grade </div> </th>
                            <th><div>UnitLoad</div></th> 
                        </tr>
                    </thead>
                    <tbody id='table2'> 
                        <?php 
                        $t_unit2 = 0;
                        $courses = $this->result_model->get_class_courses($level, $departmentId, 2);
                        
                        $p_f_c = $this->result_model->get_potential_failed_courses($level, $departmentId, 2);
                        $PFC2 = "";
                        
                        for($i = 0; $i < count($p_f_c); $i++){
                            if(isset($p_f_c[$i])){
                            $PFC2= $PFC2. "<option value='".$p_f_c[$i]['id']."'>".$p_f_c[$i]['title']."</option>";                             }
                        } 
                        for($i = 0; $i< count($courses); $i++){ 
                        $j = $i+1;?>
                        <tr id ='sem2row<?php echo $j;?>'> 
                            <td><div id='seria1'><?php echo $j;?></div></td>
                                   <td>
                                       <select id="sem2course<?php echo $j;?>" name="sem2course<?php echo $j;?>" required>
                                           <option>Select Course</option>
                                   <?php 
                                    
                                   $counter = 0;
                                   foreach($courses as $course){
                                      
                                       if($counter==$i){
                                       echo "<option value='".$course['id']."' selected>".$course['title']."</option>";                                 $c_course = $course;
                                       }
                                       else{
                                           
                                        echo "<option value='".$course['id']."'>".$course['title']."</option>";
                                          }
                                          
                                         $counter+=1;
                                   }
                                   echo $PFC2;
                                   ?>
                                       </select>
                                
                            </td>
                            
                             <td>
                                 <input name="sem2score<?php echo $j;?>"  id='sem2score<?php echo $j;?>' required/>
                                      
                            </td>
                            
                            <td>
                                 <input name="sem2grade<?php echo $j;?>"  id='sem2grade<?php echo $j;?>' readonly required/>
                                      
                            </td>
                            
                            
                             <td>
                                 <input name="sem2unit<?php echo $j;?>"  id='sem2unit<?php echo $j;?>' value='<?php
                                 $t_unit2+= intval($c_course['units']);
                                 echo $c_course['units']; ?>' readonly required/>
                                      
                            </td>
                            
                        </tr>
                        <?php } ?>
                                </tbody>
                                <tr>
                                    <td>
                                <a href="javascript:add_row('2');" <td colspan='2'>  <image width='32' height='32' src="<?php echo base_url();?>assets/images/add.jpg" alt="add"/>  </a></td> 
                                     
                                 <td colspan='2'>
                                 <center>
                                <a href="javascript:remove('2');"> <image width='32' height='32' src="<?php echo base_url();?>assets/images/delete.jpg" alt="delete"/> </a>  
                                 </center>
                                 </td>
                                
                                 <td> No of Courses </td> <td> <input id="row_counter2" value='<?php $semester_count2 = $j; echo $j;?>' name='no_of_courses2' readonly/></td>
</tr>
<tr>   <td colspan='5'> <center> <button onclick="return verify_tul()" role="button" class="btn btn-primary btn-lg">Save</button> </center></td> 
                              </tr>
                </table>
 
</form>
                         



				


			
				
<!--  DATA TABLE EXPORT CONFIGURATIONS -->                      
<script type="text/javascript">

    alert("");
    
       
var semester1 = <?php echo ($semester_count1==NULL)? 0: $semester_count1;?>;
var semester2 = <?php echo ($semester_count2==NULL)? 0: $semester_count2;?>;  

var t_unit1 = <?php echo $t_unit1; ?>;
var t_unit2 = <?php echo $t_unit2; ?>;


update_unitloads();
function update_unitloads(){
    
$("#unitload1").val(""+t_unit1);
$("#unitload2").val(""+t_unit2); 
$("#total_unit").val(""+(t_unit1+t_unit2));
}
<?php 


                        $courses = $this->result_model->get_class_courses($level, $departmentId, 1);
                  $c1 = "<option></option>";
                  foreach($courses as $c){
                      
                  $c1.= "<option value='".$c['id']."'>".$c['title']."</option>";
                  }
                  
                  
                        $courses2 = $this->result_model->get_class_courses($level, $departmentId, 2);
                  $c2 = "<option></option>";
                  foreach($courses2 as $cc){
                      
                  $c2.= "<option value='".$cc['id']."'>".$cc['title']."</option>";
                  }
?>
var course_variable1 = "<?php echo $c1.$PFC1;?>";


var course_variable2 =  "<?php echo $c2.$PFC2 ?>";
                                   
                                        
function update_row(id){ 

	$("#"+id).attr('disabled','disabled');
	 
	var variables =   {
        student_id: id,
        assignment: $("#"+id+"_assignment").val(),
		project: $("#"+id+"_project").val(),
		test: $("#"+id+"_test").val(),
		exam: $("#"+id+"_exam").val(),
		class_id: $("#"+id+"_class_id").val(),
		session: $("#"+id+"_session").val(),
		term: $("#"+id+"_term").val(),
		subject: $("#"+id+"_subject_id").val()
    }; 
 	


	$.post("<?php echo base_url()."index.php?admin/update_result/"; ?>",
 	variables,
    function(data, status){
	  $("#console").html("Data: " + data + "\nStatus: ");
		$("#"+id).removeAttr('disabled');
    }
    );
} 


        function verify_tul(){ 
          total = parseInt($("#total_unit").val());
          
          if(isNaN(total)){
              alert("Invalid Total Unit Load");
              return false;
           }
          
          else if(total > 50){
              alert("Total Unitload should be less than 50");
              return false;
           }
            return true;
        }
        
        function remove(semester){
           
            semester = parseInt(semester); 
            if(semester===1){
             index = semester1; 
              }
              else{
               index = semester2; 
                
            }
           
            if((index-1)> (-1)){
           var unit = parseInt($("#sem"+semester+"unit"+index).val());
           
           //if unit is nan, unit should be 0
           unit = (isNaN(unit))? 0: unit; 
           
           
           $("#sem"+semester+"row"+index).html("");
           $("#sem"+semester+"row"+index).attr("id", "-1");
           if(semester===1){ 
           semester1 = semester1-1;
           index = semester1;   
           t_unit1-=unit;   
           update_unitloads();
       }
       else{
           semester2-=1;
           index = semester2;
           t_unit2-=unit;
           update_unitloads();
        }
        
        
           $("#row_counter"+semester).val(""+index);     
       }
       else{
           alert("all rows removed");
        }
            return true;
            
        }

        index = 0;
        function add_row(semester){
            
           switch(parseInt(semester)){
               case 1: 
               index = semester1;
               break;
               
                case 2:
                index = semester2;
                break;
            } 
            
        if(index>0 && $("#sem"+semester+"course"+(index)).val()===undefined || $("#sem"+semester+"course"+(index)).val()===''){  
            alert("One Row At A Time!");
            return true;
        }  
         
        
        if(semester==1){
        semester1+=1;
        index = semester1;
        course_variable = course_variable1;
        }
        else if(semester==2){
        semester2+=1; 
        index = semester2;
        course_variable = course_variable2;
        }
          
         
        $("#table"+semester).append("<tr id='sem"+semester+"row"+index+"'> <td> "+index+"</td> <td>"+"<select id='sem"+semester+"course"+index+"' name='sem"+semester+"course"+index+"' required    > "+course_variable+" </select> </td> <td> <input id='sem"+semester+"score"+index+"' name='sem"+semester+"score"+index+"' required/> </td> <td> <input type='text' name='sem"+semester+"grade"+index+"' id='sem"+semester+"grade"+index+"' readonly required/> </td> <td> <input type='text' name='sem"+semester+"unit"+index+"' id='sem"+semester+"unit"+index+"' readonly required/> </td></tr>"); 
        
            $("#sem"+semester+"course"+index).change(function(){
               
                 update_unit($("#sem"+semester+"course"+index), index, semester);
             }); 
             
             $("#sem"+semester+"score"+index).focusout(function(){
                 update_grade($("#sem"+semester+"score"+index), index, semester);
            });
            
              $("#row_counter"+semester).val(""+index);
           return true;
        }
        
        
       
        $(document).ready( function(){ 
            <?php 
            
            for($j =1; $j <= $semester_count1; $j++){ ?>
             $("#sem1course<?php echo $j;?>").change(function(){
                
                 update_unit($("#sem1course<?php echo $j;?>"), <?php echo $j;?>, 1);
             }); 
             
             $("#sem1score<?php echo $j;?>").focusout(function(){
                 update_grade($("#sem1score<?php echo $j;?>"), <?php echo $j;?>, 1);
            });
            <?php }?>
            
           <?php for($j = 1; $j <= $semester_count2; $j++){ ?>
              $("#sem2course<?php echo $j;?>").change(function(){
                
                 update_unit($("#sem2course<?php echo $j;?>"), <?php echo $j;?>, 2);
             }); 
             
             $("#sem2score<?php echo $j;?>").focusout(function(){
                 update_grade($("#sem2score<?php echo $j;?>"), <?php echo $j;?>, 2);
            });
            
           <?php }?>
         
         
         $("#unitload1").focusout(function(){
             add_total_units();
         });
           $("#unitload2").focusout(function(){
             add_total_units();
         });
         
        });
        
        
        function add_total_units(){
            
            unit1 = parseInt($("#unitload1").val());
            unit2 = parseInt($("#unitload2").val());
            total = unit1+unit2;
            $("#total_unit").val(""+total);
        }   
        
        
        
        
        function update_unit(course, row, sem){  
           getUnitLoad(course.val(), row, sem); 
        }
        
         
        function update_grade(score, row, sem){
            
            
            var i = parseInt(score.val());
            
            if(i>=0){
            grade = getGrade(i);
            $("#sem"+sem+"grade"+row).val(grade);
            if(grade=='F'){
                
            $("#sem"+sem+"grade"+row).css("background-color", "red");
             $("#sem"+sem+"grade"+row).css("color", "white");
            }
        }
            
            
            
        }
        
        
        
        function getGrade(score){
            
         if(score < 40){
             
             return 'F';
        }
        
        if(score < 45){
            return 'E';
        }
        
        if(score < 50){
            return 'D';
        }
        
        if(score < 60){
            return 'C';
        }
        
        if(score < 70){
            
            return 'B'
        }
        
        return 'A';
            
    }
            
             
         function getUnitLoad(id, row, sem){ 
	var variables =   {
        id: id   }; 
 	 
	$.post("<?php echo base_url()."index.php?admin/get_unit/"; ?>",
 	variables,
        function(data, status){
        unitload_received(data, row, sem);
        }
        );
}


function unitload_received(data, row, sem){
     
        fmrPoint = parseInt($("#sem"+sem+"unit"+row).val());
        old_cr = (isNaN(fmrPoint))? 0 : fmrPoint;
        $("#sem"+sem+"unit"+row).val(data.trim()); 
       
        if(sem===1){ 
            new_score = parseInt(data.trim()); 
             if(!isNaN(new_score)){
            t_unit1-=old_cr;
            t_unit1+=new_score;
            }  
        }
        else{  
            new_score2 = parseInt(data.trim()); 
            if(!isNaN(new_score2)){ 
            t_unit2-=old_cr;
            t_unit2+=new_score2; 
            }
        }
       
        update_unitloads();
}
 
</script>
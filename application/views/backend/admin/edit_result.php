	<?php
		 
                
	?>
				  

			 
				 

			<table class='table table-bordered '>
			<thead>
				<tr>
                                    <th>Department: <strong> <?php echo $department;?> </strong></th>  
                                    <th> Session: <strong> <?php echo $session; ?> </strong></th>
                                    <th> Level: <strong> <?php echo $level;?> </strong></th> 
				<tr>
			</thead>
	 
			
			
			</table>

				<?php echo validation_errors();?>
			 <?php echo form_open('admin/edit_result/edit/'.$session_id, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

<table class='table'>
    <tr> 
        <td> <label>Session Total Unit Load  </label> <br> <input id='total_unit' name='total_unit' value='<?php echo $total_unit;?>' required readonly> </td>
        <td> <label>1st Semester Unit Load  </label> <br> <input id='unitload1' name='unitload1' value='<?php echo $unitload1;?>' required > </td>
        <td> <label>2nd  Semester Unit Load  </label><br> <input id='unitload2' name='unitload2' value='<?php echo $unitload2;?>' required > </td>
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
                        <?php  for($i = 0; $i< count($entries1); $i++){ $j = $i+1;?>
                      
                        <tr id ='sem1row<?php echo $j;?>'> 
                            <td><div id='seria1'><?php echo $j;?></div></td>
                                   <td>
                                       <select id="sem1course<?php echo $j;?>" name="sem1course<?php echo $j;?>" required>
                                           <option></option>
                                   <?php 
                                   
                                   $courses = $this->db->get_where('course', array('departmentId'=>$departmentId))->result_array();
                                   
                                   foreach($courses as $course){
                                       echo "<option value='".$course['id']."'"; if($course['id']==$entries1[$i]['courseId']) { echo "selected";} echo ">"."(".$course['code'].") ".$course['title']."</option>";
                                   }
                                   ?>
                                       </select>
                                
                            </td>
                            
                             <td>
                                 <input name="sem1score<?php echo $j;?>"  id='sem1score<?php echo $j;?>' value='<?php echo $entries1[$i]['score'];?>'  required/>
                                      
                            </td>
                            
                            <td>
                                 <input name="sem1grade<?php echo $j;?>"  
                                value="<?php echo $entries1[$i]['grade'];?>"
                                id='sem1grade<?php echo $j;?>' readonly required/>
                                      
                            </td>
                            
                            
                             <td>
                                 <input name="sem1unit<?php echo $j;?>" value="<?php echo $entries1[$i]['units'];?>" id='sem1unit<?php echo $j;?>' readonly required/>
                                      
                            </td>
                             <td>
                                 <input type="hidden" name="sem1id<?php echo $j;?>" value='<?php echo $entries1[$i]['id'];?>' id='sem1id<?php echo $j;?>' />
                                      
                            </td>
                        </tr>
                        <?php } ?>
                                </tbody>
                                <tr>
                                    <td>
                                <a href="javascript:add_row('1', '<?php echo $session_id;?>', '<?php echo $reg_no;?>', '<?php echo $level;?>');" <td colspan='2'> <image width='32' height='32' src="<?php echo base_url();?>assets/images/add.jpg" alt="add"/>  </a></td> 
                                     
                                 <td colspan='2'>
                                 <center>
                                <a href="javascript:remove('1');"> <image width='32' height='32' src="<?php echo base_url();?>assets/images/delete.jpg" alt="delete"/> </a>  
                                  </center>
                                 </td>
                                  <td> No of Courses: </td> <td> <input id="row_counter1" value='<?php echo count($entries1);?>' name='no_of_courses1' readonly/></td>
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
                        
                        <?php for($i = 0; $i< count($entries2); $i++){ $j = $i+1;?>
                        
                        <tr id ='sem2row<?php echo $j;?>'> 
                            <td><div id='seria1'><?php echo $j;?></div></td>
                                   <td>
                                       <select id="sem2course<?php echo $j;?>" name="sem2course<?php echo $j;?>"  required>
                                           <option></option>
                                   <?php 
                                   
                                   $courses = $this->db->get('course')->result_array();
                                   
                                   foreach($courses as $course){
                                       echo "<option value='".$course['id']."'";  if ($course['id']==$entries2[$i]['courseId']) { echo "selected"; } echo "> ".  $course['title']."</option>";
                                   }
                                   ?>
                                       </select>
                                       
                                
                            </td>
                            
                             <td>
                                 <input name="sem2score<?php echo $j;?>"  id='sem2score<?php echo $j;?>' value='<?php echo $entries2[$i]['score'];?>' required/>
                                      
                            </td>
                            
                            <td>
                                 <input name="sem2grade<?php echo $j;?>" value="<?php echo $entries2[$i]['grade'];?>"  id='sem2grade<?php echo $j;?>' readonly required/>
                                      
                            </td>
                            
                            
                             <td>
                                 <input name="sem2unit<?php echo $j;?>"  value="<?php echo $entries2[$i]['units'];?>" id='sem2unit<?php echo $j;?>' readonly required/>
                                      
                            </td>
                              <td>
                                 <input type="hidden" name="sem2id<?php echo $j;?>" value='<?php echo $entries2[$i]['id'];?>' id='sem2id<?php echo $j;?>'/>
                                      
                            </td>
                        </tr>
                        <?php } ?>
                                </tbody>
                                <tr>
                                    <td colspan="1">
                                <a href="javascript:add_row('2', '<?php echo $session_id;?>', '<?php echo $reg_no;?>', '<?php echo $level;?>');"> <image width='32' height='32' src="<?php echo base_url();?>assets/images/add.jpg" alt="add"/>  </a></td> 
                                     
                                 <td colspan='2'>
                                 <center>
                                <a href="javascript:remove('2');">  <image src="<?php echo base_url();?>assets/images/delete.jpg" alt="delete"/> </a>  
                                 </center>
                                 </td>
                                
                                 <td> No of Courses </td> <td> <input id="row_counter2" value='<?php echo count($entries2)?>' name='no_of_courses2' readonly/></td>
</tr>
<tr>   <td colspan='5'> <center> <button type="submit"  role="button" class="btn btn-primary btn-lg">Save</button> </center></td> 
                              </tr>
                </table>
 
</form>
                         



				


<?php 


                        $courses = $this->result_model->get_class_courses($level, $departmentId, 1);
                        
                  $c1 = "<option></option>"; 
                  foreach($courses as $c){
                   
                  $c1.= "<option value='".$c['id']."'>"."(".$c['code'].") ".$c['title']."</option>";
                  }
                  
                 
                        $courses2 = $this->result_model->get_class_courses($level, $departmentId, 2);
                  $c2 = "<option></option>";
                  foreach($courses2 as $cc){
                      
                  $c2.= "<option value='".$cc['id']."'>"."(".$cc['code'].") ".$cc['title']."</option>";
                  }
                  
                  $p_f_c = $this->result_model->get_potential_failed_courses($level, $departmentId, 1);
                        $PFC1 = "";
                        
                        for($i = 0; $i < count($p_f_c); $i++){
                            if(isset($p_f_c[$i])){
                            $PFC1= $PFC1. "<option value='".$p_f_c[$i]['id']."'> (".$p_f_c[$i]['code'].") ".$p_f_c[$i]['title']."</option>";                             }
                        }
                    
                  
                        $p_f_c = $this->result_model->get_potential_failed_courses($level, $departmentId, 2);
                        $PFC2 = "";
                        
                        for($i = 0; $i < count($p_f_c); $i++){
                            if(isset($p_f_c[$i])){
                            $PFC2= $PFC2. "<option value='".$p_f_c[$i]['id']."'> (".$p_f_c[$i]['code'].") ".$p_f_c[$i]['title']."</option>";                             }
                        }   
                        
?>
			
				
<!--  DATA TABLE EXPORT CONFIGURATIONS -->                      
<script type="text/javascript">

var semester1 = <?php echo (count($entries1) > 0)? 0: count($entries1);?>;
var semester2 = <?php echo (count($entries2) > 0)? 0: count($entries2);?>;

var t_unit1 = 0;
var t_unit2 = 0;

 



var course_variable1 = "<?php echo $c1.$PFC1;?>";
var course_variable2 = "<?php echo $c2.$PFC2;?>";  

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
  

        function remove(semester){
            
            if(semester==1){
             index = semester1; 
              }
              else{
               index = semester2; 
                
            }
           if((index-1)> 0){     
           row_points = parseInt($("#sem"+semester+"unit"+index).val());
           
           $("#sem"+semester+"row"+index).html("");
           $("#sem"+semester+"row"+index).attr("id", "-1");
           if(semester==1){
           semester1-=1;
           index = semester1;
           t_unit1-= isNaN(row_points)? 0 : row_points;
           
       
       }
       else{
           semester2-=1;
           index = semester2; 
           t_unit2-= isNaN(row_points)? 0 : row_points;
        }  
           
           update_unitloads();
           $("#row_counter"+semester).val(""+index);     
                remove_row(semester, index);
            return true;
        }else{
        
        alert("Can't delete last row");
         }
    }
    

        function remove_row(semester, index){
            
            id = $("#sem"+semester+"id"+index).val();
            
            
             var variables =   {
            'id': id };  


	$.post("<?php echo base_url()."index.php?admin/delete_row_ajax/"; ?>",
 	variables,
    function(data, status){
        
       // alert(data);
        });
        
        }
        
        
        
        function add_row(seme, session, regno, level, index){
        semester = parseInt(seme);
        if(semester===1){ 
        index = semester1;
        }
    else if(semester===2){ 
        index = semester2;
        } 
        last_row_filled = ($("#sem"+semester+"course"+index).val()); 
        //console.log("semester " + semester + " session " + session +" reg_no " + regno + " level " +level + " index "+ index + " semester1"+ semester1 + " semester 2 " + semester2 + " ");
        if((last_row_filled===undefined || last_row_filled.trim().length < 1) && (index > 0)){  
            alert("One Row At A Time!");
          return true;
        } 
         
        
        if(semester===1){
            semester1+=1;
            index = semester1;
            course_variable = course_variable1; 
        }
        else{
            semester2+=1;
            index = semester2; 
            course_variable = course_variable2;
        }
            
        
        $("#table"+semester).append("<tr id='sem"+semester+"row"+index+"'> <td> "+index+"</td> <td>"+"<select id='sem"+semester+"course"+index+"' name='sem"+semester+"course"+index+"' required    > "+course_variable+" </select> </td> <td> <input id='sem"+semester+"score"+index+"' name='sem"+semester+"score"+index+"' required/> </td> <td> <input type='text' name='sem"+semester+"grade"+index+"' id='sem"+semester+"grade"+index+"' readonly required/> </td> <td> <input type='text' name='sem"+semester+"unit"+index+"' id='sem"+semester+"unit"+index+"' readonly required/> </td>  <td> <input type='hidden' name='sem"+semester+"id"+index+"' id='sem"+semester+"id"+index+"'/> </td></tr>");
            
            $("#sem"+semester+"course"+index).change(function(){
                
                 update_unit($("#sem"+semester+"course"+index), index, semester);
                 /*
                 unit = parseInt($("#sem"+semester+"course"+index).val());
                 
                 if(!isNaN(unit)){
                     
                    if(semester===1){
                      t_unit1+=unit;
                    }
                   else if(semester === 2){
                    t_unit2+=unit;
                    }
                   }
                   
                   update_unitloads(); */
             }); 
             
             $("#sem"+semester+"score"+index).focusout(function(){
                 update_grade($("#sem"+semester+"score"+index), index, semester);
            });
             
            
              $("#row_counter"+semester).val(""+index);
              
              add_row_ajax(semester, session, regno, level, index);
           return true;
        }
        
        
        
        function add_row_ajax(semester, session, regno, level, index){
            
             var variables =   {
            'semester': semester, 'session':session, 'regno':regno, 'level':level  };  


	$.post("<?php echo base_url()."index.php?admin/add_row_ajax/"; ?>",
 	variables,
    function(data, status){ 
        $("#sem"+semester+"id"+index).val(data.trim()); 
    }
    );
	  
    }
       
        $(document).ready( function(){  
              //set listener functions on semester1 view elements
            <?php 
            for($j = 1; $j <= count($entries1); $j++){ ?>
                    
             $("#sem1course"+<?php echo $j?>).change(function(){
                
                 update_unit($("#sem1course"+<?php echo $j?>), <?php echo $j?>, 1);
             }); 
             
             $("#sem1score"+<?php echo $j?>).focusout(function(){
                 update_grade($("#sem1score"+<?php echo $j?>),<?php echo $j?>, 1);
            });
           
         var vale = '<?php echo $entries1[$j-1]['units']; ?>';
          
         t_unit1+= isNaN(parseInt(vale))? 0: parseInt(vale);
          
           <?php } ?>  
               
               //semester 2 view elements
         <?php 
            for($j = 1; $j <= count($entries2); $j++){ ?>
                    
             $("#sem2course"+<?php echo $j?>).change(function(){
                
                 update_unit($("#sem2course"+<?php echo $j?>), <?php echo $j?>, 2);
             }); 
             
             $("#sem2score"+<?php echo $j?>).focusout(function(){
                 update_grade($("#sem2score"+<?php echo $j?>),<?php echo $j?>, 2);
            });
            
           
         var vale2 = '<?php echo $entries2[$j-1]['units']; ?>';
          
         t_unit2+= isNaN(parseInt(vale2))? 0: parseInt(vale2);
            
           <?php } ?> 
           
           update_unitloads();
           
           for(i = 1; i <= semester1; i++){
               
               $("#sem1course"+i).change();
               $("#sem1score"+i).focusout();
               
            }
            
            
            
           for(i = 1; i <= semester2; i++){
               
               $("#sem2course"+i).change();
               $("#sem2score"+i).focusout();
               
            }
         
         $("#unitload1").focusout(function(){
             update_unitloads();
         });
           $("#unitload2").focusout(function(){
             update_unitloads();
         });
         
        }); 
        
        function update_unit(course, row, sem){  
           getUnitLoad(course.val(), row, sem); 
        }
        
        function update_grade(score, row, sem){
            
            
            var i = parseInt(score.val());
            
            if(i>0){
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
        var frmPoint = parseInt($("#sem"+sem+"unit"+row).val());
        
        if(isNaN(frmPoint)){
            frmPoint = 0;
        }
            
            if(sem===1){
               t_unit1-=frmPoint;
               t_unit1+= (isNaN(parseInt(data.trim()))?0:parseInt(data.trim()));
            }
            else if(sem===2){
                t_unit2-=frmPoint;
                t_unit2+=(isNaN(parseInt(data.trim()))?0:parseInt(data.trim()));
            }
        
         
        $("#sem"+sem+"unit"+row).val(data.trim());
        update_unitloads();
        
    }
    );
} 

function update_unitloads(){
    
 $("#unitload1").val(""+t_unit1);
 $("#unitload2").val(""+t_unit2);
 
 $("#total_unit").val(""+(t_unit1+t_unit2));
}
    
 	
</script>
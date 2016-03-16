<?php 

$edit_data		=	$this->db->get_where('student' , array('id' => $param2) )->result_array();

foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					Edit Student
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/student/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Reg No:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="reg_no" value="<?php echo $row['reg_no'];?>"/>
                        </div>
                    </div>
                  
                                  <div class="form-group">
                        <label class="col-sm-3 control-label">Department</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="department">
                                <option></option>
                                <?php 
                                $departments = $this->db->get("department")->result_array();
                                
                                foreach($departments as $dept){
                                    
                                    echo "<option value='".$dept['id']. "' "; if($row['departmentId']==$dept['id']) echo " selected "; echo "> ".$dept['title'] . " </option>";
                                }
                                
                                ?>
                            </select>
                        </div>
                    </div>  
                            
                            
                            
                            <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Surname:</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="surname" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['name'];?>" autofocus>
                        </div>
                    </div>
                    
                     
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Reg No</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="reg_no" value="<?php echo $row['reg_no'];?>" >
                        </div> 
                    </div>  
                    
                    
                    
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">JAMB No:</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="jamb" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['jamb']; ?>" autofocus>
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Mode of Entry</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="mode_of_entry" value='<?php echo $row['m_o_e']; ?>'/> 
                        </div> 
                    </div>  
                    
                    
                    
                    
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Sex</label>
                        
                        <div class="col-sm-5">
                            <input type='text'  class="form-control" name="sex" value='<?php echo $row['sex']; ?>'/> 
                        </div> 
                    </div>  
                    
                    
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Marital Status</label>
                        
                        <div class="col-sm-5">
                            <input type='text' class="form-control" name="marital_status" value='<?php echo $row['marital_status']; ?>' required/>
                        </div> 
                    </div>  
                     
                    
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">State</label>
                        
                        <div class="col-sm-5">
                            <input type='text' class="form-control" name="state" value='<?php echo $row['state']; ?>' required/> 
                        </div> 
                    </div>  
                     
                    
                    
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Date Of Birth:</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="dob" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['dob']; ?>" autofocus>
                        </div>
                    </div>
                    
                      
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Phone No:</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="phone" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['phone']; ?>" autofocus>
                        </div>
                    </div>
                        
                     
                             
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Edit Student</button>
						</div>
					</div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>



<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Students
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Add Student
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Student Name</div></th>
                    		<th><div>Reg No</div></th> 
                    		<th><div>Department</div></th>  
                <th><div>Manage </div> </th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($students as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['reg_no'];?></td>
                                                       
							<td><?php  echo $this->crud_model->get_department($row['departmentId']);?></td>  
                                                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_student/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/student/delete/<?php echo $row['id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>



			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/student/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Surname:</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="surname" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
                        </div>
                    </div>
                    
                    
                    
                        <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Other Names:</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="other_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
                        </div>
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Reg No</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="reg_no" value="" >
                        </div> 
                    </div>  
                    
                    
                    
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">JAMB No:</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="jamb" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Mode of Entry</label>
                        
                        <div class="col-sm-5">
                            <select  class="form-control" name="mode_of_entry">
                                <option></option>
                                <option>CDE</option>
                                <option>UME</option>
                            </select>
                        </div> 
                    </div>  
                    
                    
                    
                    
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Sex</label>
                        
                        <div class="col-sm-5">
                            <select  class="form-control" name="sex">
                                <option></option>
                                <option>M</option>
                                <option>F</option>
                            </select>
                        </div> 
                    </div>  
                    
                    
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Marital Status</label>
                        
                        <div class="col-sm-5">
                            <select class="form-control" name="marital_status" required> 
                                <option></option>
                                <option>Single</option>
                                <option>Married</option>
                            </select>
                        </div> 
                    </div>  
                     
                    
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">State</label>
                        
                        <div class="col-sm-5">
                            <input type='text' class="form-control" name="state" required/> 
                        </div> 
                    </div>  
                     
                    
                    
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Date Of Birth:</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="dob" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
                        </div>
                    </div>
                    
                      
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Phone No:</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="phone" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
                        </div>
                    </div>
                       
                     <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Department</label>
                        
                        <div class="col-sm-5">
                            <select class="form-control" name="department">
                                <option></option>
                                <?php 
                                $departments = $this->db->get("department")->result_array();
                                foreach($departments as $dept){
                                    
                                    echo "<option value='".$dept['id']."'>".$dept['title']. "</option>";
                                }
                                
                                ?>
                            </select>
                        </div> 
                    </div>  

                    
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info">Add Student</button>
                        </div>
                    </div>
                    </form>                
                </div>                
			</div>
                        
                </div>
        </div>
</div>

  
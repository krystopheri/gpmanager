<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Courses
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Add Course
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
                    		<th><div>Course Name</div></th>
                    		<th><div>Level</div></th> 
                    		<th><div>Code</div></th>
                                <th><div>Department </div</th>
                    		<th><div>Units</div></th>
                <th> Semester </th>     
                <th> Manage</th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($courses as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['level'];?></td>
							<td><?php echo $row['code'];?></td>
                                                        <td><?php echo $this->crud_model->get_department($row['departmentId']);?> </td>
							<td><?php echo $row['units'];?></td>
                                                        <td><?php echo $row['semester']?> </td>
							 <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_course/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/course/delete/<?php echo $row['id'];?>');">
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
                	<?php echo form_open('admin/course/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Course Name:</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus required>
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Course Code</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="code" value="" required>
                        </div> 
                    </div>  
                       
                     <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Units</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="unit" value="" required>
                        </div> 
                    </div>  
                    
                    
                     <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Department</label>
                        
                        <div class="col-sm-5">
                            <select name="department" type="text" class="form-control" required>
                                    <option></option>
                                    <?php
                                    $deps = $this->db->get("department")->result_array();
                                    
                                    foreach($deps as $dep){
                                        
                                        echo "<option value='".$dep['id']."'> ".$dep['title']. " </option>";
                                    }
                                    
                                    ?>
                                    
                             </select>
                        </div> 
                    </div>  

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Level</label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="level" value="" required>
                        </div> 
                    </div>  
                    
                    
                       <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Semester</label>
                        
                        <div class="col-sm-5">
                            <select class="form-control" name="semester" value="" required>
                                <option></option>
                                <option value="1">1st Semester</option>
                                <option value="2">2nd Semester</option>
                            </select>
                        </div> 
                    </div>  
                     
     
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info">Add Course</button>
                        </div>
                    </div>
                    </form>                
                </div>                
			</div>
                        
                </div>
        </div>
</div>

  
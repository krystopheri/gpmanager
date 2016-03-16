<?php 
$edit_data		=	$this->db->get_where('course' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					Edit Course
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/course/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['title'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Level</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="level" value="<?php echo $row['level'];?>"/>
                        </div>
                    </div>
                  
                                  <div class="form-group">
                        <label class="col-sm-3 control-label">Code</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="code" value="<?php echo $row['code'];?>"/>
                        </div>
                    </div>  
                            
                                  <div class="form-group">
                        <label class="col-sm-3 control-label">Unit</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="unit" value="<?php echo $row['units'];?>"/>
                        </div>
                    </div>
                            
                                  <div class="form-group">
                        <label class="col-sm-3 control-label">Semester</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="semester" value="<?php echo $row['semester'];?>"/>
                        </div>
                    </div>
                            
                            
                                  <div class="form-group">
                        <label class="col-sm-3 control-label">Department</label>
                        <div class="col-sm-5">
                            <select name='department' class='form-control'>
                            <?php $deps = $this->db->get("department")->result_array(); 
                            
                            foreach($deps as $dep){ ?>
                            
                            <option  <?php echo "value='".$dep['id']."'";
                            if($dep['id']==$row['departmentId']) echo 'selected';?>> <?php echo $dep['title']; ?> </option> <?php } ?>
 </select>
                        </div>
                    </div>
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Edit Course</button>
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



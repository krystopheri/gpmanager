 
 
						
                <div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
				<div class="col-md-4 col-lg-4">
                        <a href="<?php echo base_url(). "index.php?admin/add_result/".$class_id;; ?>"   role="button" class="btn btn-primary pull-right" style="float:right;">Add Result</a> 
                        </div>
            		<i class="entypo-plus-circled"></i> 
			
				  Or Select results to edit below
			 
				 <?php  
				 //echo $this->crud_model->get_class_name($class);
				 ?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php 
				echo validation_errors();
				echo $message;
				echo form_open('admin/select_result/'.$class.'/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"> Term </label>
                        
						<div class="col-sm-5">
						<select name='term'>
						<option value=''>--</option>
						 <option value='1'> 1St Term </option>
						  <option value='2'> 2nd Term </option>
						 <option value='3'> 3rd Term </option>
						 </select>
						 </div>
					</div>
					
					
					<div class="form-group">
					 <label for="field-2" class="col-sm-3 control-label"> Subject </label>
					 
					 <div class="col-sm-5">
					 <select name='subject'>
					 <option value=''>--<option>
					<?php
			
					$subjects = $this->db->get_where('subject', array('class_id'=>$class))->result_array();
					
					foreach($subjects as $course){
				
					echo "<option value='".$course['subject_id']."'>".$course['name']."</option>";
					}
					?>
					</select> 
				</div> 
				</div>
				
				
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"> Session: </label>
                        
						<div class="col-sm-5">
						<select name='session'>
						<option value=''>--<option>
						<?php
						
						for($i = 2015; $i < 2050; $i++){
						echo "<option value='".$i."/".($i+1)."'>".$i."/".($i+1)."</option>";
						}
						
						?>
						
						</select>
						</div>
					</div>
					 
					 
				  
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"> Edit Result </button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>  
   
</div>
            </div>

            
        </div>
  
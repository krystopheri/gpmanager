<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo $class_id; ?>
				 Add Result for this Class
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/results/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"> Term </label>
                        
						<div class="col-sm-5">
						<select name='term'>
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
					<?php
			
					$subjects = $this->db->get('subject')->result_array();
					foreach($subjects as $course){
				
					echo "<option value='".$course['id'].">".$course['name']."</option>";
					}
					?>
					</select> 
				</div> 
				</div>
				
				
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"> Session: </label>
                        
						<div class="col-sm-5">
						<select name='year'>
						<?php
						
						for($i = 2010; $i < 2050; $i++){
						echo "<option value='".$i."/".($i+1)."'>".$i."/".($i+1)."</option>";
						}
						
						?>
						
						</select>
						</div>
					</div>
					 
					 
				  
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"> Add Results </button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
 
  
                <div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
				
			
				 You are about to add a new result entry   
				 
            	</div>
            </div>
			<div class="panel-body">
				
                <?php 
				echo validation_errors();
				echo $message;
                                echo $special_error;
				echo form_open('admin/add_session/create', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					
					<div class="form-group">
					 <label for="field-2" class="col-sm-3 control-label"> Reg No: </label>
					 
					 <div class="col-sm-5">
					 <input name='reg_no'> 
					</select> 
				</div> 
				</div>
                            
                            
                            
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"> Session </label>
                        
						<div class="col-sm-5">
						<select name='session'>
						<option value=''>--</option>
                                                <?php for($i=2006; $i<3000; $i++){?>
                                                <option value="<?php echo $i."-".($i+1);?>"> <?php echo $i." / ".($i+1);?> </option>
                                                <?php }?>
                                                </select>
						 </div>
					</div>
					
				  
					 <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Level</label>
                        
						<div class="col-sm-5">
						<select name='level'>
						<option value=''>--<option>
						<?php
						$i =100;
						while($i <900){
						echo "<option value='".$i."'>".$i."</option>";
                                                $i+=100;
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
  
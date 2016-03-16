 
  
                <div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
				
			Get GP Results for students eligible for graduation, with reg no starting with:
				 
            	</div>
            </div>
			<div class="panel-body">
				
                <?php 
				echo validation_errors();
				echo $message;
				echo form_open('admin/get_graduants/get', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					  
				 
                            	<div class="form-group">
					 <label for="field-2" class="col-sm-3 control-label"> All Reg Nos that Start with </label>
					 
					 <div class="col-sm-5">
                                             
					 <select name='year' class="form-control" required> 
                                             <option></option>
                                          <?php 
                                          for($i=2010; $i < 2050; $i++){
                                              
                                              echo "<option value='".$i."'>".$i."</option>";
                                          }
                                          ?>
                                         </select>
				 
				</div> 
				</div>
                             
				  
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"> Get GP </button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>  
   
</div>
            </div>

            
        </div>
  
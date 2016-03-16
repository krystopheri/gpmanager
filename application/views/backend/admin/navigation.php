<div class="sidebar-menu">
		<header class="logo-env" >
			
            <!-- logo -->
			<div class="logo" style="">
				<a href="<?php echo base_url();?>">
					<img src="uploads/logo.png"  style="max-height:60px;"/>
				</a>
			</div>
            
			<!-- logo collapse icon -->
			<div class="sidebar-collapse" style="">
				<a href="#" class="sidebar-collapse-icon with-animation">
                
					<i class="entypo-menu"></i>
				</a>
			</div>
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
		
		<div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
		<ul id="main-menu" class="">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            
           
           <!-- DASHBOARD --> 
            <li class="<?php if($page_name == 'department')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/department">
					<i class="entypo-flow-tree"></i>
					<span>Departments</span>
				</a>
                
           </li>
     
           <li class="<?php if($page_name == 'course')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/course">
					<i class="entypo-flow-tree"></i>
					<span>Courses</span>
				</a>
                
           </li>
            
             <li class="<?php if($page_name == 'student')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/student">
					<i class="entypo-flow-tree"></i>
					<span>Students</span>
				</a>
                
           </li>
           <!-- SUBJECT -->
           <li class="<?php if($page_name == 'add_session'||$page_name=='add_result')echo 'opened active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/add_session">
					<i class="entypo-docs"></i>
					<span>Enter Results</span>
				</a>
              
           </li>
           
           
           <li class="<?php if($page_name == 'edit_session')echo 'opened active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/edit_session">
					<i class="entypo-docs"></i>
					<span>Edit Result</span>
				</a>
              
           </li>
             <li class="<?php if($page_name == 'get_mass_gp')echo 'opened active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/get_mass_gp">
					<i class="entypo-graduation-cap"></i>
					<span> Get Mass GP </span>
				</a>
                
                        
           </li>
           <li class="<?php if($page_name == 'get_gp')echo 'opened active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/get_gp">
					<i class="entypo-graduation-cap"></i>
					<span> Get Individual GP </span>
				</a>
                
                        
           </li>
            
                   <li class="<?php if($page_name == 'outstanding_course')echo 'opened active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/outstanding_course">
					<i class="entypo-graduation-cap"></i>
					<span> Get Outstanding Courses </span>
				</a>
                
                        
           </li>
           
           
                    <li class="<?php if($page_name == 'get_graduants')echo 'opened active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/get_graduants">
					<i class="entypo-graduation-cap"></i>
					<span> Get Graduants </span>
				</a>  
                    </li>
       
        
         
       
           
           
		</ul>
        		
</div>
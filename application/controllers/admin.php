  	<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	date	: 1 August, 2014
 *	University Of Dhaka, Bangladesh
 *	Ekattor School & College Management System
 *	http://codecanyon.net/user/joyontaroy
 */

class Admin extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        redirect("admin/student");
        /*
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data); */
    }
    
    
    /****MANAGE STUDENTS CLASSWISE*****/
 
	
	//injected Customization by Larry
	function result($class_id = '')
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
			
		$page_data['page_name']  = 'result';
		$page_data['page_title'] 	=  "Results - ".get_phrase('class')." : ".
											$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}


	function course($param1='', $param2=''){

			if($param1 == 'create'){

			$this->load->library("form_validation");

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('level', 'Level', 'required');
			$this->form_validation->set_rules('code', 'Course Code', 'required'); 
			$this->form_validation->set_rules('unit', 'Units', 'required');
                        $this->form_validation->set_rules('semester', 'Semester', 'required');
                        $this->form_validation->set_rules('department', 'Department', 'required');


			$message = "";
			if($this->form_validation->run()){


				$data['level'] = $this->input->post("level");
				$data['title'] = $this->input->post("name");
				$data['code'] = $this->input->post("code");
				$data['units'] = $this->input->post("unit");
                                $data['semester'] = $this->input->post('semester');
                                $data['departmentId'] = $this->input->post("department");

			$this->db->insert('course',  $data);
				$message = "Added Course Successfully!";

			}



			}
                        
                        if($param1=='do_update'){
                             
                           $this->load->library("form_validation");

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('level', 'Level', 'required');
			$this->form_validation->set_rules('code', 'Course Code', 'required'); 
			$this->form_validation->set_rules('unit', 'Units', 'required');
                        $this->form_validation->set_rules('semester', 'Semester', 'required');
                        $this->form_validation->set_rules("department", "Department", "required");

                           
			$message = "";
                        
			if($this->form_validation->run()){
                                
				$data['level'] = $this->input->post("level");
				$data['title'] = $this->input->post("name");
				$data['code'] = $this->input->post("code");
				$data['units'] = $this->input->post("unit");
                                $data['semester'] = $this->input->post("semester");
                                $data['departmentId'] = $this->input->post("department"); 
                        $this->db->where('id', $param2);
			$this->db->update('course',  $data);
                        $message = "Updated Course Successfully!";

			}
 
                        }
                        
                         if($param1 =='delete'){ 
                            $this->db->delete('course', array('id'=>$param2));
                        }
                        
                       
			$page_data['message'] = $message;
			$page_data['courses'] = $this->db->get("course")->result_array();  
			$page_data["page_name"] = "course";
			$page_data['page_title'] = "Courses";  
			$this->load->view("backend/index", $page_data); 

	}
	
        function department($param1='', $param2=''){
            
            if($param1 == 'create'){

			$this->load->library("form_validation"); 
			$this->form_validation->set_rules('name', 'Name', 'required'); 


			$message = "";
			if($this->form_validation->run()){ 
				$data['title'] = $this->input->post("name"); 

			$this->db->insert('department',  $data);
				$message = "Added Department Successfully!";

			} 
			}
                        
                        if($param1=='do_update'){ 
                           $this->load->library("form_validation");

			$this->load->library("form_validation"); 
			$this->form_validation->set_rules('name', 'Name', 'required'); 


			$message = "";

                           
			$message = "";
                        
			if($this->form_validation->run()){ 
				$data['title'] = $this->input->post("name"); 
                                
                        $this->db->where('id', $param2);
			$this->db->update('department',  $data);
                        $message = "Updated Department Successfully!";

			}
 
                        }
                        
                         if($param1 =='delete'){  
                            $this->db->delete('department', array('id'=>$param2));
                        }
                        
                       
			$page_data['message'] = $message;
			$page_data['departments'] = $this->db->get("department")->result_array();  
			$page_data["page_name"] = "department";
			$page_data['page_title'] = "Departments";  
			$this->load->view("backend/index", $page_data); 

            
        }
	
	function student($param1='', $param2=''){

			if($param1 == 'create'){

			$this->load->library("form_validation");

			$this->form_validation->set_rules('surname', 'Name', 'required'); 
			$this->form_validation->set_rules('department', 'Department', 'required'); 
			$this->form_validation->set_rules('reg_no', 'Reg No', 'required');  


			$message = "";
			if($this->form_validation->run()){  
				$data['name'] = $this->input->post("surname")." ".$this->input->post("other_name");;
				$data['reg_no'] = $this->input->post("reg_no");
				$data['departmentId'] = $this->input->post("department");
                                $data['jamb'] = $this->input->post("jamb");
                                $data['m_o_e']  = $this->input->post("mode_of_entry");
                                $data['sex'] = $this->input->post("sex");
                                $data['marital_status'] = $this->input->post("marital_status");
                                $data['dob'] = $this->input->post("dob");
                                $data['state'] =$this->input->post("state");
                                $data['phone'] = $this->input->post("phone");

			$this->db->insert('student',  $data);
				$message = "Added Student Successfully!";

			}



			}
                        
                        if($param1=='do_update'){ 
                           $this->load->library("form_validation");

			$this->form_validation->set_rules('name', 'Name', 'required'); 
			$this->form_validation->set_rules('department', 'Department', 'required'); 
			$this->form_validation->set_rules('reg_no', 'Reg No', 'required'); 

                           
			$message = "";
                        
			if($this->form_validation->run()){ 
				$data['name'] = $this->input->post("surname")." ".$this->input->post("other_name"); 
				$data['departmentId'] = $this->input->post("department");
				$data['reg_no'] = $this->input->post("reg_no"); 
                                
                                $data['jamb'] = $this->input->post("jamb");
                                $data['m_o_e']  = $this->input->post("mode_of_entry");
                                $data['sex'] = $this->input->post("sex");
                                $data['marital_status'] = $this->input->post("marital_status");
                                $data['dob'] = $this->input->post("dob");
                                
                                $data['state'] =$this->input->post("state");
                                $data['phone'] = $this->input->post("phone");

                                //die("id is ".$param2 . " params " .var_dump($data));
                        $this->db->where('id', $param2);
			$this->db->update('student',  $data);
                        $message = "Updated Student Successfully!";

			}
 
                        }
                        
                         if($param1 =='delete'){ 
                            $this->db->delete('student', array('id'=>$param2));
                        }
                        
                       
			$page_data['message'] = $message;
			$page_data['students'] = $this->db->get("student")->result_array();  
			$page_data["page_name"] = "student";
			$page_data['page_title'] = "Students";  
			$this->load->view("backend/index", $page_data); 

	}
	
	function add_session($param1 ='', $param2 = ' '){
	
	 if ($this->session->userdata('admin_login') != 1)
              redirect(base_url(), 'refresh');

		if($param1=='create'){
			 
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('session', 'Session', 'required'); 
			$this->form_validation->set_rules('reg_no', 'Reg No', 'required');
                        $this->form_validation->set_rules('level', 'Level', 'required'); 
                                 
			if($this->form_validation->run()){
			$data['session'] = $this->input->post('session'); 
			$data['reg_no'] = $this->input->post('reg_no');
                        $data['level'] = $this->input->post('level');
			
		 
		 $result_existing = $this->db->get_where('session', array('session'=>$data['session'], 'reg_no'=>$data['reg_no'], 'level'=>$data['level']))->result_array();
		 	
                 if(count($result_existing)>0){
			
			$page_data["message"] = "Result Already Exists for ".$data['reg_no']." for the ".$data['session']." Session";
			$page_data["page_name"] = "add_session";
			$page_data['page_title'] = "Result";  
			$this->load->view("backend/index", $page_data);
                        
                        
		}
                else if(!$this->result_model->validate_reg_no($data['reg_no'], $data['session'])){
                    
			$page_data["message"] = "Session Year Older than Reg No!";
			$page_data["page_name"] = "add_session";
			$page_data['page_title'] = "Result";  
			$this->load->view("backend/index", $page_data);
                        
                    
                } 
		else{ 
                    $data['departmentId'] = $this->crud_model->get_student_department($data['reg_no']);
                     
                    $this->db->insert('session', $data); 
                    $sessionId = $this->db->insert_id(); 
                   redirect('admin/add_result/'.$sessionId);
			}
                        
                         
                        
                        
                        }
                        
			
			else{
			        $page_data['page_name']  = 'add_session';
					$page_data['page_title'] = 'Add Result'; 
					$this->load->view('backend/index', $page_data);
					
			}
			}
			
	 

		  
        $page_data['page_name']  = 'add_session';
        $page_data['page_title'] = 'Add Result';
		$page_data['class_id'] = $param1;
		$this->load->view('backend/index', $page_data);
	
	
	}

        function edit_session($param1 ='', $param2 = ' '){
	
	 if ($this->session->userdata('admin_login') != 1)
              redirect(base_url(), 'refresh');

		if($param1=='edit'){
			 
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('session', 'Session', 'required'); 
			$this->form_validation->set_rules('reg_no', 'Reg No', 'required');
                        $this->form_validation->set_rules('level', 'Level', 'required'); 
                                 
			if($this->form_validation->run()){
			$data['session']= $this->input->post('session'); 
			$data['reg_no'] = $this->input->post('reg_no');
                        $data['level'] = $this->input->post('level'); 
			 
		 
		 $result_existing = $this->db->get_where('session', array('session'=>$data['session'], 'reg_no'=>$data['reg_no'], 'level'=>$data['level']))->result_array();
		 	
                 if(count($result_existing)>0){ 
                      
                    $sessionId = intval($result_existing[0]['id']); 
                       
                   redirect('admin/edit_result/'.$sessionId);
                        
		}
		else{ 
			$page_data["message"] = "Result Not Found! ";
			$page_data["page_name"] = "edit_session";
			$page_data['page_title'] = "Edit Result";  
			$this->load->view("backend/index", $page_data);
                        }
                        
                         
                        
                        
                        }
                        
			
			else{
			        $page_data['page_name']  = 'add_session';
					$page_data['page_title'] = 'Add Result'; 
					$this->load->view('backend/index', $page_data);
					
			}
			}
			
	 

		  
        $page_data['page_name']  = 'edit_session';
        $page_data['page_title'] = 'Edit Result';
        $page_data['class_id'] = $param1;
        $this->load->view('backend/index', $page_data);
	
	
	}

        function add_result($param1='', $param2='', $param3 =''){ 
            
                    if($param1=='create'){ 
                       
                        
                        $this->load->library("form_validation");
                            
                        $this->form_validation->set_rules('total_unit','Total Unit Load', 'required');
                        $this->form_validation->set_rules('unitload1', '1st Semester Unit Load', 'required'); 
                        $this->form_validation->set_rules('unitload1', '2nd Semester Unit Load', 'required');
                        
                        $length1 = $this->input->post("no_of_courses1");
                        $length2 = $this->input->post("no_of_courses2");
                        
                      
                        for($i=1; $i<= $length1; $i++){
			$this->form_validation->set_rules('sem1course'.$i, 'Course '.$i, 'required');
                        $this->form_validation->set_rules('sem1score'.$i, "Score ".$i, 'required');
                        }
                       
                         for($i=1; $i<= $length2; $i++){ 
			$this->form_validation->set_rules('sem2course'.$i, 'Course '.$i, 'required');
                        $this->form_validation->set_rules('sem2score'.$i, "Score ".$i, 'required');
                        }
                        
                        
                        if($this->form_validation->run()){
                            
                             $total_unit = $this->input->post("total_unit");
                             $unitload1 = $this->input->post("unitload1");
                             $unitload2 = $this->input->post("unitload2");
                             
                            $this->db->where('id',$param2);
                            $ndata = array('unitload'=>$total_unit, 'semester1'=>$unitload1, 'semester2'=>$unitload2);
                           
                            $this->db->update('session', $ndata);
                            
                           
                            $rows = $this->db->get_where('session', array('id'=> $param2))->result_array()[0];
                             
                            for($i=1; $i<=$length1; $i++){ 
                                
                                $course = $this->input->post("sem1course".$i);
                                $score = $this->input->post("sem1score".$i);
                                $unit = $this->input->post("sem1unit".$i); 
                                $reg_no = $rows['reg_no'];
                                $level = $rows['level'];
                                $session = $param2;
                                $datas[$i-1] = array('courseId'=>$course, 'score'=>$score, 'unitload'=>$unit, 'semester'=>1, 'sessionId'=>$session, 'reg_no' =>$reg_no, 'level'=>$level);
                                 
                            }   
                            
                        
                            if(count($datas)>1){
                            $this->db->insert_batch('result_entry', $datas);
                            }
                            else{
                                
                                $this->db->insert("result_entry", $datas[0]);
                                
                            }
                             
                            
                            for($i=1; $i<=$length2; $i++){ 
                                
                                $course = $this->input->post("sem2course".$i);
                                $score = $this->input->post("sem2score".$i);
                                $unit = $this->input->post("sem2unit".$i); 
                                $reg_no = $rows['reg_no'];
                                $level = $rows['level'];
                                $session = $param2;
                                $datas[$i-1] = array('courseId'=>$course, 'score'=>$score, 'unitload'=>$unit, 'sessionId'=>$session, 'semester'=>2, 'reg_no' =>$reg_no, 'level'=>$level);
                            }   
                            if($length2>0){
                            $this->db->insert_batch('result_entry', $datas);
                            }
                            redirect('admin/add_session');
                        }
                             
                        else{
                        $data = $this->db->get_where('session', array('id'=>$param3))->result_array()[0];
                        $page_data["page_name"] = "add_result";
			$page_data['page_title'] = "Result Sheet for " .$data['reg_no']; 
                        $page_data['courses'] = $data['no_of_courses'];
                        $page_data['reg_no'] = $data['reg_no'];
                        $page_data['session_id'] = $param1;
                        $page_data['session'] = $data['session'];
                        $page_data['level'] = $data['level']; 
                        $page_data['departmentId'] = $data['departmentId'];
                        $page_data['department'] = $this->db->get_where('department', array('id'=>$data['departmentId']))->result_array()[0]['title'];
	
                        $this->load->view("backend/index", $page_data);
                        } 
                    
                    }
            
            
                        $data = $this->db->get_where('session', array('id'=>$param1))->result_array()[0];
                
                        $page_data["page_name"] = "add_result";
			$page_data['page_title'] = "Result Sheet for " .$data['reg_no']; 
                        $page_data['courses'] = $data['no_of_courses'];
                        $page_data['reg_no'] = $data['reg_no'];
                        $page_data['session_id'] = $param1;
                        $page_data['session'] = $data['session']; 
                        $page_data['departmentId'] = $data['departmentId'];
                        $page_data['level'] = $data['level'];
                        $page_data['department'] = $this->db->get_where('department', array('id'=>$data['departmentId']))->result_array()[0]['title'];
	
                        $this->load->view("backend/index", $page_data); 
            
        }

        
	 function get_graduants($param1 ='', $param2 = ' '){
	
	 if ($this->session->userdata('admin_login') != 1)
              redirect(base_url(), 'refresh');

         if($param1=='get'){
             
             $this->load->library("form_validation");
             
             $this->form_validation->set_rules("year", "Year", "required");
             
             if($this->form_validation->run()){
                 
                 $year = $this->input->post("year"); 
                 $students = $this->result_model->get_graduants_in_year($year); 
                 
                 if(count($students)<1){
                     
         $page_data['page_name'] = "get_graduants";
        $page_data['page_title'] = "Get Graduants";
        $page_data['message'] = "No Graduants Found For ".$year;
        $this->load->view("backend/index", $page_data);
       
                 }
                 
                 else{
                     $gps = array();
                     $counter = 0;
                     foreach($students as $stu){
                     $gp = $this->result_model->get_gp($stu['reg_no']);
                     $gps[$counter] = $gp;
                     $counter+=1;
                     }
                      
                     $page_data['page_name'] = "graduants_sheet"; 
                     $page_data['gps'] = $gps;  
                     $this->load->view("backend/index", $page_data);
                 }
             }
             else{
         
        $page_data['page_name'] = "get_graduants"; 
        $page_data['page_title'] = "Get Graduants";
        
        
        $this->load->view("backend/index", $page_data);
         }
         }
         else{
         
         $page_data['page_name'] = "get_graduants";
        $page_data['page_title'] = "Get Graduants";
        
        $this->load->view("backend/index", $page_data);
         }
	
	}
        
        
         function get_mass_gp($param1 ='', $param2 = ' '){
	
	 if ($this->session->userdata('admin_login') != 1)
              redirect(base_url(), 'refresh');

         if($param1=='get'){
             
             $this->load->library("form_validation");
             
             $this->form_validation->set_rules("year", "Year", "required");
             
             if($this->form_validation->run()){
                 
                 $year = $this->input->post("year"); 
                 $students = $this->result_model->get_students_in_year($year); 
                 
                 if(count($students)<1){
                     
         $page_data['page_name'] = "get_mass_gp";
        $page_data['page_title'] = "Get GP";
        $page_data['message'] = "No Result Not Found For ".$year;
        $this->load->view("backend/index", $page_data);
       
                 }
                 
                 else{
                     $gps = array();
                     $counter = 0;
                     foreach($students as $stu){
                     $gp = $this->result_model->get_gp($stu['reg_no']);
                     $gps[$counter] = $gp;
                     $counter+=1;
                     }
                      
                     $page_data['page_name'] = "result_sheet_mass"; 
                     $page_data['gps'] = $gps;  
                     $this->load->view("backend/index", $page_data);
                 }
             }
             else{
         
        $page_data['page_name'] = "get_mass_gp"; 
        $page_data['page_title'] = "Get GP";
        
        
        $this->load->view("backend/index", $page_data);
         }
         }
         else{
         
         $page_data['page_name'] = "get_mass_gp";
        $page_data['page_title'] = "Get GP";
        
        $this->load->view("backend/index", $page_data);
         }
	
	}
      
        function outstanding_course($param1= '', $param2 = ' '){
             if ($this->session->userdata('admin_login') != 1)
              redirect(base_url(), 'refresh');

         if($param1=='get'){
             
             $this->load->library("form_validation");
             
             $this->form_validation->set_rules("year", "Year", "required");
             
             if($this->form_validation->run()){
                 
                 $year = $this->input->post("year"); 
                 $students = $this->result_model->get_students_in_year($year); 
                 
                 if(count($students)<1){
                     
         $page_data['page_name'] = "outstanding_course";
        $page_data['page_title'] = "Outstanding Course";
        $page_data['message'] = "No Outstanding Courses Found For Reg Nos starting with".$year;
        $this->load->view("backend/index", $page_data);
       
                 }
                 
                 else{
                     
                   $outstanding_courses =  $this->result_model->get_mass_outstanding_courses($students);
                      
                     $page_data['page_name'] = "outstanding"; 
                     $page_data['outstanding_courses'] = $outstanding_courses;  
                     $this->load->view("backend/index", $page_data);
                 }
             }
             else{
         
        $page_data['page_name'] = "outstanding_course"; 
        $page_data['page_title'] = "Outstanding Course";
        
        
        $this->load->view("backend/index", $page_data);
         }
         }
         else{
         
         $page_data['page_name'] = "outstanding_course";
        $page_data['page_title'] = "Outstanding Course";
        
        $this->load->view("backend/index", $page_data);
         }
	
            
            
        }
	function edit_result($param1='', $param2='', $param3 =''){ 
            
                    if($param1=='edit'){ 
                        $length1 = $this->input->post("no_of_courses1");
                        $length2 = $this->input->post("no_of_courses2");
                        
                        
                     
                        $this->load->library("form_validation");
                            
                        $this->form_validation->set_rules('total_unit','Total Unit Load', 'required');
                        
                        for($i=1; $i<= $length1; $i++){
                             
			$this->form_validation->set_rules('sem1course'.$i, 'Semester 1 Course '.$i, 'required');
                        $this->form_validation->set_rules('sem1score'.$i, "Semester 1 Score ".$i, 'required');
                        }
                        
                          for($i=1; $i<= $length2; $i++){
                             
			$this->form_validation->set_rules('sem2course'.$i, 'Semester 2 Course '.$i, 'required');
                        $this->form_validation->set_rules('sem2score'.$i, "Semester 2 Score ".$i, 'required');
                        }
                         
                        if($this->form_validation->run()){
                           
                             $total_unit = $this->input->post("total_unit");
                             $unitload1 = $this->input->post("unitload1");
                             $unitload2 = $this->input->post("unitload2");
                            $this->db->where('id',$param2);
                            $this->db->update('session', array('unitload'=>$total_unit, 'semester1'=>$unitload1, 'semester2'=>$unitload2));
                            $datas = array();
                            
                            $data = $this->db->get_where('session', array('id'=>$param2))->result_array()[0];
                            for($i=1; $i<=$length1; $i++){  
                                
                              
                                $course = $this->input->post("sem1course".$i);
                                $score = $this->input->post("sem1score".$i);
                                $unit = $this->input->post("sem1unit".$i); 
                                $session = $param2;
                                $reg_no = $data['reg_no'];
                                $level = $data['level'];
                                $id = $this->input->post("sem1id".$i); 
                               
                                     
                                    $new_entries = array('score'=>$score, 'courseId'=>$course, 'unitload'=>$unit); 
                                    $this->db->where('id', $id);
                                    $this->db->update('result_entry', $new_entries);
                                
                                 
                                
                            }
                            
                                   for($i=1; $i<=$length2; $i++){  
                                $course = $this->input->post("sem2course".$i);
                                $score = $this->input->post("sem2score".$i);
                                $unit = $this->input->post("sem2unit".$i); 
                                $session = $param2;
                                $reg_no = $data['reg_no'];
                                $level = $data['level'];
                                $id = $this->input->post("sem2id".$i); 
                               
                                        
                                    $new_entries = array('score'=>$score, 'courseId'=>$course, 'unitload'=>$unit);
                                     
                                    $this->db->where('id', $id);
                                    $this->db->update('result_entry', $new_entries);
                                
                                 
                                
                            }
                            
                            
                            
                            
                            
                             $data = $this->db->get_where('session', array('id'=>$param2))->result_array()[0];
                
                        $page_data["page_name"] = "edit_result";
			$page_data['page_title'] = "Edit Result Sheet for " .$data['reg_no']; 
                        $page_data['courses'] = $data['no_of_courses'];
                        $page_data['reg_no'] = $data['reg_no'];
                        $page_data['total_unit'] = $data['unitload'];
                        $page_data['unitload1'] = $data['semester1'];
                        $page_data['unitload2'] = $data['semester2'];
                        $page_data['session_id'] = $param2;
                        $page_data['session'] = $data['session'];
                        
                        $page_data['level'] = $data['level'];
                        $page_data['departmentId'] = $data['departmentId'];
                        $page_data['department'] = $this->db->get_where('department', array('id'=>$data['departmentId']))->result_array()[0]['title'];
                         
                           
                        
                        $entries1 = array(); 
                        $test = array('sessionId'=>$param2, 'semester'=>1, 'reg_no'=>$data['reg_no'], 'level'=>$data['level']);
                        
                        $row = $this->db->get_where('result_entry', $test )->result_array();
                        
                        for($j = 0; $j < count($row); $j++){ 
                            $entries1[$j] = array('courseId'=>$row[$j]['courseId'], 'score'=>$row[$j]['score'], 'id'=>$row[$j]['id'], 'units'=>$row[$j]['unitload'], 'grade'=>$this->result_model->get_grade_letter($row[$j]['score']));
                        }
                         
                        $entries2 = array();
                        
                        $test2 = array('sessionId'=>$param2, 'semester'=>2, 'reg_no'=>$data['reg_no'], 'level'=>$data['level']);
                            
                         $row = $this->db->get_where('result_entry', $test2)->result_array();
                        
                        for($j = 0; $j < count($row); $j++){ 
                            $entries2[$j] = array('courseId'=>$row[$j]['courseId'], 'score'=>$row[$j]['score'], 'id'=>$row[$j]['id'], 'units'=>$row[$j]['unitload'], 'grade'=>$this->result_model->get_grade_letter($row[$j]['score']));
                        }
                        
                        $page_data['entries1'] = $entries1;
                        $page_data['entries2'] = $entries2;
                        $this->load->view("backend/index", $page_data);
		  
                        }
                             
                        else{
                          $data = $this->db->get_where('session', array('id'=>$param1))->result_array()[0];
                
                        $page_data["page_name"] = "edit_result";
			$page_data['page_title'] = "Edit Result Sheet for " .$data['reg_no']; 
                        $page_data['courses'] = $data['no_of_courses'];
                        $page_data['reg_no'] = $data['reg_no'];
                        $page_data['total_unit'] = $data['unitload'];
                        
                        $page_data['unitload1'] = $data['semester1'];
                        $page_data['unitload2'] = $data['semester2'];
                        $page_data['session_id'] = $param1;
                        $page_data['session'] = $data['session'];
                        
                        $page_data['departmentId'] = $data['departmentId'];
                        $page_data['level'] = $data['level'];
                        $page_data['department'] = $this->db->get_where('department', array('id'=>$data['departmentId']))->result_array()[0]['title'];
                           
                        
                        $entries1 = array(); 
                        $row = $this->db->get_where('result_entry', array('sessionId'=>$param1, 'semester'=>1, 'reg_no'=>$data['reg_no'], 'level'=>$data['level']))->result_array();
                        
                        for($j = 0; $j < count($row); $j++){ 
                            $entries1[$j] = array('courseId'=>$row[$j]['courseId'], 'score'=>$row[$j]['score'], 'id'=>$row[$j]['id'], 'units'=>$row[$j]['unitload'], 'grade'=>$this->result_model->get_grade_letter($row[$j]['score']));
                        }
                        
                        $entries2 = array();
                         $row = $this->db->get_where('result_entry', array('sessionId'=>$param1, 'semester'=>2, 'reg_no'=>$data['reg_no'], 'level'=>$data['level']))->result_array();
                        
                        for($j = 0; $j < count($row); $j++){ 
                            $entries2[$j] = array('courseId'=>$row[$j]['courseId'], 'score'=>$row[$j]['score'], 'id'=>$row[$j]['id'], 'units'=>$row[$j]['unitload'], 'grade'=>$this->result_model->get_grade_letter($row[$j]['score']));
                        }
                            
                        $page_data['entries1'] = $entries1;
                        $page_data['entries2'] = $entries2;
                        $this->load->view("backend/index", $page_data);
		   } 
                    
                    }
                    else{
                        
                       
            
                        $data = $this->db->get_where('session', array('id'=>$param1))->result_array()[0];
                
                        $page_data["page_name"] = "edit_result";
			$page_data['page_title'] = "Edit Result Sheet for " .$data['reg_no']; 
                        $page_data['courses'] = $data['no_of_courses'];
                        $page_data['reg_no'] = $data['reg_no'];
                        $page_data['total_unit'] = $data['unitload'];
                        
                        $page_data['unitload1'] = $data['semester1'];
                        $page_data['unitload2'] = $data['semester2'];
                        $page_data['session_id'] = $param1;
                        $page_data['session'] = $data['session'];
                        $page_data['level'] = $data['level'];
                        
                        $page_data['departmentId'] = $data['departmentId'];
                        $page_data['department'] = $this->db->get_where('department', array('id'=>$data['departmentId']))->result_array()[0]['title'];
                           
                        
                        $entries1 = array(); 
                        $row = $this->db->get_where('result_entry', array('sessionId'=>$param1, 'semester'=>1, 'reg_no'=>$data['reg_no'], 'level'=>$data['level']))->result_array();
                        
                        for($j = 0; $j < count($row); $j++){ 
                            $entries1[$j] = array('courseId'=>$row[$j]['courseId'], 'score'=>$row[$j]['score'], 'id'=>$row[$j]['id'], 'units'=>$row[$j]['unitload'], 'grade'=>$this->result_model->get_grade_letter($row[$j]['score']));
                        }
                        
                        $entries2 = array();
                         $row = $this->db->get_where('result_entry', array('sessionId'=>$param1, 'semester'=>2, 'reg_no'=>$data['reg_no'], 'level'=>$data['level']))->result_array();
                        
                        for($j = 0; $j < count($row); $j++){ 
                            $entries2[$j] = array('courseId'=>$row[$j]['courseId'], 'score'=>$row[$j]['score'], 'id'=>$row[$j]['id'], 'units'=>$row[$j]['unitload'], 'grade'=>$this->result_model->get_grade_letter($row[$j]['score']));
                        }
                        
                        
                        $page_data['entries1'] = $entries1;
                        $page_data['entries2'] = $entries2;
                        $this->load->view("backend/index", $page_data);
		  
				 
                    }
        }
        
        function delete_row_ajax(){
            
            $id = $this->input->post("id");
            $this->db->delete("result_entry", array('id'=>$id));
           echo $id;
        }
        function add_row_ajax(){
            
            $session = $this->input->post("session"); 
            $regno = $this->input->post("regno");   
            $level = $this->input->post("level");
            $semester = $this->input->post("semester");
            
            $data = array('sessionId'=>$session,'level'=>$level, 'semester'=>$semester, 'reg_no'=>$regno);
            
            $this->db->insert('result_entry', $data);
            $id = $this->db->insert_id();
            echo $id;
            
        
        }
        
        function get_gp($param1 ='', $param2 = ' '){
	
	 if ($this->session->userdata('admin_login') != 1)
              redirect(base_url(), 'refresh');

         if($param1=='get'){
             
             $this->load->library("form_validation");
             
             $this->form_validation->set_rules("reg_no", "Reg No", "required");
             
             if($this->form_validation->run()){
                 
                 $reg_no = $this->input->post("reg_no"); 
                 $results = $this->db->get_where('result_entry', array('reg_no'=>$reg_no))->result_array();
                 
                 if(count($results)<1){
                     
         $page_data['page_name'] = "get_gp";
        $page_data['page_title'] = "Get GP";
        $page_data['message'] = "Result Not Found For ".$reg_no;
        $this->load->view("backend/index", $page_data);
       
                 }
                 
                 else{
                     $gp = $this->result_model->get_gp($reg_no);
                     $page_data['page_name'] = "result_sheet"; 
                     $page_data['gp'] = $gp;  
                     $this->load->view("backend/index", $page_data);
                 }
             }
             else{
         
        $page_data['page_name'] = "get_gp"; 
        $page_data['page_title'] = "Get GP";
        
        
        $this->load->view("backend/index", $page_data);
         }
         }
         else{
         
         $page_data['page_name'] = "get_gp";
        $page_data['page_title'] = "Get GP";
        
        $this->load->view("backend/index", $page_data);
         }
	
	}

	
	function select_result($param1 = "", $param2= ""){
	
		if($param2=="create"){
		
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('session', 'Session', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$this->form_validation->set_rules('term', 'Term', 'required');
			
			if($this->form_validation->run()){
			 
			$session  = $this->input->post('session');
			$term = $this->input->post('term');
			$subject  = $this->input->post('subject');
			$class = $param1;
		

		$result = $this->db->get_where('result', array('class_id'=>$class, 'Session'=>$session, 'Term'=>$term))->result_array();
			
			if(count($result) == 0){
				$page_data['message'] = "Result Sheet not found ";
				$page_data['page_name']  = 'select_result';
        $page_data['page_title'] = 'Select Result for Class '.$this->crud_model->get_class_name( $param1);
		$page_data['class_id'] = $param1;
		$this->load->view('backend/index', $page_data);
				}
				
				else{
			session_start();
			unset($_SESSION['subject_id']);
			unset($_SESSION['term']);
			unset($_SESSION['session']);
			unset($_SESSION['class_id']); 

			$_SESSION['subject_id'] = $subject;
			$_SESSION['term'] = $term;
			$_SESSION['session'] = $session;
			$_SESSION['class_id'] = $param1;
			redirect("admin/result/$param1");
		
				}
		
			}
			
			   $page_data['page_name']  = 'select_result';
        $page_data['page_title'] = 'Select Result for Class '. $param1;
		$page_data['class_id'] = $param1;
		$this->load->view('backend/index', $page_data);
		
		
		}
	
	
	
	     $page_data['page_name']  = 'select_result';
        $page_data['page_title'] = 'Select Result for Class '. $param1;
		$page_data['class_id'] = $param1;
		$this->load->view('backend/index', $page_data);
	
	}

    function get_unit(){
        
        $id = $this->input->post("id");
        echo $this->crud_model->get_unit($id);
    }
    /****MANAGE TEACHERS*****/
     
function general_result($student, $class,  $session1, $session2,$term){
	

		$session = $session1."/".$session2;
		 $scores = $this->result_model->get_general_scores($student, $session, $class);
  		
		$total = $this->result_model->get_total($scores);  
 		

		$page_data['noOfCourses'] = count($scores);
		$page_data['class_id'] = $class;
		$page_data['student_id']  = $student;
 		$page_data['term'] = "1st, 2nd, and 3rd";
 		$page_data['numeric_term'] = 4;
		
 
		$page_data['session'] =  $session;

		
		
		$page_data['page_title'] = "Session Result Sheet For ". $this->crud_model->get_student_name($student);
		$page_data['class_member_count'] =  count($this->db->get_where('student', array('class_id'=>$class))->result_array());
		$page_data['class_name'] =   $this->crud_model->get_class_name($class); 
		$page_data['student_name'] = $this->crud_model->get_student_name($student);
		$page_data['page_name'] = "general_result_sheet";
		$page_data['year'] = $session1;


		//@todo  create a moidel to get position
		$position = $this->result_model->get_general_position($student, $class, $session, $term);
		 $page_data['position']   = $this->result_model->get_presentable_digit($position);
		$page_data['average'] = $this->result_model->get_average($total, count($scores));

		 $teacher_comment = $this->result_model->get_teacher_comment($student, $session, 4, $class);

	 	$page_data['teacher_comment'] = $teacher_comment;
		  	$page_data['principal_comment'] = $this->result_model->get_principal_comment($student, $session, 4, $class); 	 	 
		//die("comment". var_dump($teacher_comment));

		//$page_data['teacher_comment'] each(array)
 		$page_data['total'] = $total; 
		$page_data['scores'] = $scores; 


 		
		$this->load->view('backend/index', $page_data);
	
	
 
	}



    
    /****MANAGE SUBJECTS*****/
	
	function marksheet($student, $class, $term, $session1, $session2){
	

		$session = $session1."/".$session2;
		 $scores = $this->result_model->get_scores($student, $session, $term, $class);
 
		$total = $this->result_model->get_total($scores);  
 

		$page_data['noOfCourses'] = count($scores);
		$page_data['class_id'] = $class;
		$page_data['student_id']  = $student;
 		$page_data['term'] = $this->result_model->get_presentable_digit($term);
 		$page_data['numeric_term'] = $term;
		
 
		$page_data['session'] =  $session;

		
		
		$page_data['page_title'] = "Termly Result Sheet For ". $this->crud_model->get_student_name($student);
		$page_data['class_member_count'] =  count($this->db->get_where('student', array('class_id'=>$class))->result_array());
		$page_data['class_name'] =   $this->crud_model->get_class_name($class); 
		$page_data['student_name'] = $this->crud_model->get_student_name($student);
		$page_data['page_name'] = "result_sheet";
		$page_data['year'] = $session1;


		//@todo  create a moidel to get position
		$position = $this->result_model->get_position($student, $class, $session, $term);
		 $page_data['position']   = $this->result_model->get_presentable_digit($position);
		$page_data['average'] = $this->result_model->get_average($total, count($scores));

		$teacher_comment = $this->result_model->get_teacher_comment($student, $session, $term, $class);

		$page_data['teacher_comment'] = $teacher_comment;
		 	$page_data['principal_comment'] = $this->result_model->get_principal_comment($student, $session, $term, $class); 	 	 
		//die("comment". var_dump($teacher_comment));

		//$page_data['teacher_comment'] each(array)
 		$page_data['total'] = $total; 
		$page_data['scores'] = $scores; 


 		
		$this->load->view('backend/index', $page_data);
	
	
 
	}
	 
     
    
    /**********MANAGING CLASS ROUTINE******************/
     /****** DAILY ATTENDANCE *****************/
  
    /********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    
    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($param1 == 'do_update') {
			 
			 $data['description'] = $this->input->post('system_name');
			 $this->db->where('type' , 'system_name');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('system_title');
			 $this->db->where('type' , 'system_title');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('address');
			 $this->db->where('type' , 'address');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('phone');
			 $this->db->where('type' , 'phone');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('paypal_email');
			 $this->db->where('type' , 'paypal_email');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('currency');
			 $this->db->where('type' , 'currency');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('system_email');
			 $this->db->where('type' , 'system_email');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('buyer');
			 $this->db->where('type' , 'buyer');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('system_name');
			 $this->db->where('type' , 'system_name');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('purchase_code');
			 $this->db->where('type' , 'purchase_code');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('language');
			 $this->db->where('type' , 'language');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('text_align');
			 $this->db->where('type' , 'text_align');
			 $this->db->update('settings' , $data);
			 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;	
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);
			
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('backend/index', $page_data);	
    }
    
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('admin_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
}

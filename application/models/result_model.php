<?php 

//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    
    
    function validate_reg_no($regNo, $session){ 
        if(count(explode("/",$regNo)) < 2 || count(explode("-",$session)) < 2 ) return false; 
        
        $regYear = intval(explode("/", $regNo)[0]);
         $sessionYear = intval(explode("/", $session)[0]); 
        return $sessionYear >= $regYear; 
        
    }
    
    
    function get_graduants_in_year($year){ 
        
    $students = array();
    
    $all_students = $this->db->get("student")->result_array();
    $counter = 0;
    foreach($all_students as $student){
        
       $year_s = explode("/", $student['reg_no'])[0]; 
       
        if(strcmp($year_s, $year)==0){
            $students[$counter] = $student;
            $counter+=1;
        }
         
        }
        
        //get graduants by sieving out non graduants
        $graduants = array();
        
        $counter=0;
        
        foreach($students as $student){
            $gp = $this->get_specific_gp($student['reg_no']);
            if($this->has_passed($gp, $student['departmentId'])){
                $graduants[$counter++] = $student; 
            }
        }
        
        return $graduants;  
    
    }
    
    
    
    function get_class_courses($level, $dept, $semester){
      $this->load->database();
      $results = $this->db->get_where('course', array('departmentId'=>$dept, 'level'=>$level, 'semester'=>$semester))->result_array();
       
      if(count($results)>0){
      return $results;
      } 
      
      return $this->db->get_where('course', array('departmentId'=>$dept))->result_array();
    }
    function get_potential_failed_courses($level, $dept, $semester){
     
    $this->load->database(); 
    $results = $this->db->get_where('course', array('departmentId'=>$dept, 'semester'=>$semester))->result_array();
    $counter = 0;
    for($i = 0; $i < count($results); $i++){
        
        if(intval($results[$i]['level']) >= $level){
            
            unset($results[$i]);
        }
    }
     return $results;
        
    }
    function get_student_level($reg_no){
        
        $reg_year = intval(explode('/', $reg_no)[0]);
        
        $current_year = intval(date("Y"));
        
        $level = ($current_year - $reg_year) * 100;
         
        return $level;
        
    }
    
    function get_students_in_year($year){
    
    $students = array();
    
    $all_students = $this->db->get("student")->result_array();
    $counter = 0;
    foreach($all_students as $student){
        
       $year_s = explode("/", $student['reg_no'])[0]; 
       
        if(strcmp($year_s, $year)==0){
            $students[$counter] = $student;
            $counter+=1;
        }
         
        }
        
        return $students;
    }
       
        
    
    
    function get_gp($reg_no){ 
        $no_of_sessions = $this->get_no_of_sessions($reg_no);  
        $total_units = 0;
        $total_grade = 0;
        $department = $this->get_department($reg_no);
        
        $student_name = $this->get_student_name($reg_no);
        $sessions = $this->get_sessions($reg_no);
        $info = $this->get_student_info($reg_no);
        $details = $this->get_details($sessions);  
        $gp = array();
        $g_g  = 0;
        
        for($i = 0; $i < count($sessions); $i++){
            
            $gp['gp'][$i] = $this->get_specific_gp($sessions[$i]);
            $g_g+=$gp['gp'][$i]['session_gp'];
            $total_grade+= ($gp['gp'][$i]['semester1_points'] + $gp['gp'][$i]['semester2_points']); 
            $total_units+= ($gp['gp'][$i]['semester2_credits'] + $gp['gp'][$i]['semester1_credits']);
            
        }
        
        
        
        
        $gp['general_gp'] = number_format(($total_grade/$total_units), 3, '.', '');  ;
        
        $degree = $this->get_degree($gp['general_gp']);
        $gp['total_grade'] = $total_grade;
        $gp['degree']=$degree;
        $gp['info'] = $info;
        $gp['total_units'] = $total_units;
        $gp['sessions'] = $sessions;
        $gp['details'] = $details;
        $gp['name'] = $student_name;
        $gp['reg_no'] = $reg_no;
        $gp['department'] = $department;
        $depId = $this->crud_model->get_department_id($department);
         
        $gp['outstanding_courses'] = $this->get_outstanding_courses($reg_no, $depId);
        
        return $gp;
        
    }
    
    function get_student_info($reg_no){
        
        return $this->db->get_where('student', array('reg_no'=>$reg_no))->result_array()[0];
    }
    
    function get_outstanding_courses($reg, $depId){
        
        //get all courses from database relating to this department
        //for each of them
        //if this gp has no passed entry of it, its outstanding 
        $outstanding_courses = array();
        
        $courses = $this->db->get_where('course', array('departmentId'=>$depId))->result_array();  
        
        $reg_courses = $this->db->get_where("result_entry", array("reg_no"=>$reg))->result_array();
        
        $counter = 0;
        $courses_list  = ""; 
        
        $details = $this->db->get_where('student', array('reg_no'=>$reg))->result_array()[0];
               $outstanding_courses['name'] =  $details['name'];
               $outstanding_courses['department'] = $this->get_department($reg);
               $outstanding_courses['reg_no'] = $details['reg_no'];
        foreach($courses as $course){
            
            if(!$this->has_passed($reg_courses, $course)){
               
            $courses_list.= $course['code'] . ", "; 
               }
        }
        $outstanding_courses['outstanding'] = $courses_list;
        return $outstanding_courses;
    }
    
    function get_mass_outstanding_courses($reg){ 
        $i = 0;
        $outs = array();
      
       foreach($reg as $r){  
             $re = $r['reg_no'];  
             $depId = $r['departmentId'];
           $outstanding = $this->get_outstanding_courses($re, $depId); 
           if(count($outstanding)>0){
               $outs[$i] = $outstanding;
               $i++;
           }
           
       }
      
       return $outs;
        
    }
    
    function has_passed($reg_courses, $course){ 
            
        for($i = 0; $i < count($reg_courses); $i++){ 
            if($course['id'] == $reg_courses[$i]['courseId'] && intval($reg_courses[$i]['score']) > 40 ){
                
                return true;
            
        }
            
        }
        
        return false;
        
    }
    
    function get_details($sessions){
       
        $biggest = 1;
        
        for($i = 0; $i < count($sessions); $i++){
            
            if($this->get_session_digit($sessions[$i]) > $this->get_session_digit($biggest)){
                
                $biggest = $sessions[$i];
            }
        }
      
        return $biggest;
        
    }
    
    
    function get_session_digit($session){
        
        $result = explode("-", $session['session'])[1];
        $i = intval($result); 
        return $i;
    }
    
    
    function get_specific_gp($session){
      
      $sessionId = $session['id'];
      $reg_no = $session['reg_no'];
      $level = $session['level'];
      $semester1 = $session['semester1'];
      $semester2 = $session['semester2'];
       
    $gp = array();
        
        
        
    $entries1 = array();
     
    //get all result_entries associated with this semester
    $test2 = array('sessionId'=>$sessionId, 'semester'=>1, 'reg_no'=>$reg_no, 'level'=>$level);
                            
    $row1 = $this->db->get_where('result_entry', $test2)->result_array();
    $session_tc = 0;
    $session_tp = 0;
    
    $semester_credits1 = 0;
    $semester_points1  = 0;
     $row = $row1;             
    for($j = 0; $j < count($row); $j++){  
     $name = $this->get_course_name($row[$j]['courseId']);
    $entries1[$j] = array('course'=>$name, 'unit'=> $this->get_course_unit($row[$j]['courseId']), 'code'=>$this->get_course_code($row[$j]['courseId']),'grade'=>$this->get_grade_letter($row[$j]['score']), 'id'=>$row[$j]['id'], 'session'=>$session['session'], 'grade_point'=>$this->get_course_grade($this->get_course_unit($row[$j]['courseId']), $this->get_grade($row[$j]['score'])), 'semester'=>$row[$j]['semester']);
    
    
    $semester_credits1+=intval($entries1[$j]['unit']); 
    $semester_points1+=intval($entries1[$j]['grade_point']); 
            
    }
            
    
    $entries2 = array();
                        
    $test2 = array('sessionId'=>$sessionId, 'semester'=>2, 'reg_no'=>$reg_no, 'level'=>$level);
                            
    $row2 = $this->db->get_where('result_entry', $test2)->result_array();
        $row = $row2;                
     
    $semester_credits2 = 0;
    $semester_points2  = 0;
    for($j = 0; $j < count($row); $j++){  
    $name = $this->get_course_name($row[$j]['courseId']);
    $entries2[$j] = array('course'=>$name, 'unit'=> $this->get_course_unit($row[$j]['courseId']), 'code'=>$this->get_course_code($row[$j]['courseId']), 'grade_point'=>$this->get_course_grade($this->get_course_unit($row[$j]['courseId']), $this->get_grade($row[$j]['score'])),  'grade'=>$this->get_grade_letter($row[$j]['score']), 'id'=>$row[$j]['id'], 'semester'=>$row[$j]['semester']);
            
    $semester_credits2+=intval($entries2[$j]['unit']); 
    $semester_points2+=intval($entries2[$j]['grade_point']); 
        }
            
    
    $gp[1]= $entries1;
    $gp[2] = $entries2;
    
    
    $gp['semester1_credits'] = $semester_credits1;
    $gp['semester1_points'] = $semester_points1;
    $s1 = $semester_points1/$semester_credits1;
    $s2 = $semester_points2/$semester_credits2;
    $gp[1]['sgp'] = number_format($s1, 3, '.', '');  
    $gp[2]['sgp'] = number_format($s2, 3, '.', '');
    $gp['semester2_credits'] = $semester_credits2;
    $gp['semester2_points'] = $semester_points2;
    $gp['tc'] = ($semester_credits1 + $semester_credits2);
    $gp['tp'] = $semester_points2+ $semester_points1;   
    $gp['session_gp'] = (($gp[1]['sgp']+$gp[2]['sgp'])/2);
    
    return $gp;
    }
    
    
       function get_course_name($courseId){ 
          
       $title  =  $this->db->get_where("course", array("id"=>$courseId))->result_array()[0]['title'];
        return $title; 
    }
    
    function get_course_grade($unit, $grade){
        
        return intval($unit) * intval($grade);
    }
    
    function get_grade_point($g){
        
     
        switch($g){
            
            case "A":
                return 5;
                break;
            case "B":
                return 4;
                break;
            case "C":
                return 3;
                break;
            case "D":
                return 2;
            case "E":
                return 1;
            case "F":
                return 0;
        }
    }
    function get_semester_gp($entries, $total_units){ 
      $total_grade_points = $this->get_semester_grade_points($entries); 
      $g = $total_grade_points/$total_units;
       
      return $g;
        
    }
    
    function get_semester_grade_points($entries){
        
      $points = 0;
      
      for($i = 0; $i < count($entries); $i++){
          
            $point = $this->get_grade($entries[$i]['score']); 
            $unit = $entries[$i]['unitload']; 
            $points+=( $point * $unit); 
      }
      
      return $points;
        
    }
    
    function get_sum_units($entries){
        
        $units = 0;
        
        for($i = 0; $i < count($entries); $i++){
            
            $units+= intval($entries[$i]['unitload']);
        }
        
        return $units;
    }
    function get_course_code($courseId){
        
        $code = $this->db->get_where("course", array("id"=>$courseId))->result_array()[0]['code'];
        
        return $code;
        
    }
    
    function get_course_load($courseId){
        
        $unit = $this->db->get_where("course", array("id"=>$courseId))->result_array()[0]['units'];
        
        return $unit;
        
    }
    function get_student_name($reg_no){
        
        $name = $this->db->get_where("student", array('reg_no' =>$reg_no))->result_array()[0]['name'];
        
        return $name;
    }
    
    function get_degree($gp){
        
        if($gp < 1.5){
            return "FAIL";
        }
        
        if($gp < 2.39){
        return "Third Class";
    }
    
    if($gp < 3.49){
        
        return "Second Class Lower";
    }
    
    if($gp < 4.49){
        
        return "Second Class Upper";
    }
    
    return "First Class";
    }
    
     function get_department($reg){
        
         $d_id = $this->db->get_where('student', array('reg_no'=>$reg))->result_array()[0]['departmentId'];
        
         $dept = $this->db->get_where('department', array('id'=>$d_id))->result_array()[0]['title'];
         
         return $dept;
     }
    
    function get_general_gp($reg_no){  
        
      $total_units = $this->get_general_units($reg_no);  
      $total_grade_points = $this->get_general_grade_points($reg_no);
      
      return $total_grade_points/$total_units;
        
    }
    
    function get_general_units($reg_no){
    $units = 0;
    
    $results = $this->db->get_where('session', array('reg_no'=>$reg_no))->result_array();
    
    for($i = 0 ; $i < count($results); $i++){
        
        $units+=$results[$i]['unitload'];
    
    }
    
    return $units;
    
    }
    
    function get_general_grade_points($reg_no){
        
        $results = $this->db->get_where('result_entry', array('reg_no'=>$reg_no))->result_array(); 
        $grade_points  = 0;
        
        for($i =0; $i < count($results); $i++){
            
            $point = $this->get_grade($results[$i]['score']); 
            $unit = $this->get_course_unit($results[$i]['courseId']); 
            
            $grade_points+=( $point * $unit); 
        }
         
        return $grade_points;
    }
    
    function get_course_unit($id){ 
        $unit = $this->db->get_where('course', array('id'=>$id))->result_array()[0]['units'];
        
        return $unit;
    }
    
    
        
    function get_grade_letter($score){
        
           if($score < 40){
             
             return "F";
        }
        
        if($score < 45){
            return "E";
        }
        
        if($score < 50){
            return "D";
        }
        
        if($score < 60){
            return  "C";
        }
        
        if($score < 70){
            
            return "B";
        }
        
        return "A";
                
        
    }
    
    function get_grade($score){
        
           if($score < 40){
             
             return 0;
        }
        
        if($score < 45){
            return 1;
        }
        
        if($score < 50){
            return 2;
        }
        
        if($score < 60){
            return  3;
        }
        
        if($score < 70){
            
            return 4;
        }
        
        return 5;
                
        
    }
    
    
    
    
    
    function get_sessions($reg_no){ 
       $results = $this->db->get_where('session', array('reg_no'=>$reg_no))->result_array();
     
        
       return $results;
        
    }
    
    
    function get_no_of_sessions($reg_no){ 
       $results = $this->db->get_where('session', array('reg_no'=>$reg_no))->result_array();
       
       $sessions = array();
       for($i = 0; $i < count($results); $i++){
           
           if(!isset($sessions[$results['session']])){
               
               $sessions[$results['session']] = 1;
           }
           
       }
        
       return count($results);
        
    }
    
    
    
    
    
                
                
//return '1st' instead of '1' and all..
                 
            


}

?>
<?php

Class Homeworkmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL SECTION

		 function get_teacher_id($user_id)
		 {
			$query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			 foreach($row as $rows){}
			 $teacher_id=$rows->teacher_id;
			 $get_classes="SELECT class_name FROM edu_teachers WHERE teacher_id='$teacher_id'";
			 $resultset1=$this->db->query($get_classes);
			 $teacher_row=$resultset1->result();
			  foreach($teacher_row as $teacher_rows){}
			$teach_id=$teacher_rows->class_name;
			
			$sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
			$objRs=$this->db->query($sQuery);
			$row=$objRs->result();
			foreach ($row as $rows1)
			{
			$s= $rows1->class_sec_id;
			$sec=$rows1->class;
			$clas=$rows1->class_name;
			$sec_name=$rows1->sec_name;
			$arryPlatform = explode(",", $teach_id);
		   $sPlatform_id  = trim($s);
		   $sPlatform_name  = trim($sec);
				 if(in_array($sPlatform_id, $arryPlatform )) {
					 $class_id[]=$s;
			 $class_name[]=$clas;
			 $sec_n[]=$sec_name;
 			 }
 			 }
      // print_r($sec_n);exit
      if(empty($class_id)){
        $data= array("status" =>"No Record Found");
        return $data;
      }else{

        $data= array("class_id" => $class_id,"class_name"=>$class_name,"sec_name"=>$sec_n,"status"=>"Record Found");
        return $data;
      }
        //print_r($data);exit;
       }
	   
	    function create_test($year_id,$class_id,$user_id,$test_type,$title,$subject_name,$formatted_date,$format_date,$details)
	   {
		      $check_test_date="SELECT * FROM edu_homework WHERE test_date='$formatted_date' AND subject_id='$subject_name'";
			  $result=$this->db->query($check_test_date);
			  if($result->num_rows()==0)
			  {
			  $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			  $resultset=$this->db->query($query);
			  $row=$resultset->result();
			  //foreach($row as $rows){}
			  $teacher_id=$row[0]->teacher_id;
			  
			  $query="INSERT INTO edu_homework(year_id,class_id,teacher_id,hw_type,subject_id,title,test_date,due_date,hw_details,status, created_at)VALUES('$year_id','$class_id','$teacher_id','$test_type','$subject_name','$title','$formatted_date','$format_date','$details','A',NOW())";
			  $resultset=$this->db->query($query);
			  $data= array("status"=>"success");
			  return $data;
			  }else{
					$data= array("status"=>"Test Date Already Exist");
					return $data;
				  }
				   
	   }
	   
	   function getall_details($user_id)
	   {
		    $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			//foreach($row as $rows){}
			$id=$row[0]->teacher_id;
			 
		  //$query="SELECT * FROM edu_homework ";
		   $query="SELECT eh.*,cm.class_sec_id,cm.class,cm.section,c.*,s.*,su.* FROM edu_homework as eh,edu_classmaster AS cm,edu_subject AS su,edu_class AS c,edu_sections AS s WHERE eh.teacher_id='$id' AND eh.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND eh.subject_id=su.subject_id ORDER BY eh.hw_id DESC";
          $result=$this->db->query($query);
          return $result->result();
	   }
	  function get_stu_details($hw_id)
	  { 
		  $query="SELECT eh.*,cm.*,c.*,s.*,su.*,ed.* FROM edu_homework as eh,edu_classmaster AS cm,edu_subject AS su,edu_class AS c,edu_sections AS s,edu_enrollment AS ed WHERE ed.class_id=eh.class_id AND eh.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND eh.subject_id=su.subject_id And eh.hw_id='$hw_id'";
		  $result=$this->db->query($query);
          return $result->result();
		  

	  }
	  
	  function enter_marks($enroll,$hwid,$marks,$remarks)
	  {
		   $count_name = count($marks);
		  //echo $count_name; exit;
           for($i=0;$i<$count_name;$i++)
		   {
			$enroll1=$enroll[$i];
			//print_r($enroll);
			$hwid1=$hwid;
			$marks1=$marks[$i];
			$remarks1=$remarks[$i];
		  $query="INSERT INTO edu_class_marks(enroll_mas_id,hw_mas_id,marks,remarks,status,created_at) VALUES ('$enroll1','$hwid1','$marks1','$remarks1','A',NOW())";
		  $result=$this->db->query($query);
		  
		  $sql="UPDATE edu_homework SET mark_status='1' WHERE hw_id='$hwid1'";
		  $result1=$this->db->query($sql);
		  
          //return $result->result();
		  }
		  $data= array("status"=>"success");
		  return $data;
		   
	  }
	  
	  function edit_details($hw_id)
	  {
		 $query="SELECT eh.*,em.*,te.*,en.* FROM edu_homework AS eh,edu_class_marks AS em,edu_teachers AS te,edu_enrollment AS en WHERE eh.hw_id='$hw_id' AND em.hw_mas_id='$hw_id' AND eh.teacher_id=te.teacher_id AND en.enroll_id=em.enroll_mas_id";
		 $result=$this->db->query($query); 
         return $result->result();		 
	  }
	 
	  function update_marks($enroll,$hwid,$marks,$remarks)
	  {
		  
		  $count_name = count($marks);
				//echo $count_name; exit;
           for($i=0;$i<$count_name;$i++)
		   {
			$enroll1=$enroll[$i];
			//print_r($enroll);
			$hwid1=$hwid;
			$marks1=$marks[$i];
			$remarks1=$remarks[$i];
		  $query="UPDATE edu_class_marks SET enroll_mas_id='$enroll1',hw_mas_id='$hwid1',marks='$marks1',remarks='$remarks1',updated_at=NOW() WHERE hw_mas_id='$hwid1' AND enroll_mas_id='$enroll1'";
		  $result=$this->db->query($query);
		  
          //return $result->result();
		  }
		  $data= array("status"=>"success");
		  return $data;
		  

	  }
	  function edit_test_details($hw_id)
	  {
		  $query="SELECT eh.*,su.* FROM edu_homework AS eh,edu_subject AS su WHERE hw_id='$hw_id' AND eh.subject_id=su.subject_id";
		 $result=$this->db->query($query); 
         return $result->result();	
	  }
	  
	   function update_test_details($id,$hw_type,$title,$formatted_date,$format_date,$test_details,$status)
	   {
		   $query1="UPDATE edu_homework SET hw_type='$hw_type',title='$title',test_date='$formatted_date',due_date='$format_date',hw_details='$test_details',status='$status' WHERE hw_id='$id'";
		   $result1=$this->db->query($query1); 
           $data= array("status"=>"success");
		   return $data;
	   }


	  
	  function get_acdaemicyear()
		{
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  /* if($result1->num_rows()==0){
			$data= array("status" => "no data Found");
			return $data;
		  }else{ */
			$all_year= $result1->result();
			//$data= array("status" => "success","all_years"=>$all_year);
			return $all_year;
			//print_r($all_year);
		  

		}

}
?>

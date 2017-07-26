<?php

Class Circularmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct(); 

  }

    function get_teachers()
	 {
		 $query="SELECT u.user_id,u.name,u.user_type,u.user_master_id,u.status,t.teacher_id,t.name FROM edu_users AS u,edu_teachers AS t WHERE user_type=2 AND u.user_master_id=t.teacher_id AND u.status='Active'";
         $resultset=$this->db->query($query);
         return $resultset->result();
	 }
	 
	 function getall_parents()
	 {
		$query="SELECT * FROM edu_parents";
        $resultset=$this->db->query($query);
        return $resultset->result(); 
	 }
	 function get_classes()
	 {
		 $query="SELECT * FROM  edu_class";
         $resultset=$this->db->query($query);
         return $resultset->result();
	 }

	 function get_stu_name($classid)
	 {
		 $sql="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,e.quota_id,e.status,u.user_id,u.name,u.user_type,u.user_master_id FROM edu_enrollment AS e,edu_users AS u WHERE e.class_id='$classid' AND e.admission_id=u.user_master_id AND user_type=3 AND e.status='Active'";
		 $resultset1=$this->db->query($sql);
        // $rows=$resultset1->result();
		 if($resultset1->num_rows()==0){
           $data= array("status" => "nodata");
           return $data;
         }else{
             $res=$resultset1->result();
             $data=array("status"=>"success","res"=>$res);
             return $data;
		 }
	 }
	 
	 function get_parent_name($studentid)
	 {
		 $sql="SELECT parent_id,admission_id,father_name,mother_name,guardn_name,status FROM edu_parents WHERE FIND_IN_SET('$studentid',admission_id)";
		 $resultset2=$this->db->query($sql);
		 if($resultset2->num_rows()==0){
           $data= array("status" =>"nodata");
           return $data;
         }else{
             $res=$resultset2->result();
             $data=array("status"=>"success","res1"=>$res);
               return $data;
		 }
	 }
	 
	 function getall_roles()
	 {
		 $sql1="SELECT * FROM edu_role";
		 $resultset3=$this->db->query($sql1);
		 $res2=$resultset3->result();
		 return $res2;

	 }
	 
	 function cmaster_type()
	 {
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;
		  
	     $query2="SELECT * FROM edu_circular_master WHERE academic_year_id='$current_year' AND status='Active' GROUP BY circular_type ";
         $res=$this->db->query($query2);
         $result3=$res->result();
		 return $result3;
	 }
	 
	  function get_circular_title_lists($ctype)
	 {
		 $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;
		  
		 $query2="SELECT id,academic_year_id,circular_title,circular_type,circular_description,status FROM edu_circular_master WHERE circular_type='$ctype' AND academic_year_id='$current_year' AND status='Active'";
         $resultset1=$this->db->query($query2);
         if($resultset1->num_rows()==0){
           $data= array("status" =>"nodata");
           return $data;
         }else{
             $res=$resultset1->result();
             $data=array("status"=>"success","res1"=>$res);
               return $data;
		 }
	 } 
	 
	 function get_circular_description_lists($ctitle,$ctype)
	 {//   echo $ctitle;exit;
		 $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;
		  
		  $query5="SELECT id,academic_year_id,circular_title,circular_type,circular_description,status FROM edu_circular_master WHERE circular_title='$ctitle' AND academic_year_id='$current_year' AND circular_type='$ctype' AND status='Active'";
         $resultset3=$this->db->query($query5);
         if($resultset3->num_rows()==0){
           $data= array("status" =>"nodata");
           return $data;
         }else{
             $res3=$resultset3->result();
             $data=array("status1"=>"success","res2"=>$res3);
               return $data;
		 }
	 }
	 
	 function circular_create($title,$notes,$circulardate,$users_id,$tusers_id,$pusers_id,$stusers_id,$citrcular_type,$status,$user_id)
	 {
		   $master="SELECT id,circular_title,circular_type,circular_description,status FROM edu_circular_master WHERE circular_title='$title' AND circular_type='$citrcular_type' AND circular_description='$notes' AND status='Active'"; 
		   $resultset=$this->db->query($master);
		   $res=$resultset->result();
		   foreach($res as $rows){}
		   $cm=$rows->id;
		 
		  //-----------------------------Students----------------------
		 // print_r($stusers_id);
		  if($stusers_id!='')
		  {
			 $scountid=count($stusers_id);
			//echo $scountid; 
			
			 for ($i=0;$i<$scountid;$i++) 
			 {
				$classid=$stusers_id[$i];
				//echo $classid; 
				
				$cirmat=$cm;
				$status1=$status;
				$circulardate1=$circulardate;
				$user_id1=$user_id;
			
			    $stud="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.parnt_guardn_id,u.user_id,u.user_type,u.user_master_id,u.name,u.student_id, u.status FROM edu_enrollment AS e,edu_admission AS a,edu_users AS u WHERE e.class_id='$classid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no AND u.user_type=3 AND a.admission_id=u.user_master_id AND a.admission_id=u.student_id AND u.status='Active'";
				$stu_id=$this->db->query($stud);
				$res1=$stu_id->result();
			    foreach($res1 as $row1)
				{
				  $sid=$row1->user_id;
				 // echo $sid; 
				  $query1="INSERT INTO edu_circular(user_type,user_id,	circular_master_id,circular_date,status,created_by,created_at) VALUES ('3','$sid','$cirmat','$circulardate1','$status1','$user_id1',NOW())";
		          $students=$this->db->query($query1);
				 }
			
		    }
			if($students){
				  $data = array("status" => "success");
				return $data; }else{$data = array("status" => "Failed");
				return $data;} 
			  
		  }
		 
		  //-----------------------------Parents----------------------
		  //print_r($pusers_id);exit;
		  if($pusers_id!='')
		  {
			$pcountid=count($pusers_id);
			
			 for ($i=0;$i<$pcountid;$i++) 
			 {
				$classid=$pusers_id[$i];
				
				$cirmat=$cm;
				$status1=$status;
				$circulardate1=$circulardate;
				$user_id1=$user_id;
			
				$class="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.parnt_guardn_id,u.user_id,u.user_type,u.user_master_id,u.parent_id,u.status FROM edu_enrollment AS e,edu_admission AS a,edu_users AS u WHERE e.class_id='$classid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no AND u.user_type=4 AND a.parnt_guardn_id=u.user_master_id AND a.parnt_guardn_id=u.parent_id AND u.status='Active' GROUP  BY u.user_id";
				$stu_cls=$this->db->query($class);
				$res=$stu_cls->result();
			    foreach($res as $row)
				{
				  $pid=$row->user_id;
				  $query2="INSERT INTO edu_circular(user_type,user_id,circular_master_id,circular_date,status,created_by,created_at) VALUES ('4','$pid','$cirmat','$circulardate1','$status1','$user_id1',NOW())";
		          $parents=$this->db->query($query2);
				 }
			
		    }
			if ($parents){
				  $data = array("status" => "success");
				return $data; }else{$data = array("status" => "Failed");
				return $data;}
		  }
           //-----------------------------Teacher----------------------
		   //print_r($tusers_id);exit;
			if($tusers_id!='')
			{
			 $countid=count($tusers_id);
			 //echo $countid; exit;
			 for ($i=0;$i<$countid;$i++) {
				$userid=$tusers_id[$i];
				
				$cirmat=$cm;
				$status1=$status;
				$circulardate1=$circulardate;
				$user_id1=$user_id;
			    $query3="INSERT INTO edu_circular(user_type,user_id,circular_master_id,circular_date,status,created_by,created_at) VALUES ('2','$userid','$cirmat','$circulardate1','$status1','$user_id1',NOW())";
		        $teacher=$this->db->query($query3);
			 }
			 if($teacher){
				 $data=array("status" =>"success");
				return $data;}else{$data = array("status" => "Failed");
				return $data;}
			}
			//------------------------------Admin-----------------------
			if($users_id!=''){
			//echo $users_id;
			
			$sql1="SELECT * FROM edu_users WHERE user_type='$users_id' AND status='Active'";
			$res=$this->db->query($sql1);
			$result1=$res->result();
			foreach($result1 as $rows){
			$userid=$rows->user_id; 
			$cirmat=$cm;
			$status1=$status;
            $circulardate1=$circulardate;
            $users_id1=$users_id;
			$user_id1=$user_id;
			$query4="INSERT INTO edu_circular(user_type,user_id,circular_master_id,circular_date,status,created_by,created_at) VALUES ('$users_id1','$userid','$cirmat','$circulardate1','$status1','$user_id1',NOW())";
			$resultset=$this->db->query($query4);
			 }	 
		  if($resultset){
			  $data = array("status" => "success");
              return $data;}else{$data = array("status" => "Failed");
			  return $data;}
		}
    	
	 }

	 function get_all_circular()
	 {
		 $query="SELECT c.id,c.user_type,c.user_id,c.circular_master_id,c.circular_date,cm.*,u.user_id,u.name FROM edu_circular AS c,edu_users AS u,edu_circular_master AS cm WHERE cm.	id=c.circular_master_id AND c.user_id=u.user_id AND cm.status='Active'";
         $res=$this->db->query($query);
         $result1=$res->result();
		 return $result1;
		 //return $result1[0]->teaher_id;
	 }
	 
	 function get_parents_circular()
	 {
		 //$query="SELECT c.id,c.user_type,c.user_id,c.circular_master_id,c.	circular_date,cm.*,u.user_id,u.user_type,u.user_master_id,u.name FROM edu_circular AS c,edu_users AS u,edu_circular_master AS cm WHERE c.user_type=4 AND u.user_type=c.user_type AND cm.id=c.circular_master_id AND c.user_id=u.user_id AND cm.status='Active'";
		 $query="SELECT c.id,c.user_type,c.user_id,c.circular_master_id,c.	circular_date,cm.*,u.user_id,u.user_type,u.user_master_id,u.parent_id,a.admission_id,a.parnt_guardn_id,a.admisn_no,e.admission_id,e.admisn_no,e.class_id FROM edu_circular AS c,edu_users AS u,edu_admission AS a,edu_enrollment AS e,edu_circular_master AS cm WHERE c.user_type=4 AND u.user_type=c.user_type AND cm.id=c.circular_master_id AND c.user_id=u.user_id AND u.user_master_id=a.parnt_guardn_id AND u.parent_id=a.parnt_guardn_id AND a.admission_id=e.admission_id AND a.admisn_no=e.admisn_no AND cm.status='Active' GROUP BY e.class_id,cm.circular_title";
         $res=$this->db->query($query);
         $result1=$res->result();
		 return $result1;
		
	 }
	 
	 function get_students_circular()
	 {
		 $query="SELECT c.id,c.user_type,c.user_id,c.circular_master_id,c.	circular_date,cm.*,u.user_id,u.user_type,u.user_master_id,u.student_id,a.admission_id,a.admisn_no,e.admission_id,e.admisn_no,e.class_id FROM edu_circular AS c,edu_users AS u,edu_admission AS a,edu_enrollment AS e,edu_circular_master AS cm WHERE c.user_type=3 AND u.user_type=c.user_type AND cm.id=c.circular_master_id AND c.user_id=u.user_id AND u.user_master_id=a.admission_id AND u.student_id=a.admission_id AND a.admission_id=e.admission_id AND a.admisn_no=e.admisn_no AND cm.status='Active'";
         $res=$this->db->query($query);
         $result1=$res->result();
		 return $result1; 
	 } 
	 
	 function get_current_years()
		{
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  if($result1->num_rows()==0){
			$data= array("status" => "no data Found");
			return $data;
		  }else{
			$all_year= $result1->result();
			$data= array("status" => "success","all_years"=>$all_year);
			return $data;
			//print_r($all_year);
		  }

		}
		
    function get_all_result()
	{
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;
		  
	     $query2="SELECT * FROM edu_circular_master WHERE academic_year_id='$current_year'";
         $res=$this->db->query($query2);
         $result3=$res->result();
		 return $result3;
	}
	
	function edit_all_result($id)
	{
		$query2="SELECT * FROM edu_circular_master WHERE id='$id'";
         $res=$this->db->query($query2);
         $result3=$res->result();
		 return $result3;
	}
	
	function create_circular_masters($year_id,$ctype,$ctile,$cdescription,$status,$user_id)
	{
		$sql1="INSERT INTO edu_circular_master(academic_year_id,circular_title,circular_type,circular_description,status, created_by,created_at) VALUES ('$year_id','$ctile','$ctype','$cdescription','$status','$user_id',NOW())";
		$resultset=$this->db->query($sql1);
		  if($resultset){
			  $data = array("status" => "success");
              return $data;}else{$data = array("status" => "Failed");
			  return $data;}
	}
     
	function update_circular_masters($cid,$year_id,$ctype,$ctile,$cdescription,$status,$user_id)
	{
		$sql2="UPDATE edu_circular_master SET circular_title='$ctile',circular_type='$ctype',circular_description='$cdescription',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$cid'";
		$resultset1=$this->db->query($sql2);
		if($resultset1){
		 $data = array("status" => "success");
           return $data;}else{$data = array("status" => "Failed");
		return $data;}
	}
   

}
?>

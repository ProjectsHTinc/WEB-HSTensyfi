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
		 $sql="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,e.quota_id,e.status,u.user_id,u.name,u.user_type,u.user_master_id FROM edu_enrollment AS e,edu_users AS u WHERE e.class_id='$classid' AND e.admission_id=u.user_master_id AND user_type=3 AND  e.status='Active'";
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
	 function circular_create($title,$notes,$circulardate,$users_id,$tusers_id,$pusers_id,$stusers_id,$citrcular_type,$status,$user_id)
	 {
		  //-----------------------------Students----------------------
		  print_r($stusers_id);
		  if($stusers_id!='')
		  {
			 $scountid=count($stusers_id);
			echo $scountid; 
			 for ($i=0;$i<$scountid;$i++) 
			 {
				$classid=$stusers_id[$i];
				//echo $classid; 
				$title1=$title;
				$notes1=$notes;
				$ctype=$citrcular_type;
				$status1=$status;
				$circulardate1=$circulardate;
				$user_id1=$user_id;
			
			$stud="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.parnt_guardn_id,u.user_id,u.user_type,u.user_master_id,u.name,u.student_id, u.status FROM edu_enrollment AS e,edu_admission AS a,edu_users AS u WHERE e.class_id='$classid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no AND u.user_type=3 AND a.admission_id=u.user_master_id AND a.admission_id=u.student_id AND u.status='Active'";
				$stu_id=$this->db->query($stud);
				$res1=$stu_id->result();
			    foreach($res1 as $row1)
				{
				  $sid=$row1->user_id;
				  echo $sid; 
				  $query1="INSERT INTO edu_circular(user_type,user_id,title,notes,date,circular_type,status,created_by,created_at) VALUES ('3','$sid','$title1','$notes1','$circulardate1','$ctype','$status1','$user_id1',NOW())";
		          $students=$this->db->query($query1);
				 }
			
		    }
			if ($students){
				  $data = array("status" => "success");
				return $data; } 
			  
		  }
		 
		  //-----------------------------Parents----------------------
		  //print_r($pusers_id);exit;
		  if($pusers_id!='')
		  {
			$pcountid=count($pusers_id);
			 for ($i=0;$i<$pcountid;$i++) 
			 {
				$classid=$pusers_id[$i];
				$title1=$title;
				$notes1=$notes;
				$ctype=$citrcular_type;
				$status1=$status;
				$circulardate1=$circulardate;
				$user_id1=$user_id;
			
				$class="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.parnt_guardn_id,u.user_id,u.user_type,u.user_master_id,u.parent_id,u.status FROM edu_enrollment AS e,edu_admission AS a,edu_users AS u WHERE e.class_id='$classid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no AND u.user_type=4 AND a.parnt_guardn_id=u.user_master_id AND a.parnt_guardn_id=u.parent_id AND  u.status='Active' GROUP  BY u.user_id";
				$stu_cls=$this->db->query($class);
				$res=$stu_cls->result();
			    foreach($res as $row)
				{
				  $pid=$row->user_id;
				  $query="INSERT INTO edu_circular(user_type,user_id,title,notes,date,circular_type,status,created_by,created_at) VALUES ('4','$pid','$title1','$notes1','$circulardate1','$ctype','$status1','$user_id1',NOW())";
		          $parents=$this->db->query($query);
				 }
			
		    }
			if ($parents){
				  $data = array("status" => "success");
				return $data; }
		  }
           //-----------------------------Teacher----------------------
			if($tusers_id!='')
			{
			 $countid=count($tusers_id);
			//echo $countid; echo "HI"; exit;
			 for ($i=0;$i<$countid;$i++) {
				$userid=$tusers_id[$i];
				$title1=$title;
				$notes1=$notes;
				$ctype=$citrcular_type;
				$status1=$status;
				$circulardate1=$circulardate;
				$user_id1=$user_id;
				
				$query="INSERT INTO edu_circular(user_type,user_id,title,notes,date,circular_type,status,created_by,created_at) VALUES ('2','$userid','$title1','$notes1','$circulardate1','$ctype','$status1','$user_id1',NOW())";
		        $teacher=$this->db->query($query);
			 }
			 if ($teacher){
				  $data = array("status" => "success");
				return $data; }
			}
			//------------------------------Admin-----------------------
			if($users_id!=''){
				//echo $users_id;exit;
			$sql1="SELECT * FROM edu_users WHERE user_type='$users_id' AND status='Active'";
			$res=$this->db->query($sql1);
			$result1=$res->result();
			foreach($result1 as $rows){
			$userid=$rows->user_id; 
			$title1=$title;
            $notes1=$notes;
			$ctype=$citrcular_type;
			$status1=$status;
            $circulardate1=$circulardate;
            $users_id1=$users_id;
			$user_id1=$user_id;
		 $query="INSERT INTO edu_circular(user_type,user_id,title,notes,date,circular_type,status,created_by,created_at) VALUES ('$users_id1','$userid','$title1','$notes1','$circulardate1','$ctype','$status1','$user_id1',NOW())";
		 $resultset=$this->db->query($query);
		 }		 
		  if ($resultset){
			  $data = array("status" => "success");
            return $data;}
			}
    	
	 }

	 function get_all_circular()
	 {
		 $query="SELECT c.*,u.user_id,u.name FROM edu_circular AS c,edu_users AS u WHERE c.user_id=u.user_id ";
         $res=$this->db->query($query);
         $result1=$res->result();
		 return $result1;
		 //return $result1[0]->teaher_id;
	 }
	 
	 function get_parents_circular()
	 {
		 $query="SELECT c.*,u.user_id,u.user_type,u.user_master_id,u.parent_id,a.admission_id,a.parnt_guardn_id,a.admisn_no,e.admission_id,e.admisn_no,e.class_id FROM edu_circular AS c,edu_users AS u,edu_admission AS a,edu_enrollment AS e WHERE c.user_type=4 AND u.user_type=c.user_type AND c.user_id=u.user_id AND u.user_master_id=a.parnt_guardn_id AND u.parent_id=a.parnt_guardn_id AND a.admission_id=e.admission_id AND a.admisn_no=e.admisn_no GROUP BY e.class_id ";
         $res=$this->db->query($query);
         $result1=$res->result();
		 return $result1;
		
	 }
	 
	 function get_students_circular()
	 {
		$query="SELECT c.*,u.user_id,u.user_type,u.user_master_id,u.student_id,a.admission_id,a.admisn_no,e.admission_id,e.admisn_no,e.class_id FROM edu_circular AS c,edu_users AS u,edu_admission AS a,edu_enrollment AS e WHERE c.user_type=3 AND u.user_type=c.user_type AND c.user_id=u.user_id AND u.user_master_id=a.admission_id AND u.student_id=a.admission_id AND a.admission_id=e.admission_id AND a.admisn_no=e.admisn_no GROUP BY e.class_id";
         $res=$this->db->query($query);
         $result1=$res->result();
		 return $result1; 
	 }

	

   
	   function get_all_leave($leave_id)
	   {
		 $que="SELECT ul.*,lm.id,lm.leave_title,lm.leave_type FROM edu_user_leave AS ul,edu_user_leave_master AS lm WHERE ul.type_leave=lm.leave_type AND ul.leave_id='$leave_id'";
		 $resultset1=$this->db->query($que);
		 $row=$resultset1->result();
		 return $row;
	   }
	 
	   function update_leave($leave_id,$status)
	   {
         $query4="UPDATE edu_user_leave SET status='$status',updated_at=NOW() WHERE leave_id='$leave_id'"; 
         $result1=$this->db->query($query4);
		 if($result1){
				 $data= array("status" => "success");
				 return $data;
			   }else{
				 $data= array("status" => "Failed to Update");
				 return $data;
			   }

	   }
	   
	   function get_all_teachers_list()
	   {
		 $que="SELECT * FROM edu_teachers";
		 $resultset=$this->db->query($que);
		 $row=$resultset->result();
		 return $row; 
	   }
	   
	   function get_all_class_list($leave_id)
	   {
		   $sql="SELECT leave_id,user_id,from_leave_date,to_leave_date FROM edu_user_leave WHERE leave_id='$leave_id'";
		   $resultset=$this->db->query($sql);
		   $row=$resultset->result();
		   foreach($row as $res){}
		   $tid=$res->user_id;
		   $ldate=$res->from_leave_date;
		   $tdate=$res->to_leave_date;
		   $lid=$res->leave_id;
		   //return $tid;
		   //echo $tid;
		   //exit;
		   $query="SELECT teacher_id,name,class_teacher,class_name FROM edu_teachers WHERE teacher_id='$tid'";
		   $resultset1=$this->db->query($query);
		   $row1=$resultset1->result();
		   foreach($row1 as $teacher_rows){}
		   //return $row1;
		   
		 $teach_id=$teacher_rows->class_name;
        $sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id AND cm.status='Active' ORDER BY c.class_name";
        $objRs=$this->db->query($sQuery);
        $row=$objRs->result();
        foreach ($row as $rows1) {
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

        $data= array("class_id" => $class_id,"class_name"=>$class_name,"sec_name"=>$sec_n,"teacher_id"=>$tid,"from_leave_date"=>$ldate,"to_leave_date"=>$tdate,"leave_id"=>$lid,"status"=>"success");
        return $data;
      }

	   }
	   
	   function get_all_view_list($leave_id)
	   {
		   $sql="SELECT leave_id,user_id,from_leave_date,to_leave_date FROM edu_user_leave WHERE leave_id='$leave_id'";
		   $resultset=$this->db->query($sql);
		   $row=$resultset->result();
		   foreach($row as $res){}
		   $tid=$res->user_id;
		   
		   $query="SELECT s.*,t.teacher_id,t.name FROM edu_substitution AS s,edu_teachers AS t WHERE s.teacher_id='$tid' AND t.teacher_id=s.sub_teacher_id";
		   $result=$this->db->query($query);
		   $row=$result->result();
		   return $row;
	   }
	   
	   function add_substitution_list($user_id,$cls_id,$teacher_id,$leave_date,$sub_teacher,$period_id,$leave_id,$status)
	   {
		  $quy="SELECT teacher_id,sub_date,class_master_id,period_id FROM edu_substitution WHERE teacher_id='$teacher_id' AND sub_date='$leave_date' AND class_master_id='$cls_id' AND period_id='$period_id' ";
		  $res1=$this->db->query($quy);
		  if($res1->num_rows()==0)
	       {
		  $sql="INSERT INTO edu_substitution(teacher_id,sub_teacher_id,sub_date,class_master_id,period_id,status,created_by,created_at) VALUES ('$teacher_id','$sub_teacher','$leave_date','$cls_id','$period_id','$status','$user_id',NOW())";
		   $resultset=$this->db->query($sql);
		   if($resultset){
				 $data= array("status"=>"success");
				 return $data;
			   }
		   }else{
			   $data= array("status"=>"Already_Exist");
               return $data;
		   }
	   }
	   
	   
	   function get_all_class_list1($teacher_id)
	   {
		   
		   $query="SELECT teacher_id,name,class_teacher,class_name FROM edu_teachers WHERE teacher_id='$teacher_id'";
		   $resultset1=$this->db->query($query);
		   $row1=$resultset1->result();
		   foreach($row1 as $teacher_rows){}
		   //return $row1;
			$teach_id=$teacher_rows->class_name;
	        $sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
	        $objRs=$this->db->query($sQuery);
	        $row=$objRs->result();
	        foreach ($row as $rows1) {
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

        $data= array("class_id" => $class_id,"class_name"=>$class_name,"sec_name"=>$sec_n,"status"=>"success");
        return $data;
      }

	   }
	   
	    function edit_substitution_list($id)
	     {
		   $sql="SELECT * FROM edu_substitution WHERE id='$id'";
		   $result=$this->db->query($sql);
		   $row=$result->result();
		   return $row;
	     }
	  
		function update_substitution_list($user_id,$cls_id,$teacher_id,$leave_date,$sub_teacher,$period_id,$id,$status)
		 {
			$sql="UPDATE edu_substitution SET teacher_id='$teacher_id',sub_teacher_id='$sub_teacher',sub_date='$leave_date',class_master_id='$cls_id',period_id='$period_id',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
			$result=$this->db->query($sql);
		    //$row=$result->result();
		    if($result){
			$datas= array("status" => "success");
			return $datas;
			}else{
			$datas= array("status" => "Failed to Update");
			return $datas;
			} 
	     }
	   


}
?>

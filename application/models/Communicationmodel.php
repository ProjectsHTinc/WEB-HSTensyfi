<?php

Class Communicationmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct(); 

  }

    function get_teachers()
	 {
		 $query="SELECT * FROM edu_teachers WHERE status='Active'";
         $resultset=$this->db->query($query);
         return $resultset->result();
	 }
	 
	 function getall_parents()
	 {
		$query="SELECT * FROM edu_teachers";
        $resultset=$this->db->query($query);
        return $resultset->result(); 
	 }
	 

	 function get_classes()
	 {
		 $query="SELECT * FROM  edu_class";
         $resultset=$this->db->query($query);
         return $resultset->result();
	 }

	 function communication_create($title,$notes,$formatted_date,$teacher,$class_name)
	 {

		 $query="INSERT INTO edu_communication(commu_title,commu_details,commu_date,teacher_id,class_id,status,created_at,updated_at) VALUES ('$title','$notes','$formatted_date','$teacher','$class_name','A',NOW(),NOW())";
		 $resultset=$this->db->query($query);
		 $data= array("status" => "success");
         return $data;
	 }

	 function view()
	 {
		 $query="SELECT * FROM edu_communication ORDER BY commu_id DESC";
         $res=$this->db->query($query);
         $result1=$res->result();
		 return $result1;
		 //return $result1[0]->teaher_id;
	 }

	
   function edit_data($commu_id)
   {
	         $query1="SELECT * FROM edu_communication WHERE commu_id='$commu_id'";
             $res=$this->db->query($query1);
             return $res->result();
   }

	 function communication_update($id,$title,$notes,$date,$teacher,$class_name)
	 {
	  $query="UPDATE edu_communication SET commu_title='$title',commu_details='$notes',commu_date='$date',teacher_id='$teacher',class_id='$class_name' WHERE commu_id='$id'";
	 $res=$this->db->query($query);
	 if($res){
				 $data= array("status" => "success");
				 return $data;
			   }else{
				 $data= array("status" => "Failed to Update");
				 return $data;
			   }
	 }
      
	   function user_leaves()
	   {
		   $query="SELECT ul.*,t.teacher_id,t.name FROM edu_user_leave AS ul,edu_teachers AS t WHERE t.teacher_id=ul.user_id ORDER BY ul.leave_id desc";
		   $resultset=$this->db->query($query);
           $result= $resultset->result();
		   return $result;
		   
	   }

	  
	   function edit_leave($leave_id)
	   {
		 $que="SELECT * FROM edu_user_leave WHERE leave_id='$leave_id'";
		 $resultset1=$this->db->query($que);
		 $row=$resultset1->result();
		 return $row;
	 	 
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
		  // exit;
		  
		  $sql1="SELECT estc.id,estc.class_master_id,estc.subject_id,estc.teacher_id,estc.status,c.class_id,c.class_name,s.sec_id,s.sec_name,cm.class_sec_id,cm.class,cm.section FROM edu_teacher_handling_subject AS estc,edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE estc.teacher_id='$tid' AND estc.class_master_id=cm.class_sec_id AND cm.class = c.class_id AND cm.section = s.sec_id GROUP BY estc.class_master_id";
			$resultset3=$this->db->query($sql1);
			$res1=$resultset3->result();
			if(empty($res1))
			 {
			   $data=array("status" =>"Subject Not Found");
				return $data;
			 }else
			 {
			foreach($res1 as $rows1){
			 $class_id[]= $rows1->class_sec_id;$class_name[]=$rows1->class_name;$sec_n[]=$rows1->sec_name;}
			$data= array("class_id" => $class_id,"class_name"=>$class_name,"sec_name"=>$sec_n,"teacher_id"=>$tid,"from_leave_date"=>$ldate,"to_leave_date"=>$tdate,"leave_id"=>$lid,"status"=>"success");
		    return $data;
			//echo "<pre>"; print_r($data);			
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

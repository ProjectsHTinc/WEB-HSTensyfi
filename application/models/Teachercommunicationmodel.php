<?php
Class Teachercommunicationmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct();

  }

    function getall_details($user_id)
	 {
		 $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
		 $resultset=$this->db->query($query);
		 $row=$resultset->result();
		 foreach($row as $rows){}
		 $teacher_id=$rows->teacher_id;
		 
		 $query="SELECT * FROM edu_user_leave WHERE user_id='$teacher_id' ORDER BY leave_id desc";
		 $resultset1=$this->db->query($query);
		 $res1=$resultset1->result();
		 return $res1;
		 
	 }
	 
	 function getall_leaves()
	 {
		 $query="SELECT * FROM edu_user_leave_master WHERE status='Active'"; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
	 }
	 
	 function create_leave($user_type,$user_id,$leave_master_id,$leave_type,$formatted_date,$to_ldate,$frm_time,$to_time,$leave_description)
	 {       $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			 $resultset=$this->db->query($query);
			 $row=$resultset->result();
			 foreach($row as $rows){}
			 $teacher_id=$rows->teacher_id;
			 
		  $check_leave_date="SELECT * FROM edu_user_leave WHERE from_leave_date='$formatted_date' AND to_leave_date='$to_ldate' AND user_id='$teacher_id'";
          $result=$this->db->query($check_leave_date);
          if($result->num_rows()==0)
		  { 
			 $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			 $resultset=$this->db->query($query);
			 $row=$resultset->result();
			 foreach($row as $rows){}
			 $teacher_id=$rows->teacher_id;
			 $sql="INSERT INTO edu_user_leave(user_type,user_id,leave_master_id,type_leave,from_leave_date,to_leave_date,frm_time,to_time,leave_description,status,created_at)VALUES('$user_type','$teacher_id','$leave_master_id','$leave_type','$formatted_date','$to_ldate','$frm_time','$to_time','$leave_description','Pending',NOW())";
			 $resultset=$this->db->query($sql);
			
			 $data= array("status"=>"success");
			 return $data;
		 }else{
			  $data= array("status" => "Leave Date Already Exist");
              return $data;
		  } 
	 }
	 function edit_leave($user_id,$leave_id)
	 {
		 $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
		 $resultset=$this->db->query($query);
		 $row=$resultset->result();
		 foreach($row as $rows){}
		 $teacher_id=$rows->teacher_id; 
		 
		 $que="SELECT * FROM edu_user_leave WHERE user_id='$teacher_id' AND leave_id='$leave_id'";
		 $resultset1=$this->db->query($que);
		 $row=$resultset1->result();
		 return $row;
		 
	 }
	 
	 function update_leave($leave_id,$user_type,$user_id,$leave_type,$formatted_date,$frm_time,$to_time,$leave_description)
	 {
		 $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
		 $resultset=$this->db->query($query);
		 $row=$resultset->result();
		 foreach($row as $rows){}
		 $teacher_id=$rows->teacher_id;

        $query1="UPDATE edu_user_leave SET type_leave='$leave_type',from_leave_date='$formatted_date',frm_time='$frm_time',to_time='$to_time',leave_description='$leave_description',updated_at=NOW() WHERE leave_id='$leave_id' AND user_id='$teacher_id'";
        $resultset=$this->db->query($query1);
		//$row=$resultset->result();
		$data= array("status"=>"success");
		return $data;		
		 
	 }
	 
	 function getall_circular_details($user_id)
	 {
		 $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
		 $resultset=$this->db->query($query);
		 $row=$resultset->result();
		 foreach($row as $rows){}
		 $teacher_id=$rows->teacher_id;
		 
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;
		  

		 $com="SELECT user_type,user_id,title,notes,circular_date,circular_type,status FROM edu_circular WHERE user_id='$user_id' AND user_type=2 AND '$current_year' AND status='Active'";
		 //$sql="SELECT * FROM edu_communication WHERE status='A' AND FIND_IN_SET('$teacher_id',teacher_id) ";
		 $resultset=$this->db->query($com);
		 $row=$resultset->result();
		 return $row;
	 } 
	 
	 
	 
	 
	 
	 
}
?>
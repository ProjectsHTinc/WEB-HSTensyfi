<?php

Class Teacherondutymodel extends CI_Model
{

    public function __construct()
     {
        parent::__construct();
     }
  
    function getall_details($user_id,$user_type)
	 {
		   $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			 foreach($row as $rows){}
			 $teacher_id=$rows->teacher_id;
			 
		 $query="SELECT * FROM edu_on_duty WHERE user_id='$user_id' AND user_type='$user_type'";
         $resultset1=$this->db->query($query);
         return $resultset1->result();
	 }
	 
	 function apply_onduty($user_type,$user_id,$reason,$fdate,$tdate,$notes)
	 {
		  $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
		  $resultset=$this->db->query($query);
		  $row=$resultset->result();
		  foreach($row as $rows){}
		  $teacher_id=$rows->teacher_id;
			 
		 $sql="INSERT INTO edu_on_duty(user_type,user_id,od_for,from_date,to_date,notes,status,created_by,created_at)VALUES('$user_type','$user_id','$reason','$fdate','$tdate','$notes','Pending','$user_id',NOW())";
         $result1=$this->db->query($sql);
         //$res=$result1->result();
		 if($resultset)
          {
			 $data= array("status" => "success");
			 return $data;
         }
		
	 }

    function edit_onduty_form($id)
    {
       $query="SELECT * FROM edu_on_duty WHERE id='$id'";
       $resultset=$this->db->query($query);
       return $resultset->result();

    }

    function update($duty_id,$user_type,$user_id,$reason,$fdate,$tdate,$notes)
    {

       $sql="UPDATE edu_on_duty SET od_for='$reason',from_date='$fdate',to_date='$tdate',notes='$notes',updated_by='$user_id',updated_at=NOW() WHERE id='$duty_id' AND user_type='$user_type'";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
    }

//-------------Special Class--------------------------------\
		   
   function special_class_details($user_id,$user_type)
   {
		$query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
	    $resultset=$this->db->query($query);
	    $row=$resultset->result();
	    foreach($row as $rows){}
	    $teacher_id=$rows->teacher_id;
		
		
		$sql1="SELECT sc.*,t.teacher_id,t.name,cm.class_sec_id,cm.class,cm.section,c.*,s.*,su.* FROM edu_special_class AS sc,edu_teachers AS t,edu_classmaster AS cm,edu_class AS c,edu_sections AS s,edu_subject AS su WHERE sc.teacher_id='$teacher_id' AND sc.teacher_id=t.teacher_id AND sc.class_master_id=cm.class_sec_id  AND cm.class=c.class_id AND cm.section=s.sec_id AND sc.subject_id=su.subject_id AND sc.status='Active' ";
		$result1=$this->db->query($sql1);
		$res=$result1->result();
		return $res;
   }	
}
	?>
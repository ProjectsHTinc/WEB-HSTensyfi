<?php

Class Ondutymodel extends CI_Model
{

    public function __construct()
     {
        parent::__construct();
     }
  
    function get_teacher_onduty_details()
     {
    	 $query="SELECT du.*,t.teacher_id,t.name FROM edu_on_duty AS du,edu_teachers AS t WHERE du.user_type=2 AND du.user_id=t.teacher_id"; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
     }

     

    function edit_teacher($id)
    {
       $query="SELECT du.*,t.teacher_id,t.name FROM edu_on_duty AS du,edu_teachers AS t WHERE du.user_type=2 AND du.id='$id' AND du.user_id=t.teacher_id"; 
       $res=$this->db->query($query);
       $result=$res->result();
       return $result;

    }

   function update_teacher_onduty($status,$user_id,$id)
    {

       $sql="UPDATE edu_on_duty SET status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
    }

//------------------------Student---------------------------------

	function get_student_onduty_details()
	{
		$query="SELECT du.*,en.enroll_id,en.admission_id,en.name,en.class_id,cm.class_sec_id,cm.class,cm.section,c.*,s.* FROM edu_on_duty AS du,edu_enrollment AS en,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE du.user_type=3 AND du.user_id=en.admission_id AND cm.class_sec_id=en.class_id AND cm.class=c.class_id AND cm.section=s.sec_id"; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
	}	
	
	function edit_student($id)
	{
		$query="SELECT du.*,en.enroll_id,en.admission_id,en.name,en.class_id,cm.class_sec_id,cm.class,cm.section,c.*,s.* FROM edu_on_duty AS du,edu_enrollment AS en,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE du.user_type=3 AND du.user_id=en.admission_id AND du.id='$id' AND cm.class_sec_id=en.class_id AND cm.class=c.class_id AND cm.section=s.sec_id"; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
	}
	
	function update_student_onduty($status,$user_id,$id)
	{
	   $sql="UPDATE edu_on_duty SET status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
	}
}
	?>
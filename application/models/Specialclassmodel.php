<?php

Class Specialclassmodel extends CI_Model
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
	 
	 function getall_details()
	 {
		 $query="SELECT sc.*,t.teacher_id,t.name,cm.class_sec_id,cm.class,cm.section,cm.subject,c.*,s.*,su.* FROM edu_special_class AS sc,edu_teachers AS t,edu_classmaster AS cm,edu_class AS c,edu_sections AS s,edu_subject AS su WHERE sc.teacher_id=t.teacher_id AND sc.class_master_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND sc.subject_id=su.subject_id";
         $resultset=$this->db->query($query);
         return $resultset->result();
	 }
		 

    function create_special_class($class_name,$teacher,$subject_name,$sub_topic,$spe_date,$stime,$etime,$status,$user_id)
     {
	   $check_name="SELECT * FROM edu_special_class WHERE class_master_id='$class_name' AND subject_id='$subject_name' AND special_class_date='$spe_date'";
	   $result=$this->db->query($check_name);
	   if($result->num_rows()==0){
	   $sql="INSERT INTO edu_special_class(class_master_id,teacher_id,subject_id,subject_topic,special_class_date,start_time,end_time,status,created_by,created_at)VALUES('$class_name','$teacher','$subject_name','$sub_topic','$spe_date','$stime','$etime','$status','$user_id',NOW())";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
	   }else{
		 $data= array("status" => "Already Exist");
         return $data;
	   }
       
    }

    function edit_special_class($id)
    {
       $query="SELECT sc.*,t.teacher_id,t.name,cm.class_sec_id,cm.class,cm.section,c.*,s.*,su.* FROM edu_special_class AS sc,edu_teachers AS t,edu_classmaster AS cm,edu_class AS c,edu_sections AS s,edu_subject AS su WHERE sc.teacher_id=t.teacher_id AND sc.class_master_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND sc.subject_id=su.subject_id AND sc.id='$id'";
       $resultset=$this->db->query($query);
       return $resultset->result();

    }

    function update($class_name,$teacher,$subject_name,$sub_topic,$spe_date,$stime,$etime,$status,$user_id,$specls_id)
    {
       $check_name="SELECT * FROM edu_special_class WHERE class_master_id='$class_name' AND subject_id='$subject_name' AND special_class_date='$spe_date'";
	   $result=$this->db->query($check_name);
	   if($result->num_rows()==0){
       $sql="UPDATE edu_special_class SET class_master_id='$class_name',teacher_id='$teacher',subject_id='$subject_name',subject_topic='$sub_topic',special_class_date='$spe_date',start_time='$stime',end_time='$etime',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$specls_id'";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
	 }else{
		 $data= array("status" => "Already Exist");
         return $data;
	   }
    }
}
	?>
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
		 if($fdate < $tdate || $fdate==$tdate){
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
		  
		 $sql="INSERT INTO edu_on_duty(user_type,user_id,year_id,od_for,from_date,to_date,notes,status,created_by,created_at)VALUES('$user_type','$user_id','$current_year','$reason','$fdate','$tdate','$notes','Pending','$user_id',NOW())";
         $result1=$this->db->query($sql);
         //$res=$result1->result();
		 if($resultset)
          {
			 $data= array("status" => "success");
			 return $data;
         }

		 }else{
			  $data= array("status" => "Date");
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


//---------------------------Student Onduty Details------------------------
	function  view_class_teacher($user_id,$user_type)
	{
		$query="SELECT teacher_id,user_type,user_master_id,user_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
	    $resultset=$this->db->query($query);
	    $row=$resultset->result();
	    foreach($row as $rows){}
	    $teacher_id=$rows->user_master_id;
		
		$sql="SELECT t.teacher_id,t.name,t.class_teacher,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,se.sec_id,se.sec_name FROM edu_teachers AS t,edu_classmaster AS cm, edu_class AS c,edu_sections AS se WHERE teacher_id='$teacher_id' AND t.class_teacher=cm.class_sec_id AND cm.class=c.class_id AND cm.section=se.sec_id ";
		$resultset1=$this->db->query($sql);
	    $res=$resultset1->result();
		//foreach($res as $rows1){} $cls_teacher=$rows1->class_teacher;
		return $res;
	}
  function view_student_ondy($cls_id,$user_id,$user_type)
  {
	   
		 $sql1="SELECT en.enroll_id,en.admission_id,en.admit_year,en.admisn_no,en.name,en.class_id,u.user_type,u.user_master_id,u.user_id,st.id,st.user_type,st.user_id,st.year_id,st.od_for,st.from_date,st.to_date,st.notes,st.status FROM edu_enrollment AS en,edu_users AS u,edu_on_duty AS st WHERE en.class_id='$cls_id' AND u.user_type='3' AND en.admission_id=u.user_master_id AND u.user_id=st.user_id AND st.user_type='3' ";
		$resultset2=$this->db->query($sql1);
	    $res1=$resultset2->result();
		return $res1;
  }
}
	?>
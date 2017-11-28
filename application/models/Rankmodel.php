<?php
   
Class Rankmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  

  function getYear()
    {
	   $sqlYear = "SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'Active'";
	   $year_result = $this->db->query($sqlYear);
	   $ress_year = $year_result->result();
	   if($year_result->num_rows()==1)
	   {
	     foreach ($year_result->result() as $rows)
	     {
	         $year_id = $rows->year_id;
	     }
	     return $year_id;
	   }
    }

  function get_exam_details_view()
  {  
  	 $year_id=$this->getYear();

  	$query= "SELECT ex.*,ed.exam_detail_id,ed.exam_id FROM edu_examination AS ex,edu_exam_details AS ed WHERE ex.status='Active' AND ex.exam_year='$year_id' AND ex.exam_id=ed.exam_id  GROUP By ed.exam_id";
	$cls=$this->db->query($query);
	$row=$cls->result();
	return $row;
  }

  function get_cls_details_view()
  {
  	$query= "SELECT * FROM  edu_class WHERE status='Active'";
	$cls=$this->db->query($query);
	$row=$cls->result();
	return $row;
  }

  function get_rank_details_view($cls_id,$examid)
  {
    $query= "SELECT cm.class_sec_id FROM edu_classmaster AS cm WHERE cm.class IN ($cls_id)";
	$cls=$this->db->query($query);
	$row=$cls->result();
	 foreach($row as $rows){ 
     $cm_id[]=$rows->class_sec_id; }

      $cid=implode(',', $cm_id);

      //SELECT em.classmaster_id,s.subject_name,em.internal_mark,em.external_mark,em.total_marks,en.name FROM edu_exam_marks AS em,edu_enrollment AS en,edu_subject AS s WHERE em.exam_id='1' AND em.classmaster_id IN(14,17,18,19) AND em.stu_id=en.enroll_id AND em.total_marks >= 30 AND em.subject_id=s.subject_id ORDER BY em.total_marks DESC

      // /SELECT sum(total_marks),total_marks,subject_id,classmaster_id,stu_id FROM edu_exam_marks WHERE classmaster_id IN(14,17,18,19) GROUP BY classmaster_id,stu_id

       $query= "SELECT em.internal_mark,em.external_mark,em.total_marks,en.name FROM edu_exam_marks AS em,edu_enrollment AS en WHERE em.exam_id='1' AND em.classmaster_id IN(14,17,18,19) AND em.stu_id=en.enroll_id AND em.total_marks >= 30 ORDER BY EM.total_marks DESC ";
	  $marks=$this->db->query($query);
	  $row1=$marks->result();
	
	return $row1;
  }

}
?>
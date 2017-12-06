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
  	$query= "SELECT cm.class_sec_id,em.classmaster_id,c.class_name,s.sec_name FROM  edu_exam_marks AS em,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE em.classmaster_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id GROUP By em.classmaster_id";
	$cls=$this->db->query($query);
	$row=$cls->result();
	return $row;
  }

  function get_rank_details_view($examid,$cls_id)
  {
   
        //$query= "SELECT cm.class_sec_id FROM edu_classmaster AS cm WHERE cm.class IN ($cls_id)";
	     //$cls=$this->db->query($query);
	    //$row=$cls->result();
	   //foreach($row as $rows){ 
    //$cm_id[]=$rows->class_sec_id; }
   //$cid=implode(',', $cm_id);

    //SELECT em.classmaster_id,s.subject_name,em.internal_mark,em.external_mark,em.total_marks,en.name FROM edu_exam_marks AS em,edu_enrollment AS en,edu_subject AS s WHERE em.exam_id='1' AND em.classmaster_id IN(14,17,18,19) AND em.stu_id=en.enroll_id AND em.total_marks >= 30 AND em.subject_id=s.subject_id ORDER BY em.total_marks DESC

   //SELECT sum(total_marks) as total,em.total_marks,em.subject_id,em.classmaster_id,em.stu_id,st.name,c.class_name,s.sec_name FROM edu_exam_marks AS em,edu_enrollment AS st, edu_class AS c,edu_sections AS s,edu_classmaster AS cm WHERE em.classmaster_id IN($cid) AND em.exam_id IN($examid) AND em.stu_id=st.enroll_id   AND FIND_IN_SET(em.classmaster_id,cm.class_sec_id) AND cm.class_sec_id IN($cid) AND FIND_IN_SET(cm.class,c.class_id) AND FIND_IN_SET(cm.section,s.sec_id)  GROUP BY em.classmaster_id,em.stu_id;

    $query= "SELECT sum(total_marks) as total,GROUP_CONCAT(if(em.total_marks >= 35,'Pass','Fail')) AS Subject_marks,st.name,c.class_name,s.sec_name FROM edu_exam_marks AS em LEFT JOIN edu_enrollment AS st ON  em.stu_id=st.enroll_id LEFT JOIN edu_classmaster AS cm ON em.classmaster_id=cm.class_sec_id LEFT JOIN  edu_class AS c ON  cm.class=c.class_id LEFT JOIN edu_sections AS s ON cm.section=s.sec_id  WHERE em.classmaster_id='$cls_id' AND em.exam_id IN($examid)  GROUP BY em.classmaster_id,em.stu_id ORDER BY sum(total_marks) DESC";

       //$query= "SELECT em.internal_mark,em.external_mark,em.total_marks,en.name FROM edu_exam_marks AS em,edu_enrollment AS en WHERE em.exam_id='1' AND em.classmaster_id IN($cid) AND em.stu_id=en.enroll_id AND em.total_marks >= 30 ORDER BY EM.total_marks DESC ";

	  $marks=$this->db->query($query);
	  $row1=$marks->result();
	  return $row1;
  }

}
?>
<?php

Class Adminparentmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

		 function get_stude_attendance($enroll_id)
		 {


			$query="SELECT abs_date AS start,CASE WHEN attend_period = 0 THEN 'MORNING' ELSE 'AFTERNOON' END AS title FROM edu_attendance_history WHERE student_id='$enroll_id'";
			$resultset1=$this->db->query($query);
			return $resultset1->result();
		 }


        function get_event_all()
		{
		   $query="SELECT * FROM edu_events ORDER BY event_date DESC";
		   $resultset1=$this->db->query($query);
		   return $resultset1->result();
        }

        function get_event_list_all($event_id)
		{
		   $query="SELECT ec.sub_event_name,ec.co_name_id,eu.name,ev.* FROM edu_events AS ev LEFT JOIN edu_event_coordinator AS ec ON ev.event_id=ec.event_id LEFT JOIN edu_users AS eu ON ec.co_name_id=eu.user_id WHERE ev.event_id='$event_id'";
		   $resultset1=$this->db->query($query);
		   return $resultset1->result();
        }

		function get_all_homework($enroll_id)
		{

			$query2="SELECT * FROM edu_enrollment WHERE enroll_id='$enroll_id' AND status='Active'";
			$result1=$this->db->query($query2);
			$row3=$result1->result();
			foreach($row3 as $row4){
			$admisn_no=$row4->admisn_no;
			$name=$row4->name;
			$class_id=$row4->class_id;
			}
			$query3="SELECT h.*,cm.class_sec_id,cm.class,cm.section,c.*,se.* FROM edu_homework AS h,edu_classmaster AS cm,edu_class AS c,edu_sections AS se WHERE h.class_id='$class_id' AND h.status='Active' AND h.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=se.sec_id ORDER BY h.hw_id DESC" ;
			$result2=$this->db->query($query3);
			$row4=$result2->result();
			return $row4;


		}

		function get_stu_id($enroll_id)
		{
			$query2="SELECT name,admisn_no,enroll_id,class_id FROM edu_enrollment WHERE enroll_id='$enroll_id' AND status='Active'";
			$result1=$this->db->query($query2);
			$row3=$result1->result();
			return $row3;
		}

		function view_homework_marks($hw_id,$enroll_id)
		{//echo $hw_id;echo $enroll_id;exit;

			$query="SELECT * FROM edu_class_marks WHERE hw_mas_id='$hw_id' AND enroll_mas_id='$enroll_id'";
		    $result=$this->db->query($query);
            $marks=$result->result();
			return $marks;
		}

		function view_exam_name($enroll_id)
		{
			$query2="SELECT * FROM edu_enrollment WHERE enroll_id='$enroll_id' AND status='Active'";
			$result1=$this->db->query($query2);
			$row3=$result1->result();
			foreach($row3 as $row4){
			$admisn_no=$row4->admisn_no;
			$name=$row4->name;
			$class_id=$row4->class_id;
			}

			 $sql="SELECT m.*,ed.exam_id,ed.exam_year,ed.exam_name FROM edu_exam_marks_status AS m,edu_examination AS ed WHERE m.classmaster_id='$class_id' AND  m.status='Publish' AND m.exam_id=ed.exam_id";
			  $resultset1=$this->db->query($sql);
			 $res=$resultset1->result();
             return $res;
		}

		function exam_marks($stu_id,$exam_id)
		{

			$sql1="SELECT * FROM edu_exam_marks WHERE exam_id='$exam_id' AND stu_id='$stu_id'";
			$resultset1=$this->db->query($sql1);
			$res1=$resultset1->result();
            return $res1;
		}


	  function get_all_classid($user_id)
	  {   //echo $user_id;
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  if($result1->num_rows()==0){ }else{
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;

		   $com="SELECT c.user_type,c.user_id,c.circular_master_id,c.circular_date,cm.id,cm.academic_year_id,cm.circular_title,cm.circular_type,cm.circular_description,cm.status FROM edu_circular AS c,edu_circular_master AS cm WHERE c.user_id='7' AND c.user_type=4 AND cm.academic_year_id='1' AND c.circular_master_id=cm.id AND cm.status='Active'";
		 $resultset=$this->db->query($com);
		 $row=$resultset->result();
		 return $row;
		   }
		   

	  }

	  function view_exam_calender($enroll_id)
	  {

			$sql1="SELECT * FROM edu_examination WHERE status='Active'";
			$resultset1=$this->db->query($sql1);
			$row1=$resultset1->result();
			return $row1;
	  }

     function view_exam_calender_details($exam_id,$cls_id)
	 {
		 $sql1="SELECT ed.*,en.exam_id,en.exam_year,en.exam_name,su.* FROM edu_exam_details AS ed,edu_examination AS en,edu_subject AS su WHERE ed.exam_id='$exam_id' AND ed.classmaster_id='$cls_id' AND ed.exam_id=en.exam_id AND ed.subject_id=su.subject_id ";
			$resultset1=$this->db->query($sql1);
			$row1=$resultset1->result();
			return $row1;

	 }

    // GET TOTAL WORKING DAYS
     function get_total_working_days(){
       $query="SELECT abs_date FROM edu_attendance_history GROUP BY CAST(abs_date AS DATE)";
       $resultset1=$this->db->query($query);
 	  return $resultset1->result();
     }

	 function get_fees_status_details($enroll_id)
	 {      //echo $enroll_id; 
		    $sql="SELECT enroll_id,class_id,admission_id,quota_id FROM edu_enrollment WHERE enroll_id='$enroll_id'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$enr_id=$rows->enroll_id;
			$cls_id=$rows->class_id;
			$qid=$rows->quota_id;
		
			$sql1="SELECT fs.*,fm.term_id,fm.due_date_from,fm.due_date_to,fm.notes,y.year_id,y.from_month,y.to_month,t.term_id,t.term_name,q.quota_name FROM edu_term_fees_status AS fs,edu_fees_master AS fm,edu_academic_year AS y,edu_terms AS t,edu_quota AS q WHERE fs.student_id='$enr_id' AND fs.class_master_id='$cls_id' AND fs.quota_id='$qid' AND fs.fees_id=fm.id AND fm.status='Active' AND fm.term_id=t.term_id AND fs.year_id=y.year_id AND fs.quota_id=q.id";
		    $result1=$this->db->query($sql1);
			$row1=$result1->result();
			return $row1;
	 }
	 
    function get_fees_status_details_single($enroll_id)
	 {      //echo $enroll_id; 
			$sql="SELECT enroll_id,class_id,admission_id,quota_id FROM edu_enrollment WHERE enroll_id='$enroll_id'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$enr_id=$rows->enroll_id;
			$cls_id=$rows->class_id;
			$qid=$rows->quota_id;

			$sql1="SELECT fs.*,fm.term_id,fm.due_date_from,fm.due_date_to,fm.notes,y.year_id,y.from_month,y.to_month,t.term_id,t.term_name,q.quota_name FROM edu_term_fees_status AS fs,edu_fees_master AS fm,edu_academic_year AS y,edu_terms AS t,edu_quota AS q WHERE fs.student_id='$enr_id' AND fs.class_master_id='$cls_id' AND fs.quota_id='$qid' AND fs.fees_id=fm.id AND fm.status='Active' AND fm.term_id=t.term_id AND fs.year_id=y.year_id AND fs.quota_id=q.id";
			$result1=$this->db->query($sql1);
			$row1=$result1->result();
			return $row1;
	 }
 
 
      function get_onduty_status_details($enroll_id)
	  {
		    $sql="SELECT enroll_id,class_id,admission_id,quota_id FROM edu_enrollment WHERE enroll_id='$enroll_id'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$enr_id=$rows->admission_id;
			//echo $enr_id;
			
		    $sql="SELECT user_master_id,user_id,user_type FROM edu_users WHERE user_master_id='$enr_id' AND user_type='3'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$stu_user_id=$rows->user_id;
			//echo $stu_user_id;
			
			  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
			  $result1=$this->db->query($get_year);
			  $all_year= $result1->result();
			  if($result1->num_rows()==0){ }else{
			  foreach($all_year as $cyear){}
			  $current_year=$cyear->year_id;
		      // echo $current_year;exit;
			
			$sql1="SELECT * FROM edu_on_duty WHERE user_type='3' AND user_id='$stu_user_id' AND year_id='$current_year'";
			$result1=$this->db->query($sql1);
			$row1=$result1->result();
			return $row1;
			  }
	  }
}
?>

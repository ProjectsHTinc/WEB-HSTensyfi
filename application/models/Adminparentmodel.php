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

			$query2="SELECT * FROM edu_enrollment WHERE enroll_id='$enroll_id' AND status='A'";
			$result1=$this->db->query($query2);
			$row3=$result1->result();
			foreach($row3 as $row4){
			$admisn_no=$row4->admisn_no;
			$name=$row4->name;
			$class_id=$row4->class_id;
			}
			$query3="SELECT h.*,cm.class_sec_id,cm.class,cm.section,c.*,se.* FROM edu_homework AS h,edu_classmaster AS cm,edu_class AS c,edu_sections AS se WHERE h.class_id='$class_id' AND h.status='A' AND h.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=se.sec_id ORDER BY h.hw_id DESC" ;
			$result2=$this->db->query($query3);
			$row4=$result2->result();
			return $row4;


		}

		function get_stu_id($enroll_id)
		{
			$query2="SELECT name,admisn_no,enroll_id,class_id FROM edu_enrollment WHERE enroll_id='$enroll_id' AND status='A'";
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
			$query2="SELECT * FROM edu_enrollment WHERE enroll_id='$enroll_id' AND status='A'";
			$result1=$this->db->query($query2);
			$row3=$result1->result();
			foreach($row3 as $row4){
			$admisn_no=$row4->admisn_no;
			$name=$row4->name;
			$class_id=$row4->class_id;
			}

			 $sql="SELECT m.*,ed.exam_id,ed.exam_year,ed.exam_name FROM edu_exam_marks_status AS m,edu_examination AS ed WHERE m.classmaster_id='$class_id' AND  m.status='A' AND m.exam_id=ed.exam_id";
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


	  function get_all_classid($enroll_id)
	  {
		    $query2="SELECT enroll_id,class_id,name,admisn_no FROM edu_enrollment WHERE enroll_id='$enroll_id' AND status='A'";
			$result1=$this->db->query($query2);
			$row3=$result1->result();
			foreach($row3 as $row4){
			$admisn_no=$row4->admisn_no;
			$name=$row4->name;
			$cls_id=$row4->class_id;
			}

		  $sql="SELECT * FROM edu_communication WHERE status='A' AND FIND_IN_SET('$cls_id',class_id) ORDER BY commu_id DESC ";
		  $res=$this->db->query($sql);
		  $row=$res->result();
		  return $row;

	  }
	  
	  function view_exam_calender($enroll_id)
	  {
		   
			$sql1="SELECT * FROM edu_examination WHERE status='A'";
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


}
?>

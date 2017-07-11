<?php

Class Adminattendancemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

            function get_cur_year(){
              $check_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
              $get_year=$this->db->query($check_year);
              foreach($get_year->result() as $current_year){}
              //
              if($get_year->num_rows()==1){
                $acd_year= $current_year->year_id;
                $data= array("status" =>"success","cur_year"=>$acd_year);
                //print_r($data);exit;
                 return $data;
              }else{
                $data= array("status" =>"noYearfound");
                return $data;
              }

            }


      //GET ALL CLASS
       function get_all_class(){
         $query="SELECT ee.class_id,COUNT(CASE WHEN ee.class_id = ee.class_id THEN ee.class_id END) AS total_count,c.class_name,ss.sec_name FROM edu_enrollment AS ee INNER JOIN edu_classmaster AS cm ON ee.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id GROUP BY class_id";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }


       //Class list for month view
       function get_class_list($class_id){
         $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
         $query="SELECT ea.*,eu.name FROM edu_attendence  AS ea JOIN edu_users  AS eu ON eu.user_id=ea.created_by WHERE class_id='$class_id' AND ac_year='$year_id' ORDER BY created_at DESC";
         $resultset=$this->db->query($query);
         return $resultset->result();

       }


       //LIST of record for class
       function get_list_record($at_id,$class_id){
         $query="SELECT  c.enroll_id, c.name, o.a_status FROM  edu_enrollment c LEFT JOIN edu_attendance_history o ON c.enroll_id = o.student_id AND o.attend_id ='$at_id' WHERE c.class_id='$class_id' ORDER BY c.name ASC";
         $res=$this->db->query($query);
         return $res->result();
       }


       //Get month for class view attendance
       function get_month_class($class_id){
         $query="SELECT DATE_FORMAT(`abs_date`,'%M') AS showmonth FROM edu_attendance_history WHERE class_id='$class_id' GROUP BY showmonth";
         $res=$this->db->query($query);
         return $res->result();
       }




}
?>

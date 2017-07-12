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
         $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
         $query="SELECT ee.class_id,COUNT(CASE WHEN ee.class_id = ee.class_id THEN ee.class_id END) AS total_count,c.class_name,ss.sec_name FROM edu_enrollment AS ee INNER JOIN edu_classmaster AS cm ON ee.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE ee.admit_year='$year_id' GROUP BY ee.class_id";
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
         $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
         $query="SELECT DATE_FORMAT(`created_at`,'%M') AS showmonth,DATE_FORMAT(`created_at`,'%m') AS month_id FROM edu_attendence WHERE class_id='$class_id' AND ac_year='$year_id' GROUP BY showmonth";
         $res=$this->db->query($query);
         return $res->result();
       }

       //Get year for class view attendance
       function get_year_class($class_id){
         $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
         $query="SELECT DATE_FORMAT(`created_at`,'%Y') AS showyear FROM edu_attendence WHERE class_id='$class_id' AND ac_year='$year_id' GROUP BY showyear";
         $res=$this->db->query($query);
         return $res->result();
       }

      //GET Month View for Class
      function get_monthview_class($first,$last,$class_master_id){
        $acd_year=$this->get_cur_year();
        $year_id= $acd_year['cur_year'];
        $query="SELECT COUNT(ah.student_id) as leaves,en.enroll_id, en.class_id, en.name, c.class_name, s.sec_name, ah.abs_date, ah.a_status, ah.attend_period, at.at_id FROM edu_enrollment en
        INNER JOIN edu_attendance_history AS ah ON en.enroll_id = ah.student_id
        INNER JOIN edu_attendence AS at ON ah.attend_id = at.at_id
        INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
        INNER JOIN edu_class AS c ON cm.class=c.class_id
        INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_master_id' AND en.admit_year = '1' AND ah.abs_date >= '$first' AND ah.abs_date <= '$last' GROUP BY ah.student_id
        UNION ALL
        SELECT '0' as leaves,en.enroll_id, en.class_id, en.name, c.class_name, s.sec_name, '' as abs_date, 'P' as a_status, '' as attend_period,'' as at_id FROM edu_enrollment en
        INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
        INNER JOIN edu_class AS c ON cm.class=c.class_id
        INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_master_id' AND en.admit_year = '1' AND en.enroll_id
        NOT IN (SELECT en.enroll_id FROM edu_enrollment en
        INNER JOIN edu_attendance_history AS ah ON en.enroll_id = ah.student_id
        INNER JOIN edu_attendence AS at ON ah.attend_id = at.at_id
        INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
        INNER JOIN edu_class AS c ON cm.class=c.class_id
        INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_master_id' AND ah.abs_date >= '$first' AND ah.abs_date <= '$last')
        GROUP BY en.enroll_id";
        $res=$this->db->query($query);
        return $res->result();
      }


      // //Get Student Leave Dates
      // function get_leave_dates($enroll_id){
      //   $query="SELECT abs_date,a_status FROM edu_attendance_history WHERE student_id='$enroll_id'";
      //   $res=$this->db->query($query);
      //   return $res->result();
      //
      // }

      // Get Student Leave Days
      function get_leave_dates($student_id,$month_id,$year_id){
         $query="SELECT DATE_FORMAT(abs_date,'%d-%m-%Y')AS abs_date,a_status FROM edu_attendance_history WHERE MONTH(abs_date) = '$month_id' AND YEAR(abs_date) = '$year_id' AND student_id='$student_id'";
        $res=$this->db->query($query);
        if($res->num_rows()==0){
          $data= array("status" => "nodata");
          return $data;
          }else{
          $result= $res->result();
            $data= array("status" => "success","res" => $result);
            return $data;
          }
      }


}
?>

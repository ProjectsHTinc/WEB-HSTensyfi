<?php

Class Teacherattendencemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

		  //GET Teacher Id in user table


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


      function get_teacher_id($user_id){
        $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
        $resultset=$this->db->query($query);
        $row=$resultset->result();
         foreach($row as $rows){}
         $teacher_id=$rows->teacher_id;
         $get_classes="SELECT class_name FROM edu_teachers WHERE teacher_id='$teacher_id'";
         $resultset1=$this->db->query($get_classes);
         $teacher_row=$resultset1->result();
        foreach($teacher_row as $teacher_rows){}
        $teach_id=$teacher_rows->class_name;
        $sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
        $objRs=$this->db->query($sQuery);
        $row=$objRs->result();
        foreach ($row as $rows1) {
        $s= $rows1->class_sec_id;
        $sec=$rows1->class;
        $clas=$rows1->class_name;
        $sec_name=$rows1->sec_name;
        $arryPlatform = explode(",", $teach_id);
       $sPlatform_id  = trim($s);
       $sPlatform_name  = trim($sec);
 			 if(in_array($sPlatform_id, $arryPlatform )) {
 				 $class_id[]=$s;
         $class_name[]=$clas;
         $sec_n[]=$sec_name;
 			 }
 			 }
      // print_r($sec_n);exit
      if(empty($class_id)){
        $data= array("status" =>"No Record Found");
        return $data;
      }else{

        $data= array("class_id" => $class_id,"class_name"=>$class_name,"sec_name"=>$sec_n,"status"=>"success");
        return $data;
      }
        //print_r($data);exit;


       }


       function get_studentin_class($class_id){


        $acd_year=$this->get_cur_year();
        //print_r($acd_year['cur_year']);
        $ye= $acd_year['cur_year'];
      //  exit;

         $query="SELECT * FROM edu_enrollment WHERE class_id='$class_id' AND admit_year='$ye'";
         $resultset=$this->db->query($query);
         return $resultset->result();
         //print_r($res);exit;


       }


       function get_attendence_class($class_id,$student_id,$attendence_val,$a_taken,$student_count,$get_academic){

            $len=count($student_id);
            //print_r($attendence_val);exit;
           if(empty($attendence_val)){
             $at_val=0;
           }else{
                $at_val=count($attendence_val);
           }
           $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
          $cur_d=$dateTime->format("Y-m-d H:i:s");
          $a_pe=$dateTime->format("A");

          if($a_pe=="AM"){
            $a_period="0";
          }else{
            $a_period="1";
          }
            $add_att_cal="INSERT INTO edu_attendance_calendar(Date,class_master_id) VALUES('$cur_d',$class_id)";
            $att_add=$this->db->query($add_att_cal);
            $total_present=$student_count-$at_val;
            //print_r($a_taken);
              $query="INSERT INTO edu_attendence (ac_year,class_id,class_total,attendence_period,created_by,created_at,status) VALUES('$get_academic','$class_id','$student_count','$a_period','$a_taken','$cur_d','Active')";
             $resultset=$this->db->query($query);
             $atten_id = $this->db->insert_id();
             if(empty($attendence_val)){
               $data= array("status" =>"success");
               return $data;
             }else{
               $last_id=$this->db->insert_id();
               $myArray1 = implode(',', $attendence_val);
               $myArray = explode(',', $myArray1);
               $sp=array_chunk($myArray,3);
               $at_len=count($attendence_val);
               for ($i=0; $i <$at_len; $i++) {
                  $a_status= $sp[$i][0];
                 $stu_id= $sp[$i][1];
                 $a_day= $sp[$i][2];
                  //print_r($a_day);
             //echo count($stu_id);
             if($a_status!="P"){
               $add_att="INSERT INTO edu_attendance_history(attend_id,class_id,student_id,abs_date,a_status,attend_period,a_val,a_taken_by,created_at,status) VALUES('$last_id','$class_id','$stu_id','$cur_d','$a_status','$a_period','1','$a_taken',NOW(),'Active')";
                $resultset=$this->db->query($add_att);
             }




          }
          $att_co="SELECT count(attend_id) as absentcount FROM edu_attendance_history WHERE attend_id='$atten_id' AND a_status='L'";
          $res_att=$this->db->query($att_co);
          foreach($res_att->result() as $rwos){}
          $leav_count= $rwos->absentcount;
           $att_co1="SELECT count(attend_id) as absentcount FROM edu_attendance_history WHERE attend_id='$atten_id' AND a_status='A'";
          $res_att1=$this->db->query($att_co1);
          foreach($res_att1->result() as $rwos){}
          $leav_count= $rwos->absentcount;
           $abs_count=$leav_count+$leav_count;
           $no_prese=$at_val-$abs_count;
           $update_class_present="UPDATE edu_attendence SET no_of_present='$no_prese',no_of_absent='$abs_count' WHERE at_id='$atten_id'";
           $res_update=$this->db->query($update_class_present);

             if($resultset){
               $delte="DELETE FROM edu_attendance_history WHERE a_status='P'";
               $resultdelete=$this->db->query($delte);

               $data= array("status" =>"success");
               return $data;
             }else{
               $data= array("status" =>"failure");
               return $data;
             }
             }



       }

       function check_attendence($class_id){
         $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
         $cur_d=$dateTime->format("Y-m-d");
         $a_day=$dateTime->format("A");
         if($a_day=="AM"){
           $a_period="0";
         }else{
            $a_period="1";
         }

          $check_leave="SELECT * FROM edu_leaves WHERE leave_date='$cur_d'";
          $get_le=$this->db->query($check_leave);
          if($get_le->num_rows()==0){
            $check_reg_leave="SELECT * FROM edu_holidays_list_history WHERE leave_list_date='$cur_d'";
            $get_re=$this->db->query($check_reg_leave);
            if($get_re->num_rows()==0){
               $check_attendence="SELECT * FROM edu_attendence WHERE class_id='$class_id' AND DATE_FORMAT(created_at, '%Y-%m-%d')='$cur_d' AND attendence_period='$a_period'";
               $get_att=$this->db->query($check_attendence);
               if($get_att->num_rows()==0){

                 $data= array("status" =>"success");
                 return $data;

               }else{
                 $data= array("status" =>"taken");
                 return $data;

               }
               $data= array("status" =>"success");
              // print_r($data);exit;
              return $data;
            }
            else{
              $data= array("status" =>"regular");
              //print_r($data);exit;
              return $data;

            }
            $data= array("status" =>"success");
            return $data;
          }else{
            $data= array("status" =>"special");
            return $data;

          }

       }


       function get_atten_val($class_id){
          $acd_year=$this->get_cur_year();
          $ye= $acd_year['cur_year'];
          $query="SELECT ea.*,eu.name FROM edu_attendence  AS ea JOIN edu_users  AS eu ON eu.user_id=ea.created_by WHERE class_id='$class_id' AND ac_year='$ye' ORDER BY created_at DESC";
          $res=$this->db->query($query);
          return $res->result();


       }

       function get_list_record($at_id,$class_id){
         $query="SELECT  c.enroll_id, c.name, o.a_status FROM  edu_enrollment c LEFT JOIN edu_attendance_history o ON c.enroll_id = o.student_id AND o.attend_id ='$at_id' WHERE c.class_id='$class_id' ORDER BY c.name ASC";
         $res=$this->db->query($query);
         return $res->result();
       }











}
?>

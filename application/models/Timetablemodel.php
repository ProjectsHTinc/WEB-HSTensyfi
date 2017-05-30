<?php

Class Timetablemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

       //GET ALL TERMS

              function create_timetable($year_id,$term_id,$class_id,$subject_id,$teacher_id,$day_id,$period_id){
                    $check="SELECT * FROM edu_timetable WHERE class_id='$class_id' AND year_id='$year_id'";

                 $result1=$this->db->query($check);
                 if($result1->num_rows()>=1){
                   $data= array("status" => "Already");
                   return $data;
                 }
                //  exit;

                $count_name = count($teacher_id);
                for($i=0;$i<$count_name ;$i++){
                    $day  = $day_id[$i];
                    $period  =$period_id[$i];
                    $classid=$class_id;
                    $termid=$term_id;
                    $yearid=$year_id;
                    $subjectid=$subject_id[$i];
                    $teacherid=$teacher_id[$i];
                    $query = "INSERT INTO edu_timetable (year_id,term_id,class_id,subject_id,teacher_id,day,period,status,created_at,updated_at) VALUES ('$yearid','$termid','$classid','$subjectid','$teacherid','$day','$period','A',NOW(),NOW())";
                    $resultset=$this->db->query($query);

                  }
                  if($resultset){
                  $data= array("status" => "success");
                  return $data;}
                  else{
                    $data= array("status" => "failure");
                    return $data;
                  }
                }

                //GET ALL Class assisgned for time table

                function view_class_timetable(){
                  $get_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
                  $result1=$this->db->query($get_year);
                  foreach($result1->result() as $res){}
                  $year_id=$res->year_id;


                   $query="SELECT tt.class_id AS timid,cm.class_sec_id,cm.class,cm.section,c.class_id,tt.year_id,a.from_month,a.to_month,c.class_name,s.sec_name
FROM edu_timetable AS tt  INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id
INNER JOIN edu_academic_year AS a ON tt.year_id=a.year_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE tt.year_id='$year_id' GROUP BY c.class_name";
                  $result=$this->db->query($query);
                  // echo "<pre>";
                  // print_r($result->result());exit;
                  return $result->result();


                }

                function getall_years(){
                  $get_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
                  $result1=$this->db->query($get_year);
                  if($result1->num_rows()==0){
                    $data= array("status" => "no data Found");
                    return $data;
                  }else{
                    $all_year= $result1->result();
                    $data= array("status" => "success","all_years"=>$all_year);
                    return $data;
                    //print_r($all_year);
                  }

                }

                //GET ALL TIME TABLE
                function view($class_sec_id){
                  $get_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
                  $result1=$this->db->query($get_year);
                  foreach($result1->result() as $res){}
                  $year_id=  $res->year_id;
                     $query="SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id WHERE tt.class_id='$class_sec_id' AND tt.year_id='$year_id' ORDER BY tt.table_id ASC";

                   $result=$this->db->query($query);
                  if($result->num_rows()==0){
                    $data= array("status" => "no data Found");
                    return $data;
                  }else{
                    // $data= array("status" => "no data Found","data"=>$result->result());
                    // return $data;
                  return $result->result();
                  }

                }

                function view_time($class_sec_id){
                    $query="SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id WHERE tt.class_id='$class_sec_id' ORDER BY tt.table_id ASC";
                   $result=$this->db->query($query);
                   $time=$result->result();
                  if($result->num_rows()==0){
                    $data= array("st" => "no data Found");
                    return $data;
                  }else{
                    $data= array("st" => "success","time"=>$time);
                    return $data;
                // return $result->result();
                  }

                }

                function get_subject_class($class_sec_id){
                  //echo $class_sec_id;
                        $query="SELECT * FROM edu_classmaster WHERE class_sec_id='$class_sec_id'";
                        $result=$this->db->query($query);
                        foreach($result->result() as $rows){}
                        $sPlatform=   $rows->subject;
                        $sQuery = "SELECT * FROM edu_subject";
                        $objRs=$this->db->query($sQuery);
                         //print_r($objRs);
                        $row=$objRs->result();
                        foreach ($row as $rows1) {
                        $s= $rows1->subject_id;
                        $sec=$rows1->subject_name;
                        $arryPlatform = explode(",", $sPlatform);
                        $sPlatform_id  = trim($s);
                        $sPlatform_name  = trim($sec);
                        if(in_array($sPlatform_id, $arryPlatform )) {
                          $sub_id[]=$s;
                          $sub_name[]=$sec;
                        //  $sec_n[]=$sec_name;
                        }
                          }
                          if(empty($sub_id)){
                            $data= array("status" =>"No Record Found");
                            return $data;
                          }else{

                            $data= array("subject_id" => $sub_id,"subject_name"=>$sub_name,"status"=>"success");
                            return $data;
                          }


              }

              // Get Teacher To Class
               function get_teacher_class($class_sec_id){
                $query="SELECT teacher_id,name,class_name FROM edu_teachers WHERE  FIND_IN_SET('$class_sec_id',class_name)";
                 $resultset=$this->db->query($query);
                 if($resultset->num_rows()==0){
                   $data= array("status" =>"No Record Found");
                   return $data;
                 }else{
                  $res= $resultset->result();
                  //  foreach($res as $rows){
                     //$teacher_id=$rows->teacher_id; $teacher_name=$rows->name;$class_name=$rows->class_name;
                     $data= array("status"=>"success","res"=>$res);

                    //  }
                       return $data;


                 }
               }


              //Save Review

              function save_review($class_id,$user_id,$user_type,$subject_id,$cur_date,$comments){
               $query="INSERT INTO edu_timetable_review (time_date,class_id,subject_id,user_type,user_id,comments,status,created_at,update_at) VALUES ('$cur_date','$class_id','$subject_id','$user_type','$user_id','$comments','A',NOW(),NOW())";
                 $resultset=$this->db->query($query);
                 if($resultset){
                   $data= array("status" => "success");
                   return $data;
                 }else{
                   $data= array("status" => "failure");
                   return $data;
                 }


              }
              //View Review

              function view_review($user_id){
                 $query="SELECT etr.class_id,c.class_name,s.sec_name,etr.subject_id,etr.time_date,esu.subject_name,etr.comments,etr.remarks FROM edu_timetable_review AS etr
                INNER JOIN edu_classmaster AS cm ON etr.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id
                INNER JOIN edu_subject AS esu ON etr.subject_id=esu.subject_id  WHERE user_id ='$user_id' ORDER BY update_at ASC";
                 $resultset=$this->db->query($query);
                 return $resultset->result();
                }


                function view_review_all(){
                   $query="SELECT etr.timetable_id,etr.user_id,edu.name,etr.class_id,c.class_name,s.sec_name,etr.subject_id,etr.time_date,esu.subject_name,etr.comments,etr.remarks FROM edu_timetable_review AS etr
                  INNER JOIN edu_classmaster AS cm ON etr.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id
                  INNER JOIN edu_subject AS esu ON etr.subject_id=esu.subject_id  INNER JOIN edu_users AS edu ON etr.user_id=edu.user_id ORDER BY etr.created_at ASC";
                   $resultset=$this->db->query($query);
                   return $resultset->result();
                  }

                  function edit_review_all($timetable_id){
                   $query="SELECT etr.timetable_id,etr.user_id,edu.name,etr.class_id,c.class_name,s.sec_name,etr.subject_id,etr.time_date,esu.subject_name,etr.comments,etr.remarks
                    FROM edu_timetable_review AS etr INNER JOIN edu_classmaster AS cm ON etr.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id
                    INNER JOIN edu_subject AS esu ON etr.subject_id=esu.subject_id INNER JOIN edu_users AS edu ON etr.user_id=edu.user_id WHERE etr.timetable_id='$timetable_id'";
                    $resultset=$this->db->query($query);
                     return $resultset->result();
                    }


                    function save_user_review($timetable_id,$remarks){
                      $query="UPDATE edu_timetable_review SET remarks='$remarks',update_at=NOW() WHERE timetable_id='$timetable_id'";
                      $resultset=$this->db->query($query);
                      if($resultset){
                        $data= array("status" => "success");
                        return $data;
                      }else{
                        $data= array("status" => "failure");
                        return $data;
                      }

                    }

                //Delete timetable

                function delete_time($class_sec_id){
                  $query="DELETE FROM edu_timetable WHERE class_id='$class_sec_id'";
                  $result=$this->db->query($query);
                  if($result){
                    $data= array("status" => "success");
                    return $data;
                  }
                }
}
?>

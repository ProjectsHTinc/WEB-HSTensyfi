<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apiadminmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


//#################### Current Year ####################//

	public function sendMail($to,$subject,$htmlContent)
	{
		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers
		$headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
		mail($to,$subject,$htmlContent,$headers);
	}


//#################### Login ####################//


//#################### Current Year ####################//

	public function getYear()
	{
		$sqlYear = "SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'A'";
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




//#################### GET ALL ClASS ####################//

  function get_classes(){
    $sql="SELECT ec.class_name,ec.class_id FROM edu_classmaster AS ecm LEFT JOIN edu_class AS ec ON ec.class_id=ecm.class GROUP BY ec.class_name";
    $res=$this->db->query($sql);
    if($res->num_rows()==0){
        $data=array("msg"=>"nodata");
        return $data;
    }else{
      $result=$res->result();
      $data=array("msg"=>"success","data"=>$result);
      return $data;
    }
  }


  //#################### GET ALL SECTIONS ####################//

    function get_all_sections($class_id){
      $sql="SELECT es.sec_name,es.sec_id FROM edu_classmaster AS ecm LEFT JOIN edu_sections AS es ON ecm.section=es.sec_id WHERE ecm.class='$class_id'";
      $res=$this->db->query($sql);
      if($res->num_rows()==0){
          $data=array("msg"=>"nodata");
          return $data;
      }else{
        $result=$res->result();
        $data=array("msg"=>"success","data"=>$result);
        return $data;
      }
    }


        //#################### GET ALL Students in class ####################//

          function get_all_students_in_classes($class_id,$section_id){
            $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
            $res=$this->db->query($sql);
              $result=$res->result();
              foreach($result as $rows){   }
              $classid=$rows->class_sec_id;
              $year_id=$this->getYear();
            $stu_list="SELECT eer.name,eer.enroll_id,eer.admisn_no,ea.sex,ea.admisn_year FROM edu_enrollment AS eer LEFT JOIN edu_admission AS ea ON ea.admisn_no=eer.admisn_no WHERE eer.class_id='$classid' AND eer.admit_year='$year_id' AND eer.status='A'";
            $res_stu=$this->db->query($stu_list);
              $result_stud=$res_stu->result();
            if($res->num_rows()==0){
                $data=array("msg"=>"nodata");
                return $data;
            }else{
              $result=$res->result();
              $data=array("msg"=>"success","data"=>$result_stud);
              return $data;
            }
          }



        //#################### GET STUDENT & PARENTS DETAILS ####################//

          function get_student_details($student_id){
            $sql="SELECT er.admission_id,ea.name,ea.sex,DATE_FORMAT(dob,'%d-%m-%Y') AS dob,ea.nationality,ea.religion,ea.community_class,ea.community,ea.language,ea.mobile,ea.email,ea.parents_status FROM edu_enrollment AS er LEFT JOIN edu_admission AS ea ON er.admission_id=ea.admission_id WHERE er.enroll_id='$student_id'";
            $res_stu=$this->db->query($sql);
            $fees_sql="SELECT er.admission_id,ep.* FROM edu_enrollment AS er LEFT JOIN edu_parents AS ep ON er.admission_id=ep.admission_id WHERE er.enroll_id='$student_id'";
            $res_pat=$this->db->query($fees_sql);
                if($res_pat->num_rows()==0){
                    $res_parents="NO Parents Details";
                }else{
                      $res_parents=$res_pat->result();
                }
            if($res_stu->num_rows()==0){
                $data=array("msg"=>"nodata");
                return $data;
            }else{
              $result=$res_stu->result();
              $data=array("msg"=>"success","data"=>$result,"parents_details"=>$res_parents);
              return $data;
            }
          }


      //#################### GET STUDENT & ALL HOMEWORK DETAILS ####################//

        function get_all_howework_details($student_id){
          $sql="SELECT class_id FROM edu_enrollment WHERE enroll_id='$student_id'";
          $res=$this->db->query($sql);
          $result=$res->result();
          foreach($result as $rows){   }
          $classid=$rows->class_id;
          $year_id=$this->getYear();
          $get_all_hw="SELECT eh.hw_type,eh.hw_id,eh.subject_id,eh.title,es.subject_name,eh.test_date FROM edu_homework AS eh LEFT JOIN edu_subject AS es ON es.subject_id=eh.subject_id WHERE eh.class_id='$classid' AND eh.year_id='$year_id' AND eh.status='A' AND hw_type='HW' ORDER BY eh.test_date DESC";
          $result_hw=$this->db->query($get_all_hw);
          if($result_hw->num_rows()==0){
              $data=array("msg"=>"nodata");
              return $data;
          }else{
            $result_home=$result_hw->result();
            $data=array("msg"=>"success","data"=>$result_home);
            return $data;
          }

        }

      //#################### GET STUDENT &  HOMEWORK DETAILS ####################//

        function get_howework_details($hw_id){
          $get_all_hw="SELECT eh.title,eh.hw_type,eh.subject_id,es.subject_name,eh.hw_details,eh.test_date FROM edu_homework AS eh LEFT JOIN edu_subject AS es ON es.subject_id=eh.subject_id WHERE eh.hw_id='$hw_id'";
          $result_hw=$this->db->query($get_all_hw);
          if($result_hw->num_rows()==0){
              $data=array("msg"=>"nodata");
              return $data;
          }else{
            $result_home=$result_hw->result();
            $data=array("msg"=>"success","data"=>$result_home);
            return $data;
          }

        }


        //#################### GET STUDENT & ALL CLASSTEST DETAILS ####################//

          function get_all_classtest_details($student_id){
            $sql="SELECT class_id FROM edu_enrollment WHERE enroll_id='$student_id'";
            $res=$this->db->query($sql);
            $result=$res->result();
            foreach($result as $rows){   }
            $classid=$rows->class_id;
            $year_id=$this->getYear();
            $get_all_hw="SELECT eh.hw_type,eh.hw_id,eh.subject_id,eh.title,es.subject_name,eh.test_date FROM edu_homework AS eh LEFT JOIN edu_subject AS es ON es.subject_id=eh.subject_id WHERE eh.class_id='$classid' AND eh.year_id='$year_id' AND eh.status='A' AND hw_type='CT' ORDER BY eh.test_date DESC";
            $result_hw=$this->db->query($get_all_hw);
            if($result_hw->num_rows()==0){
                $data=array("msg"=>"nodata");
                return $data;
            }else{
              $result_home=$result_hw->result();
              $data=array("msg"=>"success","data"=>$result_home);
              return $data;
            }

          }

          //#################### GET STUDENT &  CLASSTEST DETAILS ####################//

            function get_classtest_details($hw_id){
              $get_all_hw="SELECT eh.title,eh.hw_type,eh.subject_id,es.subject_name,eh.hw_details,eh.test_date,eh.mark_status FROM edu_homework AS eh LEFT JOIN edu_subject AS es ON es.subject_id=eh.subject_id WHERE eh.hw_id='$hw_id'";
              $result_hw=$this->db->query($get_all_hw);
              if($result_hw->num_rows()==0){
                  $data=array("msg"=>"nodata");
                  return $data;
              }else{
                $result_home=$result_hw->result();
                $data=array("msg"=>"success","data"=>$result_home);
                return $data;
              }

            }


            //#################### GET ALL EXAM DETAILS ####################//

            function get_all_exam_details(){
              $year_id=$this->getYear();
              $sql="SELECT exam_id,exam_name FROM edu_examination WHERE exam_year='$year_id' AND STATUS='A'";
              $result=$this->db->query($sql);
              if($result->num_rows()==0){
                  $data=array("msg"=>"nodata");
                  return $data;
              }else{
                $exam_result=$result->result();
                $data=array("msg"=>"success","data"=>$exam_result);
                return $data;
              }


            }


              //#################### GET  EXAM DETAILS ####################//
            function get_exam_details($student_id,$exam_id){
              $sql="SELECT class_id FROM edu_enrollment WHERE enroll_id='$student_id'";
              $res=$this->db->query($sql);
              $result=$res->result();
              foreach($result as $rows){   }
              $classid=$rows->class_id;
              $exam_sql="SELECT eed.subject_id,es.subject_name,DATE_FORMAT(eed.exam_date,'%d-%m-%Y')AS exam_date,eed.times FROM edu_exam_details AS eed LEFT JOIN edu_subject AS es ON es.subject_id=eed.subject_id WHERE eed.classmaster_id='$classid' AND eed.exam_id='$exam_id' AND eed.status='A' ORDER BY exam_date ASC";
              $ex_result=$this->db->query($exam_sql);
              if($ex_result->num_rows()==0){
                  $data=array("msg"=>"nodata");
                  return $data;
              }else{
                $exam_result=$ex_result->result();
                $data=array("msg"=>"success","data"=>$exam_result);
                return $data;
              }

            }


                //#################### GET  ALL TEACHERS ####################//

            function get_all_teachers(){
              $sql="SELECT et.name,et.sex,et.age,et.class_teacher,c.class_name,s.sec_name,et.subject,esu.subject_name,et.teacher_id FROM edu_teachers
              AS et INNER JOIN edu_classmaster AS cm ON et.class_teacher=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON  cm.section=s.sec_id INNER JOIN edu_subject AS esu ON et.subject=esu.subject_id WHERE et.status='A'";
              $res=$this->db->query($sql);
              if($res->num_rows()==0){
                  $data=array("msg"=>"nodata");
                  return $data;
              }else{
                $result=$res->result();
                $data=array("msg"=>"success","data"=>$result);
                return $data;
              }

            }


            //#################### GET   TEACHER DETAILS  ####################//
            function get_teacher($teacher_id){
              $sql="SELECT et.name,et.sex,et.age,et.class_teacher,c.class_name,s.sec_name,et.subject,esu.subject_name,et.teacher_id,et.profile_pic FROM edu_teachers  AS et INNER JOIN edu_classmaster AS cm ON et.class_teacher=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id
              INNER JOIN edu_sections AS s ON cm.section=s.sec_id INNER JOIN edu_subject AS esu ON et.subject=esu.subject_id WHERE et.status='A' AND et.teacher_id='$teacher_id'";
              $res_detail=$this->db->query($sql);
              $sql="SELECT class_name FROM edu_teachers WHERE teacher_id='$teacher_id'";
              $res=$this->db->query($sql);
              $result=$res->result();
              foreach($result as $rows){   }
              $sPlatform=$rows->class_name;
               $sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
                $objRs=$this->db->query($sQuery);
               $row=$objRs->result();
               foreach ($row as $rows1) {
               $s= $rows1->class_sec_id;
               $sec=$rows1->class;
               $clas=$rows1->class_name;
                $sec_name=$rows1->sec_name;
                $arryPlatform = explode(",", $sPlatform);
                $sPlatform_id  = trim($s);
                $sPlatform_name  = trim($sec);
              if (in_array($sPlatform_id, $arryPlatform )) {
                $class_name[]=$clas.''.  $section_name[]=$sec_name;
              //  $section_name[]=$sec_name;
              }

               }
             if(empty($class_name)){
               $class_list= array("status" =>"No Record Found");
             }else{
               $class_list= array("class_name" => $class_name);
             }

              if($res->num_rows()==0){
                  $data=array("msg"=>"nodata");
                  return $data;
              }else{
                $result=$res_detail->result();
                $data=array("msg"=>"success","data"=>$result,"class_name" => $class_list);
                return $data;
              }
            }


            //#################### GET   TEACHER CLASS DETAILS  ####################//
            function get_teacher_class_details($teacher_id){
              $sql="SELECT class_name FROM edu_teachers WHERE teacher_id='$teacher_id'";
              $res=$this->db->query($sql);
              $result=$res->result();
              foreach($result as $rows){   }
              $sPlatform=$rows->class_name;
               $sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
                $objRs=$this->db->query($sQuery);
               $row=$objRs->result();
               foreach ($row as $rows1) {
               $s= $rows1->class_sec_id;
               $sec=$rows1->class;
               $clas=$rows1->class_name;
                $sec_name=$rows1->sec_name;
                $arryPlatform = explode(",", $sPlatform);
                $sPlatform_id  = trim($s);
                $sPlatform_name  = trim($sec);
              if (in_array($sPlatform_id, $arryPlatform )) {
                $class_name[]=$clas.''.  $section_name[]=$sec_name;
                $section_name[]=$sec_name;
              }
               }
               if(empty($class_name)){
                 $data= array("status" =>"No Record Found");
                 return $data;
               }else{

                 $data= array("class_name" => $class_name,"status"=>"success");
                 return $data;
               }
              }


                    //#################### GET   LIST OF PARENTS   ####################//
              function get_list_of_parents($class_id,$section_id){
                $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
                $res=$this->db->query($sql);
                $result=$res->result();
                foreach($result as $rows){   }
                $classid=$rows->class_sec_id;
                $year_id=$this->getYear();
                $stu_list="SELECT eer.name,eer.admisn_no,ea.sex,ea.admisn_year,ep.father_name,ep.mother_name,ep.guardn_name,ep.parent_id FROM edu_enrollment AS eer LEFT JOIN edu_admission AS ea ON ea.admisn_no=eer.admisn_no LEFT JOIN edu_parents AS ep ON eer.admission_id=ep.admission_id WHERE eer.class_id='$classid' AND eer.admit_year='$year_id' AND eer.status='A'";
                $res_stu=$this->db->query($stu_list);
                if($res_stu->num_rows()==0){
                    $data=array("msg"=>"nodata");
                    return $data;
                }else{
                  $result_stud=$res_stu->result();
                  $data=array("msg"=>"success","data"=>$result_stud);
                  return $data;
                }
              }


              //#################### GET   PARENT DETAILS  ####################//
              function get_parent_details($parent_id){
                $sql="SELECT ep.* FROM edu_parents AS ep WHERE ep.parent_id='$parent_id'";
                $res=$this->db->query($sql);
                if($res->num_rows()==0){
                    $data=array("msg"=>"nodata");
                    return $data;
                }else{
                  $result=$res->result();
                  $data=array("msg"=>"success","data"=>$result);
                  return $data;
                }
              }




                //#################### GET LIST OF TEACHER FOR A CLASS  ####################//
              function list_of_teachers_for_class($class_id,$section_id){
                $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
                $res=$this->db->query($sql);
                $result=$res->result();
                foreach($result as $rows){   }
                $classid=$rows->class_sec_id;
                $year_id=$this->getYear();
                $query="SELECT et.name,et.subject,es.subject_name FROM edu_teachers AS et LEFT JOIN edu_subject AS es ON et.subject=es.subject_id WHERE FIND_IN_SET('$classid',et.class_name) AND et.status='Active'";
                $result_query=$this->db->query($query);
                if($result_query->num_rows()==0){
                    $data=array("msg"=>"nodata");
                    return $data;
                }else{
                  $result=$result_query->result();
                  $data=array("msg"=>"success","data"=>$result);
                  return $data;
                }
              }

}

?>

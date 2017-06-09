<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminapimodel extends CI_Model {

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
    $sql="SELECT ec.class_name,ec.class_id FROM edu_classmaster AS ecm LEFT JOIN edu_class AS ec ON ec.class_id=ecm.class";
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
        // $get_all_studnets=""
      $stu_list="SELECT eer.name,eer.enroll_id,eer.admisn_no,ea.sex,ea.admisn_year FROM edu_enrollment AS eer LEFT JOIN edu_admission AS ea ON ea.admisn_no=eer.admisn_no WHERE eer.class_id='$classid'";
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
        $sql="SELECT er.admission_id,ea.name,ea.sex,DATE_FORMAT(dob,'%d-%m-%Y')AS dob,ea.nationality,ea.religion,ea.community_class,ea.community,ea.language,
ea.mobile,ea.email,ea.parents_status FROM edu_enrollment AS er LEFT JOIN edu_admission AS ea ON er.admission_id=ea.admission_id WHERE er.enroll_id='$student_id'";
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
        ;
          $data=array("msg"=>"success","data"=>$result,"parents_details"=>$res_parents);
          return $data;
        }
      }






}

?>

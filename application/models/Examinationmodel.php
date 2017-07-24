<?php
   
Class Examinationmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  function get_exam_details()
	 {
		$query="SELECT e.*,y.year_id,y.from_month,y.to_month FROM edu_examination AS e,edu_academic_year AS y WHERE e.exam_year=y.year_id  ORDER BY exam_id DESC";
         $resultset=$this->db->query($query);
         return $resultset->result();
	 }

	  function get_details_view()
	   {
		 $query="select ex.exam_detail_id,ex.subject_id,ex.exam_date,ex.times,ex.classmaster_id,ex.exam_id,cm.class_sec_id,ex.teacher_id,ex.status,s.subject_name,s.subject_id,c.class_name,se.sec_name FROM edu_exam_details AS ex,edu_classmaster AS cm,edu_subject AS s,edu_class AS c,edu_sections AS se WHERE  ex.subject_id=s.subject_id AND ex.classmaster_id=cm.	class_sec_id AND c.class_id =cm.class AND se.sec_id=cm.section ORDER BY ex.exam_detail_id DESC";
		 
         $resultset=$this->db->query($query);
         return $resultset->result();
		 
	 }

	  function search_details_view($class_name)
	  {
		 $query="select ex.*,s.subject_name,s.subject_id,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,se.sec_id,se.sec_name FROM edu_exam_details AS ex,edu_subject AS s,edu_classmaster AS cm, edu_class AS c,edu_sections AS se  WHERE ex.classmaster_id='$class_name' AND ex.subject_id=s.subject_id AND ex.classmaster_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=se.sec_id";
         $resultset=$this->db->query($query);
         return $resultset->result();  
	  }

	  function get_details_view1()
	   {
		 $query="select ex.exam_detail_id,ex.subject_id,ex.exam_date,ex.status,ex.times,ex.classmaster_id,cm.class_sec_id,ex.teacher_id,s.subject_name,c.class_name,se.sec_name  FROM edu_exam_details AS ex,edu_classmaster AS cm,edu_subject AS s,edu_class AS c,edu_sections AS se WHERE  ex.subject_id=s.subject_id AND ex.classmaster_id=cm.class_sec_id AND c.class_id =cm.class AND se.sec_id=cm.section GROUP BY c.class_name,se.sec_name ";

		// select ex.classmaster_id,c.class_name,s.sec_name FROM  edu_exam_details AS ex,edu_classmaster AS cm, edu_class AS c,edu_sections AS s WHERE c.class_id =cm.class AND s.sec_id=cm.section


         $resultset=$this->db->query($query);
         return $resultset->result();
	 }


    function exam_details($exam_year,$exam_name,$status)
    {
	  $check_exam_name="SELECT * FROM edu_examination WHERE exam_name='$exam_name'";
	  $result=$this->db->query($check_exam_name);
      if($result->num_rows()==0)
	  {
	  $query="INSERT INTO edu_examination(exam_year,exam_name,status,created_at,updated_at)VALUES('$exam_year','$exam_name','$status',NOW(),NOW())";
	  $resultset=$this->db->query($query);
      $data= array("status"=>"success");
      return $data;
	  }else{
            $data= array("status"=>"Exam Name Already Exist");
            return $data;
          }
    }

	 function add_exam_details($exam_year,$class_name,$subject_name,$exdate,$time,$teacher_id,$status)
	 {
		        $count_name = count($subject_name);
				//echo $count_name; exit;
                for($i=0;$i<$count_name;$i++)
				{
					//print_r($exam_year);exit;
                    $exam_years=$exam_year;
                    $class_id=$class_name;
                    $subject_id=$subject_name[$i];

                    $exam_dates=$exdate[$i];
                    $times=$time[$i];
                    $tea_id=$teacher_id[$i];
					
	    $check_exam_name="SELECT * FROM edu_exam_details WHERE exam_id='$exam_years' AND subject_id='$subject_id' AND classmaster_id='$class_id' AND exam_date='$exam_dates' AND times='$times'";
	   $result=$this->db->query($check_exam_name);
       if($result->num_rows()==0)
	    {  
			$query="INSERT INTO edu_exam_details(exam_id,subject_id,exam_date,times,classmaster_id,teacher_id,status,created_at) VALUES ('$exam_years','$subject_id','$exam_dates','$times','$class_id','$tea_id','$status',NOW())";
			$resultset=$this->db->query($query);
		  }else{
            $data= array("status"=>"Exam Already Exist");
            return $data;
          }  
	}

	$data= array("status" => "success");
     return $data;
 }
	function edit_exam($exam_id)
	{
		 $query1="SELECT * FROM  edu_examination WHERE exam_id='$exam_id'";
         $res=$this->db->query($query1);
         return $res->result();
	}
	function update_exam($exam_id,$exam_year,$exam_name,$status)
	{
		$query="UPDATE edu_examination SET exam_year='$exam_year',exam_name='$exam_name',status='$status' WHERE exam_id='$exam_id'";
		$res=$this->db->query($query);

		$query1="UPDATE edu_exam_details SET status='$status' WHERE exam_id='$exam_id'";
		$res=$this->db->query($query1);
		 
		//return $res->result();
		if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }
	}

	function edit_exam_details($exam_detail_id) 
	{
		 $query1="SELECT * FROM  edu_exam_details WHERE exam_detail_id='$exam_detail_id'";
         $res=$this->db->query($query1);
         return $res->result();
	}

	function update_exam_detail($id,$exam_year,$class_name,$subject_name,$formatted_date,$time,$teacher_id,$status)
	{
	  $check_exam_name="SELECT * FROM edu_exam_details WHERE exam_id='$exam_year' AND subject_id='$subject_name' AND classmaster_id='$class_name' AND exam_date='$formatted_date' AND times='$time' AND teacher_id='$teacher_id' AND status='$status'";
	  $result=$this->db->query($check_exam_name);
      if($result->num_rows()==0)
	   {  
	    $query="UPDATE edu_exam_details SET exam_id='$exam_year',subject_id='$subject_name',exam_date='$formatted_date',times='$time',classmaster_id='$class_name',teacher_id='$teacher_id',status='$status',updated_at='NOW()' WHERE exam_detail_id='$id' ";
		$res=$this->db->query($query);
		$data= array("status" => "success");
        return $data;
	   }else{
         $data= array("status" => "Exam Already Exist");
         return $data;
       }
	}
	
	function check_add_exam($classid,$examid)
	{
		$sql="SELECT * FROM edu_exam_details WHERE classmaster_id='$examid' AND exam_id='$classid'";
		$res1=$this->db->query($sql);
		return count($res1->result());
		
	}
    //-------------------Exam Class Result------------------------------
	
	function exam_name_status()
	{
		//$sql="SELECT * FROM edu_exam_marks_status ";
		$sql="SELECT ms.*,ex.exam_id,ex.exam_year,ex.exam_name FROM edu_exam_marks_status AS ms,edu_examination AS ex WHERE ms.exam_id=ex.exam_id GROUP BY ms.exam_id";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
		
	}
	
	function marks_statuss($exam_id)
	{  
		//$sql="SELECT * FROM edu_exam_marks_status ";
		$sql="SELECT ms.*,cm.class_sec_id,cm.class,cm.section,c.*,s.* FROM edu_exam_marks_status AS ms,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE ms.exam_id='$exam_id' AND ms.classmaster_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
		
	}
	
	function clsname_examname($exam_id,$cls_masid)
	{  
	      $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id; 
		  
		$sql="SELECT ex.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_examination AS ex,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE ex.exam_id='$exam_id' AND exam_year='$current_year' AND cm.class_sec_id='$cls_masid' AND cm.class=c.class_id AND cm.section=s.sec_id";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
		
	}
	function marks_status_details($clsmasid,$exam_id)
	   {
		    //echo $clsmasid;
		    $query="SELECT * FROM edu_exam_marks_status WHERE status='Publish' AND exam_id='$exam_id' AND classmaster_id='$clsmasid'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			return $row;
	   }
	   
	function getall_stuname($user_id,$cls_masid,$exam_id)
	   {
		   $sql="SELECT en.enroll_id,en.name,en.admisn_no,en.class_id,m.subject_id,m.classmaster_id,m.internal_mark,m.internal_grade,m.external_mark,m.external_grade,m.total_marks,m.total_grade FROM edu_enrollment AS en,edu_exam_marks AS m WHERE en.class_id='$cls_masid' AND en.enroll_id=m.stu_id AND m.exam_id='$exam_id' ";
		    //$sql="SELECT en.enroll_id,en.name,en.admisn_no,en.class_id,m.exam_id,m.subject_id,m.classmaster_id,m.marks FROM edu_enrollment AS en,edu_exam_marks AS m WHERE m.exam_id='$exam_id' AND m.classmaster_id='$cls_masid' AND en.class_id='$cls_masid' AND en.enroll_id=m.stu_id ";
			$res=$this->db->query($sql); 
			$rows=$res->result();
			return $rows;
	   }
	   
	   
	   //----------------
	   
	   function getall_subname($user_id,$cls_masid,$exam_id)
	  {
		$sql1="SELECT estc.id,estc.class_master_id,estc.subject_id,estc.exam_flag,estc.status,su.subject_id,su.subject_name FROM edu_subject_to_class AS estc,edu_subject AS su WHERE estc.class_master_id='$cls_masid' AND estc.subject_id=su.subject_id AND estc.exam_flag='0' AND  estc.status='Active' ";
		$resultset3=$this->db->query($sql1);
        $res1=$resultset3->result();
		//return $res1;
		/* if(empty($res1)){
			$data=array("status" =>"Record Not Found");
			return $data;
		}else{ */
		 foreach($res1 as $rows1){
			$sub_id[]=$rows1->subject_id;$sub_name[]=$rows1->subject_name;}
			$data=array("status" =>"Success","subject_id" =>$sub_id,"subject_name" =>$sub_name);
		    //return $data;
          //echo "<pre>"; print_r($data);			
		return $data; 
		//}
		
	}  
	   
	   //-------------
    /* function getall_subname($user_id,$cls_masid,$exam_id)
	   {
		   
			 $query="SELECT cm.class_sec_id,cm.subject,su.* FROM edu_classmaster AS cm,edu_subject AS su WHERE  cm.subject=su.subject_id AND cm.class_sec_id='$cls_masid'";
            $resultset=$this->db->query($query);
			$row=$resultset->result();
			 //print_r($row);exit;
			 if(empty($row))
			 {
				 $data= array("status" =>"Subject Not Found");
				 return $data;
			 }
			  foreach($row as $rows)
			  { }
				    $id=$rows->subject;
						//echo $id;
					   // $id=$rows->subject;
					$sql="SELECT * FROM edu_subject";
					$res1=$this->db->query($sql);
					$rows=$res1->result();
					 // echo'<pre>';  print_r($rows);exit;
					   foreach ($rows as $rows1) 
					   {
						   $s= $rows1->subject_id;
						   $sec=$rows1->subject_name;

						   $subid = explode(",",$id);
						   $subjid  = trim($s);
						   $subname  = trim($sec);
						   if(in_array($subjid,$subid))
							   {
								  $sub_name[]=$sec;
								  $sub_id[]=$s;
							   }
						 //return $a;
	                   }
					$datas= array("status" =>"Success","subject_id"=>$sub_id,"subject_name"=>$sub_name);
					return $datas;

	   }
	    */
	   function update_exam_status($exid,$cmid,$user_id)
	   {
		       $sql1="SELECT * FROM edu_exam_marks_status WHERE exam_id='$exid' AND classmaster_id='$cmid' AND status='Publish'";
			   $res1=$this->db->query($sql1);
			   $res2=$res1->result();
			   foreach($res2 as $ans){
				   $a=$ans->exam_id;
				   $b=$ans->classmaster_id;
				   }
		   if($res1->num_rows()==0)
		   {
			  $sql="UPDATE edu_exam_marks_status SET status='Publish',updated_by='$user_id',updated_at=NOW() WHERE exam_id='$exid' AND classmaster_id='$cmid'";
			  $res=$this->db->query($sql);
			   
			   $sql1="SELECT * FROM edu_exam_marks_status WHERE exam_id='$exid' AND classmaster_id='$cmid'";
			   $res1=$this->db->query($sql1);
			   $res2=$res1->result();
			   foreach($res2 as $ans){
				   $a=$ans->exam_id;
				   $b=$ans->classmaster_id;
				   }
				if($res)
				 {
					$data= array("status" => "success","var1"=>$a,"var2"=>$b);
					return $data;
			     }else{
				     $data= array("status" => "Failed to Update","var1"=>$a,"var2"=>$b);
				     return $data;
			   }
		   }else{
			   $data= array("status" => "Already Approved Exam Marks","var1"=>$a,"var2"=>$b);
			  return $data;
		   }
	   }
	   
	     function get_subject($classid)
         {
			$sql1="SELECT estc.id,estc.class_master_id,estc.subject_id,estc.exam_flag,estc.status,su.subject_id,su.subject_name FROM edu_subject_to_class AS estc,edu_subject AS su WHERE estc.class_master_id='$classid' AND estc.subject_id=su.subject_id AND estc.exam_flag='0' AND  estc.status='Active' ";
			$resultset3=$this->db->query($sql1);
			$res1=$resultset3->result();
			if(empty($res1))
			 {
			   $data=array("status" =>"Subject Not Found");
				return $data;
			 }else
			 {
			foreach($res1 as $rows1){
			$sub_id[]=$rows1->subject_id;$sub_name[]=$rows1->subject_name;}
			$data=array("status" =>"Success","subject_id" =>$sub_id,"subject_name" =>$sub_name);
		    //return $data;
			//echo "<pre>"; print_r($data);			
			return $data; 
			 }
      }
	   
}
?>

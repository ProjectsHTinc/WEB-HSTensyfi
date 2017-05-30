<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apimodel extends CI_Model {

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


//#################### Login ####################//

	public function mainLogin($username,$password)
	{
		$year_id = $this->getYear();

 		$sql = "SELECT * FROM edu_users A, edu_role B  WHERE A.user_type = B.role_id AND A.user_name ='".$username."' and A.user_password = md5('".$password."') and A.status='A'";
		$user_result = $this->db->query($sql);
		$ress= $user_result->result();
		
		if($user_result->num_rows()==1)
		{
			foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->user_id;
				  $login_count = $rows->login_count+1;
				  $user_type = $rows->user_type;
				  $update_sql = "UPDATE edu_users SET last_login_date=NOW(),login_count='$login_count' WHERE user_id='$user_id'";
				  $update_result = $this->db->query($update_sql);
			}
					
				  if ($user_type==1)  {
				  
				 	 	$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $ress);
						return $response;
				  } 
				  else if ($user_type==2) {
				  
						$teacher_id = $rows->teacher_id;
						
						$teacher_query = "SELECT t.teacher_id,t.name,t.sex,t.age,t.nationality,t.religion,t.community_class,t.community,t.address,
						t.email,t.phone,t.sec_email,t.sec_phone,t.profile_pic,t.update_at,t.class_name AS lclass,t.class_teacher,ss.sec_name,c.class_name FROM edu_teachers AS t INNER JOIN edu_classmaster AS cm ON t.class_teacher=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE t.teacher_id='$teacher_id'";
						$teacher_res = $this->db->query($teacher_query);
						$teacher_profile= $teacher_res->result();

							foreach($teacher_profile as $rows){ 
								$class_teacher = $rows->lclass;
							}
						
						$timetable_query = "SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period,ss.sec_name,c.class_name
						FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id
						INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE tt.class_id IN ($class_teacher) AND tt.teacher_id ='$teacher_id' AND tt.year_id='$year_id'";
						$timetable_res = $this->db->query($timetable_query);
	
						 if($timetable_res->num_rows()==0){
							 $timetable_result = array("status" => "timetable", "msg" => "TimeTable not found");
						
						}else{
							$timetable_result= $timetable_res->result();
						}  
						
						$stud_query = "SELECT A.enroll_id,A.admission_id,A.class_id,A.name,C.class_name,D.sec_name from edu_enrollment A, edu_classmaster B, edu_class C, edu_sections D WHERE A.class_id = B.class_sec_id AND B.class = C.class_id AND B.section = D.sec_id AND A.admit_year ='$year_id' AND A.class_id IN ($class_teacher)";
						$stud_res = $this->db->query($stud_query);
	
						 if($stud_res->num_rows()==0){
							 $stud_result = array("status" => "studDetails", "msg" => "Student not found");
						
						}else{
							$stud_result= $stud_res->result();
						}  
							
						$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $ress,"teacherProfile" =>$teacher_profile,"timeTable"=>$timetable_result,"studDetails"=>$stud_result);
						
						return $response;
				  }
				  else if ($user_type==3) {
				  		
						$student_id = $rows->student_id;
						
						$student_query = "SELECT * from edu_admission WHERE admission_id='$student_id' AND status = 'A'";
						$student_res = $this->db->query($student_query);
						$student_profile= $student_res->result();

							foreach($student_profile as $rows){ 
								$admisson_no = $rows->admisn_no;
							}
						
						 $enroll_query = "SELECT A.enroll_id,A.admission_id,A.admisn_no,A.class_id,A.name,C.class_name,D.sec_name from edu_enrollment A, edu_classmaster B, edu_class C, edu_sections D WHERE A.class_id = B.class_sec_id AND B.class = C.class_id AND B.section = D.sec_id AND A.admit_year ='$year_id' AND A.admisn_no = '$admisson_no'";
						$enroll_res = $this->db->query($enroll_query);
						$stu_enroll_res= $enroll_res->result();
						
						
				  		$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $ress,"studentProfile" =>$student_profile,"enrollDetails"=>$stu_enroll_res);
						return $response;
				  }
				  else {
				  		 $parent_id = $rows->parent_id;

						 $parent_query = "SELECT * from edu_parents WHERE parent_id='$parent_id' AND status = 'A'";
						$parent_res = $this->db->query($parent_query);
						$parent_profile= $parent_res->result();

							foreach($parent_profile as $rows){ 
								$admisson_id = $rows->admission_id;
							}
						
						$enroll_query = "SELECT A.enroll_id,A.admission_id,A.admisn_no,A.class_id,A.name,C.class_name,D.sec_name from edu_enrollment A, edu_classmaster B, edu_class C, edu_sections D WHERE A.class_id = B.class_sec_id AND B.class = C.class_id AND B.section = D.sec_id AND A.admit_year ='$year_id' AND A.admission_id IN ($admisson_id)";
						$enroll_res = $this->db->query($enroll_query);
						$stu_enroll_res= $enroll_res->result();
						
							foreach($stu_enroll_res as $rows){ 
								$class_id = $rows->class_id;
							}
					
						
				  		$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $ress,"parentProfile" =>$parent_profile,"enrollDetails"=>$stu_enroll_res);
						return $response;
				  }

			} else {
			 			$response = array("status" => "error", "msg" => "Invalid login");
						return $response;
			 }
	}
	
//#################### Main Login End ####################//


//#################### Forgot Password ####################//
	public function forgotPassword($user_name)
	{
			$year_id = $this->getYear();
			$digits = 6;
			$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);


			$user_query = "SELECT * FROM edu_users WHERE user_name ='".$user_name."' and status='A'";
			$user_res = $this->db->query($user_query);
			$user_result= $user_res->result();


			if($user_res->num_rows()==1)
			{
				foreach ($user_res->result() as $rows)
				{
				  $user_id = $rows->user_id;
				  $user_type = $rows->user_type;
				  $name = $rows->name;
				}
				
				if ($user_type==1)  {
					$response = array("status" => "sucess", "msg" => "Please contact server Admin");
				} 
				else if ($user_type==2) {
				
						$teacher_id = $rows->teacher_id;
						
						$teacher_query = "SELECT * from edu_teachers WHERE teacher_id ='$teacher_id' AND status = 'A'";
						$teacher_res = $this->db->query($teacher_query);
						$teacher_profile= $teacher_res->result();

							foreach($teacher_profile as $rows){ 
								$email = $rows->email;
							}

						$update_sql = "UPDATE edu_users SET user_password = md5('$OTP'),updated_date=NOW(),password_status='0' WHERE user_id='$user_id'";
						$update_result = $this->db->query($update_sql);

						$subject = "Forgot Password";
						$htmlContent = 'Dear '. $name . '<br><br>' . 'Username : '. $user_name .'<br>' . 'Password : '. $OTP.'<br><br>Regards<br>Webmaster';
						$this->sendMail($email,$subject,$htmlContent);

						$response = array("status" => "sucess", "msg" => "Password Updated", "Email" => $email);
				}
				else if ($user_type==3) {
				
						$student_id = $rows->student_id;
						
						$student_query = "SELECT * from edu_admission WHERE admission_id='$student_id' AND status = 'A'";
						$student_res = $this->db->query($student_query);
						$student_profile= $student_res->result();

							foreach($student_profile as $rows){ 
								$email = $rows->email;
							}
							
						$update_sql = "UPDATE edu_users SET user_password = md5('$OTP'),updated_date=NOW(),password_status='0' WHERE user_id='$user_id'";
						$update_result = $this->db->query($update_sql);

						$subject = "Forgot Password";
						$htmlContent = 'Dear '. $name . '<br><br>' . 'Username : '. $user_name .'<br>' . 'Password : '. $OTP.'<br><br>Regards<br>Webmaster';
						$this->sendMail($email,$subject,$htmlContent);
						
						$response = array("status" => "sucess", "msg" => "Password Updated", "Email" => $email);
				}
				else {
				
						$parent_id = $rows->parent_id;

						$parent_query = "SELECT * from edu_parents WHERE parent_id='$parent_id' AND status = 'A'";
						$parent_res = $this->db->query($parent_query);
						$parent_profile= $parent_res->result();

							foreach($parent_profile as $rows){ 
								$email = $rows->email;
							}
							
							
						$update_sql = "UPDATE edu_users SET user_password = md5('$OTP'),updated_date=NOW(),password_status='0' WHERE user_id='$user_id'";
						$update_result = $this->db->query($update_sql);

						$subject = "Forgot Password";
						$htmlContent = 'Dear '. $name . '<br><br>' . 'Username : '. $user_name .'<br>' . 'Password : '. $OTP.'<br><br>Regards<br>Webmaster';
						$this->sendMail($email,$subject,$htmlContent);
						
						$response = array("status" => "sucess", "msg" => "Password Updated", "Email" => $email);
				}
				
			} else {
				$response = array("status" => "error", "msg" => "User Not Found");
			}
			return $response;
	}
//#################### Forgot Password End ####################//


//#################### Reset Password ####################//
	public function resetPassword($user_id,$password)
	{
			$update_sql = "UPDATE edu_users SET user_password = md5('$password'),updated_date=NOW(),password_status='1' WHERE user_id='$user_id'";
			$update_result = $this->db->query($update_sql);

			$response = array("status" => "sucess", "msg" => "Password Updated");
			return $response;
	}
//#################### Reset Password End ####################//

//#################### Change Password ####################//
	public function changePassword($user_id,$old_password,$password)
	{
			$user_query = "SELECT * FROM edu_users WHERE user_id ='$user_id' and user_password= md5('$old_password') and status='A'";
			$user_res = $this->db->query($user_query);
			$user_result= $user_res->result();

			if($user_res->num_rows()==1)
			{
				$update_sql = "UPDATE edu_users SET user_password = md5('$password'),updated_date=NOW() WHERE user_id='$user_id'";
				$update_result = $this->db->query($update_sql);
				
                $response = array("status" => "sucess", "msg" => "Password Updated");
			} else {
				$response = array("status" => "error", "msg" => "Entered Current Password is wrong.");
			}
			
			return $response;		
	}
//#################### Change Password End ####################//

//#################### Time table for Students and Parents ####################//
	public function studTimetable($class_id)
	{
			$year_id = $this->getYear();
		
			$timetable_query = "SELECT tt.table_id,tt.class_id,tt.subject_id,COALESCE(s.subject_name, '') as subject_name,tt.teacher_id,tt.day,tt.period,ss.sec_name,c.class_name
			FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE tt.class_id = '$class_id' AND tt.year_id='$year_id' ORDER BY tt.table_id";
			$timetable_res = $this->db->query($timetable_query);
			$timetable_result= $timetable_res->result();
			
			 if($timetable_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Timetable Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Timetable", "timeTable"=>$timetable_result);
			} 
			
			return $response;		
	}
//#################### Time table End ####################//


//#################### Exams for Students and Parents ####################//
	public function dispExams($class_id)
	{
			$year_id = $this->getYear();
			
			$exam_query = "SELECT ex.exam_id,ex.exam_name, COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate, COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
			CASE WHEN ems.status='A' THEN 1 ELSE 0 END AS MarkStatus
			FROM edu_examination ex
			RIGHT JOIN edu_exam_details ed on ex.exam_id = ed.exam_id and ed.classmaster_id='$class_id'
			LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id
			WHERE ex.exam_year ='$year_id' and ex.status = 'A' and ed.classmaster_id='$class_id'
			GROUP by ex.exam_name
			
			UNION ALL
			
			SELECT ex.exam_id,ex.exam_name, COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate,
			COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
			CASE WHEN ems.status='A' THEN 1 ELSE 0 END AS MarkStatus
			FROM edu_examination ex
			LEFT JOIN edu_exam_details ed on ed.exam_id = ex.exam_id and ed.classmaster_id='$class_id'
			LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id
			WHERE ex.exam_year ='$year_id' and ex.status = 'A' and ex.exam_id NOT IN (SELECT DISTINCT exam_id FROM edu_exam_details where
			classmaster_id = '$class_id')
			GROUP by ex.exam_name";

			$exam_res = $this->db->query($exam_query);
			$exam_result= $exam_res->result();
			$exam_count = $exam_res->num_rows();
			
			 if($exam_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Exams Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Exams", "Exams"=>$exam_result);
			} 
			
			return $response;		
	}
//#################### Exams End ####################//


//#################### Exam Details for Students and Parents ####################//
	public function dispExamdetails($class_id,$exam_id)
	{
			 $year_id = $this->getYear();
		
			$exam_query = "SELECT A.exam_id,A.exam_name,C.subject_name,B.exam_date, B.times FROM `edu_examination` A, `edu_exam_details` B, `edu_subject` C WHERE A.`exam_id` = B. exam_id AND B.subject_id = C.subject_id AND B.classmaster_id ='$class_id' AND B.exam_id='$exam_id'";
			$exam_res = $this->db->query($exam_query);
			$exam_result= $exam_res->result();
			$exam_result_count = $exam_res->num_rows();

			if($exam_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Exams Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Exam Details", "count"=>$exam_result_count,"examDetails"=>$exam_result);
			} 
			
			return $response;		
	}
//#################### Exam Details End ####################//


//#################### Mark Details for Students and Parents ####################//
	public function dispMarkdetails($stud_id,$exam_id)
	{
			$year_id = $this->getYear();
	
			$mark_query = "SELECT C.exam_name,B.subject_name,A.marks FROM `edu_exam_marks` A, `edu_subject` B, `edu_examination`C WHERE A.`exam_id` ='$exam_id' AND A.`stu_id` = '$stud_id' AND A.subject_id=B.subject_id AND A.exam_id = C.exam_id";
			$mark_res = $this->db->query($mark_query);
			$mark_result= $mark_res->result();
			
			$total_marks = 0;
			foreach($mark_result as $rows){ 
				$exam_marks = $rows->marks;
				$total_marks = 	$total_marks + $exam_marks;
			}
			
			 if($mark_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Marks Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Marks Details", "marksDetails"=>$mark_result, "totalMarks"=>$total_marks);
			} 

			return $response;		
	}
//#################### Mark Details End ####################//

//#################### Homework for Students and Parents ####################//
	public function dispHomework($class_id,$hw_type)
	{
			$year_id = $this->getYear();
			
			$hw_query = "SELECT A.hw_id,A.hw_type,A.title, A.test_date, A.hw_details, A.mark_status, B.subject_name FROM `edu_homework` A, `edu_subject` B WHERE A.subject_id = B.subject_id AND A.class_id ='$class_id' AND A.year_id='$year_id' AND A.status = 'A' AND A.hw_type = '$hw_type'";
			$hw_res = $this->db->query($hw_query);
			$hw_result= $hw_res->result();
			$hw_count = $hw_res->num_rows();
			
			 if($hw_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Homework Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Homework Details", "count"=>$hw_count, "homeworkDetails"=>$hw_result);
			} 

			return $response;		
	}
//#################### Homework Details End ####################//


//#################### Homework test marks for Students and Parents ####################//
	public function dispCtestmarks($hw_id,$entroll_id)
	{
			$year_id = $this->getYear();
			
			$hw_query = "SELECT * FROM `edu_class_marks` WHERE hw_mas_id = '$hw_id' AND enroll_mas_id ='$entroll_id'";
		
			$hw_res = $this->db->query($hw_query);
			$hw_result= $hw_res->result();
			
			 if($hw_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Homework Test Marks Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Class Test", "ctestmarkDetails"=>$hw_result);
			} 

			return $response;		
	}
//#################### Homework test marks  End ####################//


//#################### Events for Students and Parents ####################//
	public function dispEvents($class_id)
	{
			$year_id = $this->getYear();
			
		 	$event_query = "SELECT event_id,year_id,event_name,event_details,status,DATE_FORMAT(event_date,'%d-%m-%Y') as event_date,sub_event_status FROM `edu_events` WHERE year_id='$year_id' AND status='A'";
			$event_res = $this->db->query($event_query);
			$event_result= $event_res->result();
			$event_count = $event_res->num_rows();
/*
			foreach($event_result as $rows){ 
				$event_id = $rows->event_id;
                    
					$gallery_query = "SELECT * FROM `edu_events_galllery` WHERE event_id ='$event_id'";
					$gallery_res = $this->db->query($gallery_query);
					$gallery_result= $gallery_res->result();
					
					if($gallery_res->num_rows()!=0){
						//echo $gallery_result;
					}
			}
*/			
			 if($event_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Events Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Events", "count" => $event_count, "eventDetails"=>$event_result);
			} 

			return $response;		
	}
//#################### Events Details End ####################//


//#################### Events for Students and Parents ####################//
	public function dispsubEvents ($event_id)
	{
			$year_id = $this->getYear();
			
			$subevent_query = "SELECT A.sub_event_name,B.name  from edu_event_coordinator A, edu_teachers B WHERE A.event_id = '$event_id' AND A.co_name_id = B.teacher_id AND A.status='A'";
		
			$subevent_res = $this->db->query($subevent_query);
			$subevent_result= $subevent_res->result();
			
			 if($subevent_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Sub Events Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Sub Events", "subeventDetails"=>$subevent_result);
			} 

			return $response;		
	}
//#################### Event Details End ####################//


//#################### Communication for Students and Parents ####################//
	public function dispParentCommunication ($class_id)
	{
			$year_id = $this->getYear();
			
			$comm_query = "SELECT commu_title,commu_details,commu_date FROM `edu_communication` WHERE find_in_set('$class_id', `class_id`)";
		
			$comm_res = $this->db->query($comm_query);
			$comm_result= $comm_res->result();
			$comm_count = $comm_res->num_rows();
			
			 if($comm_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Communication Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Communication", "count"=>$comm_count, "communicationDetails"=>$comm_result);
			} 

			return $response;		
	}
	
//#################### Communication End ####################//

//#################### Communication for Students and Parents ####################//
	public function dispAttendence ($class_id,$stud_id)
	{
			$year_id = $this->getYear();
			
			$attend_query = "SELECT A.at_id,B.student_id,B.abs_date,B.a_status,B.attend_period FROM edu_attendence A, edu_attendance_history B WHERE A.ac_year='$year_id' AND B.class_id='$class_id' AND B.student_id='$stud_id' AND B.attend_id = A.at_id";
			$attend_res = $this->db->query($attend_query);
			$attend_result= $attend_res->result();
			$attend_count = $attend_res->num_rows();
			
			 if($attend_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "No Records Found");
			}else{
				$response = array("status" => "success", "msg" => "View Attendence", "count"=>$attend_count, "attendenceDetails"=>$attend_result);
			} 

			return $response;		
	}
	
//#################### Communication End ####################//
}

?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apimainmodel extends CI_Model {

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
		$sqlYear = "SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'Active'";
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

	public function Login($username,$password)
	{
		$year_id = $this->getYear();

 		$sql = "SELECT * FROM edu_users A, edu_role B  WHERE A.user_type = B.role_id AND A.user_name ='".$username."' and A.user_password = md5('".$password."') and A.status='Active'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		
		if($user_result->num_rows()>0)
		{
			foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->user_id;
				  $login_count = $rows->login_count+1;
				  $user_type = $rows->user_type;
				  $update_sql = "UPDATE edu_users SET last_login_date=NOW(),login_count='$login_count' WHERE user_id='$user_id'";
				  $update_result = $this->db->query($update_sql);
			}
					
				$userData  = array(
							"user_id" => $ress[0]->user_id,
							"name" => $ress[0]->name,
							"user_name" => $ress[0]->user_name,
							"user_pic" => $ress[0]->user_pic,
							"user_type" => $ress[0]->user_type,
							"user_type_name" => $ress[0]->user_type_name,
							"password_status" => $ress[0]->password_status
						);


				  if ($user_type==1)  {
				  
				 	 	$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $userData, "year_id" => $year_id);
						return $response;
				  } 
				  else if ($user_type==2) {
				  
						$teacher_id = $rows->teacher_id;
						
						$sqlYear = "SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'Active'";
                		$year_result = $this->db->query($sqlYear);
                		$ress_year = $year_result->result();
                		
                		if($year_result->num_rows()==1)
                		{
                			foreach ($year_result->result() as $rows)
                			{
                			    $from_month = $rows->from_month;
                			    $to_month  = $rows->to_month ;
                			}
                		}

                        $start    = new DateTime($from_month);
                        $start->modify('first day of this month');
                        $end      = new DateTime($to_month);
                        $end->modify('first day of next month');
                        $interval = DateInterval::createFromDateString('1 month');
                        $period   = new DatePeriod($start, $interval, $end);
                        
                        $month = array();
                        foreach($period as $dt) {
                         $month[] = $dt->format("m-Y");
                        }
                        
                        $teacher_query = "SELECT t.teacher_id,t.name,t.sex,t.age,t.nationality,t.religion,t.community_class, t.community,t.address,t.email,t.phone,t.sec_email,t.sec_phone,t.profile_pic,t.update_at,t.subject,t.class_name AS class_taken,t.class_teacher FROM edu_teachers AS t WHERE t.teacher_id = '$teacher_id'";
						$teacher_res = $this->db->query($teacher_query);
						$teacher_profile = $teacher_res->result();

							foreach($teacher_profile as $rows){ 
								$class_teacher = $rows->class_taken;
								$subject_id = $rows->subject;
							}
							
						$class_sub_query = "SELECT
											class_master_id,
											teacher_id,
											class_name,
											sec_name,
											subject_name,A.subject_id  
										FROM
											edu_teacher_handling_subject A,
											edu_classmaster B,
											edu_subject C,
											edu_class D,
											edu_sections E
										WHERE
											A.class_master_id = B.class_sec_id AND B.class = D.class_id AND B.section = E.sec_id AND A.subject_id = C.subject_id AND A.teacher_id = '$teacher_id' ORDER by class_master_id";
						$class_sub_res = $this->db->query($class_sub_query);

						 if($class_sub_res->num_rows()==0){
							 $class_sub_result = array("status" => "error", "msg" => "Class and Section not found");
						
						}else{
							$class_sub_result = $class_sub_res->result();
						}  



						$timetable_query = "SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period,ss.sec_name,c.class_name FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE tt.teacher_id ='$teacher_id' AND tt.year_id='$year_id' ORDER BY tt.day, tt.period";
						$timetable_res = $this->db->query($timetable_query);
	
						 if($timetable_res->num_rows()==0){
							 $timetable_result = array("status" => "error", "msg" => "TimeTable not found");
						
						}else{
							$timetable_result= $timetable_res->result();
						}  
						
						$stud_query = "SELECT
                                        A.enroll_id,
                                        A.admission_id,
                                        A.class_id,
                                        A.name,
                                        CONCAT(C.class_name, ' ', D.sec_name) AS class_section
                                    FROM
                                        edu_enrollment A,
                                        edu_classmaster B,
                                        edu_class C,
                                        edu_sections D
                                    WHERE
                                        A.class_id = B.class_sec_id AND B.class = C.class_id AND B.section = D.sec_id AND A.admit_year = '$year_id' AND A.class_id IN(SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id') ORDER BY A.class_id";

						$stud_res = $this->db->query($stud_query);
	
						 if($stud_res->num_rows()==0){
							 $stud_result = array("status" => "error", "msg" => "Student not found");
						
						}else{
							$stud_result= $stud_res->result();
						} 
											
					 $exam_query = "SELECT ex.exam_id,ex.exam_name, ed.classmaster_id, ss.sec_name,c.class_name,COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate,
						COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
						CASE WHEN ems.status='Publish' THEN 1 ELSE 0 END AS MarkStatus
						FROM edu_examination ex
						RIGHT JOIN edu_exam_details ed on ex.exam_id = ed.exam_id and ed.classmaster_id in (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id')
						LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id
						INNER JOIN edu_classmaster AS cm ON ed.classmaster_id = cm.class_sec_id
						INNER JOIN edu_class AS c ON cm.class=c.class_id 
						INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id
						WHERE ex.exam_year ='$year_id' and ex.status = 'Active' and ed.classmaster_id in (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id')
						GROUP by ed.classmaster_id, ems.exam_id
						
						UNION ALL
						
						SELECT ex.exam_id,ex.exam_name, ed.classmaster_id, ss.sec_name,c.class_name, COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate,
						COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
						CASE WHEN ems.status='Publish' THEN 1 ELSE 0 END AS MarkStatus
						FROM edu_examination ex
						LEFT JOIN edu_exam_details ed on ed.exam_id = ex.exam_id and ed.classmaster_id in (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id')
						LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id 
						INNER JOIN edu_classmaster AS cm ON ed.classmaster_id = cm.class_sec_id
						INNER JOIN edu_class AS c ON cm.class=c.class_id 
						INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id
						WHERE ex.exam_year ='$year_id' and ex.status = 'Active' and ex.exam_id NOT IN (SELECT DISTINCT exam_id FROM edu_exam_details where classmaster_id in (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id')) GROUP by ed.classmaster_id,ems.exam_id";
					
						$exam_res = $this->db->query($exam_query);
	
						 if($exam_res->num_rows()==0){
							 $exam_result = array("status" => "error", "msg" => "Exams not found");
						
						}else{
							$exam_result= $exam_res->result();
						} 
						
						$examdetail_query = "SELECT A.exam_id,A.exam_name,C.subject_name,B.exam_date, B.times,B.classmaster_id, E.class_name, F.sec_name FROM 
							`edu_examination` A, `edu_exam_details` B, `edu_subject` C, `edu_classmaster` D, `edu_class` E, `edu_sections` F WHERE 
							A.`exam_id` = B. exam_id AND B.subject_id = C.subject_id AND 
							B.classmaster_id=D.class_sec_id AND D.class = E.class_id AND 
							D.section = F.sec_id AND B.classmaster_id in (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id')";
							$examdetail_res = $this->db->query($examdetail_query);
	
						 if($examdetail_res->num_rows()==0){
							 $examdetail_result = array("status" => "error", "msg" => "Exams not found");
						
						}else{
							$examdetail_result= $examdetail_res->result();
						}  
						
						$hw_query = "SELECT A.hw_id, A.hw_type, A.title, A.test_date, A.due_date, A.class_id, A.hw_details, A.mark_status, A.subject_id,B.subject_name, D.class_name, E.sec_name FROM 
                            `edu_homework` A, `edu_subject` B, `edu_classmaster` C, `edu_class` D, `edu_sections` E WHERE 
                            A.subject_id = B.subject_id AND A.year_id ='$year_id' AND 
                            A.subject_id IN (SELECT DISTINCT subject_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id') AND A.class_id IN (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id') AND 
                            A.class_id = C. class_sec_id AND C.class = D.class_id AND
                            C.section = E.sec_id AND A.status = 'Active'";
							$hw_res = $this->db->query($hw_query);
	
						 if($hw_res->num_rows()==0){
							 $hw_result = array("status" => "error", "msg" => "Homeworks not found");
						
						}else{
							$hw_result= $hw_res->result();
						}  
						
						$reminder_query = "SELECT * from edu_reminder WHERE user_id  ='$user_id'";
						$reminder_res = $this->db->query($reminder_query);
	
						 if($reminder_res->num_rows()==0){
							 $reminder_result = array("status" => "error", "msg" => "Reminders not found");
						
						}else{
							$reminder_result= $reminder_res->result();
						}  
						
						$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $userData,"teacherProfile" =>$teacher_profile,"classSubject"=>$class_sub_result,"timeTable"=>$timetable_result,"studDetails"=>$stud_result,"Exams"=>$exam_result,"examDetails"=>$examdetail_result,"homeWork"=>$hw_result,"Reminders"=>$reminder_result, "year_id" => $year_id, "academic_month" => $month);
						return $response;
				  }
				  else if ($user_type==3) {
				  		
						$student_id = $rows->student_id;
						
						$student_query = "SELECT * from edu_admission WHERE admission_id='$student_id' AND status = 'Active'";
						$student_res = $this->db->query($student_query);
						$student_profile= $student_res->result();

							foreach($student_profile as $rows){ 
								$admit_id = $rows->admission_id;
								$parent_id = $rows->parnt_guardn_id;
							}
						
						$father_query = "SELECT * from edu_parents WHERE parent_id='$parent_id' AND status = 'Active'";
						$father_res = $this->db->query($father_query);
						$father_profile = $father_res->result();

						foreach($father_profile as $rows){ 
								$admisson_id = $rows->admission_id;
						}

						$fatherProfile  = array(
							"id" => $father_profile[0]->parent_id,
							"name" => $father_profile[0]->father_name,
							"occupation" => $father_profile[0]->occupation,
							"income" => $father_profile[0]->income,
							"home_address" => $father_profile[0]->address,
							"email" => $father_profile[0]->email,
							"mobile" => $father_profile[0]->mobile,
							"home_phone" => $father_profile[0]->home_phone,
							"office_phone" => $father_profile[0]->office_phone,
							"relationship" => "",
							"user_pic" => $father_profile[0]->father_pic
						);
						
						$mother_query = "SELECT * from edu_parents WHERE parent_id='$parent_id' AND status = 'Active'";
						$mother_res = $this->db->query($mother_query);
						$mother_profile = $mother_res->result();

						foreach($mother_profile as $rows){ 
								$admisson_id = $rows->admission_id;
						}

						$motherProfile  = array(
							"id" => $mother_profile[0]->parent_id,
							"name" => $mother_profile[0]->mother_name,
							"occupation" => "",
							"income" => "",
							"home_address" => "",
							"email" => "",
							"mobile" => "",
							"home_phone" => "",
							"office_phone" => "",
							"relationship" => "",
							"user_pic" => $father_profile[0]->mother_pic
						);
						
						$guardian_query = "SELECT * from edu_parents WHERE parent_id='$parent_id' AND status = 'Active'";
						$guardian_res = $this->db->query($guardian_query);
						$guardian_profile = $guardian_res->result();

						foreach($guardian_profile as $rows){ 
								$admisson_id = $rows->admission_id;
						}

						$guardianProfile  = array(
							"id" => $guardian_profile[0]->parent_id,
							"name" => $guardian_profile[0]->guardn_name,
							"occupation" => "",
							"income" => "",
							"home_address" => "",
							"email" => "",
							"mobile" => "",
							"home_phone" => "",
							"office_phone" => "",
							"relationship" => "",
							"user_pic" => $guardian_profile[0]->guardn_pic 
						);
						
						
						 $enroll_query = "SELECT A.enroll_id AS registered_id,A.admission_id,A.admisn_no AS admission_no,A.class_id,A.name,C.class_name,D.sec_name 
						from edu_enrollment A, edu_classmaster B, edu_class C, edu_sections D WHERE A.class_id = B.class_sec_id AND 
						B.class = C.class_id AND B.section = D.sec_id AND A.admit_year ='$year_id' AND A.admission_id = '$admit_id'";
						$enroll_res = $this->db->query($enroll_query);
						$stu_enroll_res= $enroll_res->result();
						
						$parentProfile = array("fatherProfile" =>$fatherProfile,"motherProfile" =>$motherProfile,"guardianProfile" =>$guardianProfile);
						
				  		$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $userData,"studentProfile" =>$student_profile,"parentProfile" =>$parentProfile,"registeredDetails"=>$stu_enroll_res, "year_id" => $year_id);
						return $response;
				  }
				  else {
				  		 $parent_id = $rows->parent_id;

						$father_query = "SELECT * from edu_parents WHERE parent_id='$parent_id' AND status = 'Active'";
						$father_res = $this->db->query($father_query);
						$father_profile = $father_res->result();

						foreach($father_profile as $rows){ 
								$admisson_id = $rows->admission_id;
						}

						$fatherProfile  = array(
							"id" => $father_profile[0]->parent_id,
							"name" => $father_profile[0]->father_name,
							"occupation" => $father_profile[0]->occupation,
							"income" => $father_profile[0]->income,
							"home_address" => $father_profile[0]->address,
							"email" => $father_profile[0]->email,
							"mobile" => $father_profile[0]->mobile,
							"home_phone" => $father_profile[0]->home_phone,
							"office_phone" => $father_profile[0]->office_phone,
							"relationship" => "",
							"user_pic" => $father_profile[0]->father_pic
						);
						
						$mother_query = "SELECT * from edu_parents WHERE parent_id='$parent_id' AND status = 'Active'";
						$mother_res = $this->db->query($mother_query);
						$mother_profile = $mother_res->result();

						foreach($mother_profile as $rows){ 
								$admisson_id = $rows->admission_id;
						}

						$motherProfile  = array(
							"id" => $mother_profile[0]->parent_id,
							"name" => $mother_profile[0]->mother_name,
							"occupation" => "",
							"income" => "",
							"home_address" => "",
							"email" => "",
							"mobile" => "",
							"home_phone" => "",
							"office_phone" => "",
							"relationship" => "",
							"user_pic" => $father_profile[0]->mother_pic
						);
						
						$guardian_query = "SELECT * from edu_parents WHERE parent_id='$parent_id' AND status = 'Active'";
						$guardian_res = $this->db->query($guardian_query);
						$guardian_profile = $guardian_res->result();

						foreach($guardian_profile as $rows){ 
								$admisson_id = $rows->admission_id;
						}

						$guardianProfile  = array(
							"id" => $guardian_profile[0]->parent_id,
							"name" => $guardian_profile[0]->guardn_name,
							"occupation" => "",
							"income" => "",
							"home_address" => "",
							"email" => "",
							"mobile" => "",
							"home_phone" => "",
							"office_phone" => "",
							"relationship" => "",
							"user_pic" => $guardian_profile[0]->guardn_pic 
						);						
						$parentProfile = array("fatherProfile" =>$fatherProfile,"motherProfile" =>$motherProfile,"guardianProfile" =>$guardianProfile);

						$enroll_query = "SELECT A.enroll_id AS registered_id,A.admission_id,A.admisn_no AS admission_no,A.class_id,A.name,C.class_name,D.sec_name from edu_enrollment A, edu_classmaster B, edu_class C, edu_sections D WHERE A.class_id = B.class_sec_id AND B.class = C.class_id AND B.section = D.sec_id AND A.admit_year ='$year_id' AND A.admission_id IN ($admisson_id)";
						$enroll_res = $this->db->query($enroll_query);
						$stu_enroll_res= $enroll_res->result();
				  		
				  		$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $userData,"parentProfile" =>$parentProfile,"registeredDetails"=>$stu_enroll_res, "year_id" => $year_id);
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


			$user_query = "SELECT * FROM edu_users WHERE user_name ='".$user_name."' and status='Active'";
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
						
						$teacher_query = "SELECT * from edu_teachers WHERE teacher_id ='$teacher_id' AND status = 'Active'";
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
						
						$student_query = "SELECT * from edu_admission WHERE admission_id='$student_id' AND status = 'Active'";
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

						$parent_query = "SELECT * from edu_parents WHERE parent_id='$parent_id' AND status = 'Active'";
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


//#################### Profile Pic Update ####################//
	public function updateProfilepic($user_id,$user_type,$userFileName)
	{
            $update_sql= "UPDATE edu_users SET user_pic='$userFileName', updated_date=NOW() WHERE user_id='$user_id' ";
			$update_result = $this->db->query($update_sql);
	
			$response = array("status" => "sucess", "msg" => "Profile Picture Updated");
			return $response;
	}
//#################### Profile Pic Update End ####################//


//#################### Change Password ####################//
	public function changePassword($user_id,$old_password,$password)
	{
			$user_query = "SELECT * FROM edu_users WHERE user_id ='$user_id' and user_password= md5('$old_password') and status='Active'";
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


//#################### Events for Students and Parents ####################//
	public function dispEvents($class_id)
	{
			$year_id = $this->getYear();
			
		 	$event_query = "SELECT event_id,year_id,event_name,event_details,status,DATE_FORMAT(event_date,'%d-%m-%Y') as event_date,sub_event_status FROM `edu_events` WHERE year_id='$year_id' AND status='Active'";
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
			
			$subevent_query = "SELECT A.sub_event_name,B.name  from edu_event_coordinator A, edu_teachers B WHERE A.event_id = '$event_id' AND A.co_name_id = B.teacher_id AND A.status='Active'";
		
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


//#################### Circular for All ####################//
	public function dispCircular($user_id)
	{
	  
			$year_id = $this->getYear();

			 $circular_query = "SELECT
                                B.circular_type,
                                B.circular_title,
                                B.circular_description,
                                A.circular_date
                            FROM
                                edu_circular A,
                                edu_circular_master B
                            WHERE
                                A.user_id = '$user_id' AND B.academic_year_id = '$year_id' AND A.circular_master_id = B.id AND A.status = 'Active'";
		
			$circular_res = $this->db->query($circular_query);
			$circular_result= $circular_res->result();
			
			 if($circular_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Circular Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Circular", "circularDetails"=>$circular_result);
			} 
            //print_r($response);exit;
			return $response;		
	}
//#################### Circular End ####################//

//#################### Add Onduty ####################//
	public function addOnduty ($user_type,$user_id,$od_for,$from_date,$to_date,$notes,$status,$created_by,$created_at)
	{
			$year_id = $this->getYear();
			
		    $onduty_query = "INSERT INTO `edu_on_duty`( `user_type`, `user_id`, `year_id`, `od_for`, `from_date`, `to_date`, `notes`, `status`, `created_by`, `created_at`) VALUES ('$user_type','$user_id','$year_id','$od_for','$from_date','$to_date','$notes','$status','$created_by','$created_at')";
	        $onduty_res = $this->db->query($onduty_query);
	        
			if($onduty_res) {
			    $response = array("status" => "success", "msg" => "Onduty Added");
			} else {
			    $response = array("status" => "error");
			}
			return $response;		
	}
//#################### Onduty End ####################//

//#################### Onduty for All ####################//
	public function dispOnduty ($user_type,$user_id)
	{
			$year_id = $this->getYear();

            if ($user_type=='4')
            {
                
                 $user_sql = "SELECT *  FROM `edu_users` WHERE student_id = '$user_id'";
                $user_result = $this->db->query($user_sql);
        		$user_ress = $user_result->result();
        		
        		if($user_result->num_rows()>0)
        		{
        			foreach ($user_result->result() as $rows)
        			{
        				  $user_id = $rows->user_id;
        			}
        		}
        		$user_type = '3';
        		 $Onduty_query = "SELECT od_for,from_date,to_date,notes,status FROM `edu_on_duty` WHERE user_type = '$user_type' AND user_id = '$user_id' AND year_id = '$year_id'";
            } else {
			    $Onduty_query = "SELECT od_for,from_date,to_date,notes,status FROM `edu_on_duty` WHERE user_type = '$user_type' AND user_id = '$user_id' AND year_id = '$year_id'";
            }
		
			$Onduty_res = $this->db->query($Onduty_query);
			$Onduty_result = $Onduty_res->result();
			
			 if($Onduty_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Onduty Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Onduty", "ondutyDetails"=>$Onduty_result);
			} 

			return $response;		
	}
//#################### Onduty End ####################//
}

?>
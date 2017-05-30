<?php

Class Enrollmentmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//CREATE ADMISSION   ad_enrollment

        function ad_enrollment($admission_id,$admit_year,$formatted_date,$admisn_no,$name,$class,$status){
          $check_email="SELECT * FROM edu_enrollment WHERE admisn_no='$admisn_no'";
          $result=$this->db->query($check_email);
          if($result->num_rows()==0){
			  
			  $digits = 6;
		      $OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		
			  $admisn="select name,admission_id from edu_admission WHERE admisn_no='".$admisn_no."'";
     	      $resultset = $this->db->query($admisn);
		      foreach ($resultset->result() as $rows)
		      {}
		        $admisnid=$rows->admission_id;
				//echo $admisnid;
            $query="INSERT INTO edu_enrollment (admission_id,admit_year,admit_date,admisn_no,name,class_id,created_at,status) VALUES ('$admisnid','$admit_year','$formatted_date','$admisn_no','$name','$class',NOW(),'$status')";
            $resultset=$this->db->query($query);

            //Student User Creation
             $sql="SELECT count(*) AS student FROM edu_admission" ;
             $resultsql=$this->db->query($sql);
             $result1= $resultsql->result();
             $cont=$result1[0]->student;
             $user_id=$cont+400000;
               $getmail="select email from edu_admission WHERE admisn_no='".$admisn_no."'";
     	      $resultset12 = $this->db->query($getmail);
              
             foreach($resultset12->result() as $rows){}
             $email=$rows->email;
              $to = $email;
         $subject = '"Welcome Message"';
         $htmlContent = '

           <html>
           <head>  <title></title>
           </head>
           <body style="background-color:beige;">

             <table cellspacing="0" style=" width: 300px; height: 200px;">

                   <tr>
                       <th>Email:</th><td>'.$email.'</td>
                   </tr>
                   <tr>
                       <th>Username :</th><td>'.$user_id.'</td>
                   </tr>
                   <tr>
                       <th>Password:</th><td>'.$OTP.'</td>
                   </tr>
                   <tr>
                       <th></th><td><a href="'.base_url() .'">Click here  to Login</a></td>
                   </tr>
               </table>
           </body>
           </html>';

       // Set content-type header for sending HTML email
       $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
       // Additional headers
       $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
       mail($to,$subject,$htmlContent,$headers);


             
             $stude_insert="INSERT INTO edu_users (name,user_name,user_password,user_type,student_id,created_date,updated_date,status) VALUES ('$name','$user_id',md5($OTP),'3','$admission_id',NOW(),NOW(),'DA')";
             $resultset=$this->db->query($stude_insert);

      		 $query2="UPDATE edu_admission SET enrollment='1' WHERE admisn_no='$admisn_no'";
      		 $resultset=$this->db->query($query2);

            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "Admission Already Exist");
            return $data;
          }

       }

	   function add_enrollment($admisn_no)
	   {
		    $query="SELECT admission_id,admisn_year,name,admisn_no FROM edu_admission WHERE admisn_no='$admisn_no'";
		    $res=$this->db->query($query);
            return $res->result();
	   }

	    function get_current_years()
		{
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
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

       //GET ALL Admission Form get_enrollmentid

       function get_all_enrollment(){
         $query="SELECT e.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_enrollment as e,edu_classmaster as cm, edu_sections as s,edu_class as c WHERE e.class_id=cm.class_sec_id and cm.class=c.class_id and cm.section=s.sec_id ORDER BY enroll_id DESC";
         $res=$this->db->query($query);
         return $res->result();
       }


       function get_enrollmentid($admisn_no){
         $query="SELECT * FROM edu_enrollment WHERE admisn_no='$admisn_no'";
         $res=$this->db->query($query);
         return $res->result();
       }

//Update enrollment

        function save_enrollment($admit_year,$admit_date,$name,$class,$status,$enroll_id,$admisn_no,$admission_id){
           $query="UPDATE edu_enrollment SET admit_year='$admit_year',admit_date='$admit_date',name='$name',class_id='$class',status='$status' WHERE enroll_id='$enroll_id' AND admisn_no='$admisn_no'";
           $res=$this->db->query($query);

		   $query1="UPDATE edu_admission SET name='$name' WHERE admisn_no='$admisn_no'";
           $res1=$this->db->query($query1);

		   $query2="UPDATE edu_users SET name='$name' WHERE student_id='$admission_id'";
           $res1=$this->db->query($query2);

           if($res){
             $data= array("status" => "success");
             return $data;
           }else{
             $data= array("status" => "Failed To update");
             return $data;
           }
        }
       function de_enroll($enroll_id)
	   {
         $query="UPDATE edu_enrollment SET status='DA' WHERE enroll_id='$enroll_id'";
         $res=$this->db->query($query);
         $data= array("status" => "De Active Successfully");
         return $data;
       }

	    function getData($admisno)
		{
		  $query = "select name,admission_id from edu_admission WHERE admisn_no='".$admisno."'";
     	  $resultset = $this->db->query($query);
		  foreach ($resultset->result() as $rows)
		  {
		   echo $rows->name;
		   //echo $rows->admission_id;
		   exit;
		  }

		}

		function getData1($admisno)
		{
		   $query = "select name from edu_enrollment WHERE admisn_no='".$admisno."'";
     	  $resultset = $this->db->query($query);
		  return  count($resultset->result());
		}


		 public function search(Request $request)
           {
              $keywords = $request->get('keywords');
              $suggestions = Search::where('keywords', 'LIKE', '%'.$keywords.'%')->get();
              return $suggestions;
           }
}
?>

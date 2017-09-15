<?php

Class Admissionmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//CREATE ADMISSION

        function ad_create($admission_year,$admission_no,$emsi_num,$formatted_date,$name,$sex,$dob_date,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$language,$mobile,$sec_mobile,$email,$sec_email,$userFileName,$last_sch,$last_studied,$qual,$tran_cert,$recod_sheet,$status)
		{
          /* $check_number="SELECT * FROM edu_admission WHERE mobile='$mobile'";
          $res_number=$this->db->query($check_number);
          if($res_number->num_rows()>=1){
            $data= array("status" => "Already Mobile Number Exist");
            return $data;
          }
            $check_email="SELECT * FROM edu_admission WHERE email='$email'";
            $result=$this->db->query($check_email);
            if($result->num_rows()==0){ */
				
            $query="INSERT INTO edu_admission (admisn_year,admisn_no,emsi_num,admisn_date,name,sex,dob,age,nationality,religion,community_class,community,mother_tongue,language,mobile,sec_mobile,email,sec_email,student_pic,last_sch_name,last_studied,qualified_promotion,	transfer_certificate,record_sheet,status,created_at) VALUES ('$admission_year','$admission_no','$emsi_num','$formatted_date','$name','$sex','$dob_date','$age','$nationality','$religion','$community_class','$community','$mother_tongue','$language','$mobile','$sec_mobile','$email','$sec_email','$userFileName','$last_sch','$last_studied','$qual','$tran_cert','$recod_sheet','$status',NOW())";

            $resultset1=$this->db->query($query);
		    $insert_id = $this->db->insert_id();

      			/* $sql1="SELECT admisn_no,name FROM edu_admission WHERE admission_id='$insert_id'";
      			$resultset1=$this->db->query($sql1);
                  $result1= $resultset1->result();
      			foreach ($result1 as $row)
                       {
      					$admisn=$row->admisn_no;
      					$aname=$row->name;
                       } */

      			  //   $sql="SELECT count(*) AS student FROM edu_admission" ;
      			  //  $resultsql=$this->db->query($sql);
              //        $result1= $resultsql->result();
              //        $cont=$result1[0]->student;
      			  //        $user_id=$cont+400000;
               //
               //
              //     $stude_insert="INSERT INTO edu_users (name,user_name,user_password,user_pic,user_type,student_id,created_date,updated_date,status) VALUES ('$name','$user_id',md5(123),'$userFileName','3','$insert_id',NOW(),NOW(),'A')";
              //     $resultset=$this->db->query($stude_insert);

          $data=array("status" => "success","last_id"=>$insert_id);
           return $data;
          /* }else{
            $data= array("status" => "Email Already Exist");
            return $data;
          } */
       }

       //GET ALL Admission Form
       function get_all_admission()
	   {
         //$query="SELECT * FROM  edu_admission ORDER BY admission_id DESC";
		$query= "SELECT a.name,a.admission_id,a.sex,a.mobile,a.email,a.status,a.enrollment,a.parents_status,a.parnt_guardn_id,
                  (select 
                     GROUP_CONCAT(p.name SEPARATOR ',')
                          from  edu_parents AS p
                            where
                               FIND_IN_SET (p.id,a.parnt_guardn_id)) as parentsname  
                                  FROM edu_admission as a  ORDER BY a.admission_id DESC";
         $res=$this->db->query($query);
         return $res->result();
       }
	   
	   function get_sorting_gender_details($gender)
		{
		  //$query="SELECT * FROM  edu_admission WHERE sex='$gender' ORDER BY admission_id DESC";
		  $query= "SELECT a.name,a.admission_id,a.sex,a.mobile,a.email,a.status,a.enrollment,a.parents_status,a.parnt_guardn_id,
                  (select 
                     GROUP_CONCAT(p.name SEPARATOR ',')
                          from  edu_parents AS p
                            where
                               FIND_IN_SET (p.id,a.parnt_guardn_id)) as parentsname  
                                  FROM edu_admission as a WHERE sex='$gender' ORDER BY a.admission_id DESC";
          $res=$this->db->query($query);
          return $res->result();
		}
		

       function get_ad_id($admission_id){
         $query="SELECT * FROM edu_admission WHERE admission_id='$admission_id'";
         $res=$this->db->query($query);
         return $res->result();
       }

       function get_ad_id1($admission_id){
         $query="SELECT * FROM edu_admission WHERE admission_id='$admission_id'";
         $res=$this->db->query($query);
         return $res->result();
       }
       function check_email($email){
         echo $query="SELECT * FROM edu_admission WHERE email='$email'";
         $res=$this->db->query($query);
         if($res->num->rows()!=0){
           $data="Email Already Exist";
           return $data;
         }
       }

       function save_ad($admission_id,$admission_year,$admission_no,$emsi_num,$admission_date,$name,$sex,$dob,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$lang,$mobile,$sec_mobile,$email,$sec_email,$userFileName,$last_sch,$last_studied,$qual,$tran_cert,$recod_sheet,$status){
       $query="UPDATE edu_admission SET admisn_year='$admission_year',admisn_no='$admission_no',emsi_num='$emsi_num',admisn_date='$admission_date',name='$name',sex='$sex',dob='$dob',age='$age',nationality='$nationality',religion='$religion',community_class='$community_class',community='$community',mother_tongue='$mother_tongue',language='$lang',mobile='$mobile',sec_mobile='$sec_mobile',email='$email',sec_email='$sec_email',student_pic='$userFileName',last_sch_name='$last_sch',last_studied='$last_studied',qualified_promotion='$qual',transfer_certificate='$tran_cert',record_sheet='$recod_sheet',status='$status',updated_at=NOW()  WHERE admission_id='$admission_id'";
       $res=$this->db->query($query);

	       $query6="UPDATE edu_users SET name='$name',updated_date=NOW() WHERE student_id='$admission_id' ";
	        $res=$this->db->query($query6);

			$query7="UPDATE edu_enrollment SET name='$name' WHERE admission_id='$admission_id' ";
	        $res=$this->db->query($query7);

         if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }

       }

	     function getData($email)
		   {
					$query = "SELECT * FROM edu_admission WHERE email='".$email."'";
					$resultset = $this->db->query($query);
					return count($resultset->result());
           }

		   function getData1($admission_no)
		   {
			        $query = "SELECT * FROM edu_admission WHERE admisn_no='".$admission_no."'";
					$resultset = $this->db->query($query);
					return  count($resultset->result());
		   }
	  function get_enrollment_admisno()
	  {
		   $sql="SELECT admission_id FROM edu_admission WHERE enrollment=0";
		   $res=$this->db->query($sql);
		   return $res->result();

	  }

	   //sorting 

 	    function get_sorting_admission_details()
		{
		   $sql="SELECT sex FROM edu_admission GROUP BY sex ";
		   $res=$this->db->query($sql);
		   return $res->result();
			
		}
		
		function checkcellnum($cell)
		{
			$query = "select mobile from edu_admission WHERE mobile='".$cell."'";
			$resultset = $this->db->query($query);
			return count($resultset->result());
		}
		
		
}
?>

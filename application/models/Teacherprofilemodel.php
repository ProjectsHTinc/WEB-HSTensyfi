<?php

Class Teacherprofilemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

  function getuser($user_id)
   {

     $query="SELECT ed.*,et.* FROM edu_users AS ed LEFT JOIN edu_teachers AS et ON ed.teacher_id=et.teacher_id WHERE ed.user_id='$user_id'";
     $resultset=$this->db->query($query);
     return $resultset->result();

	    // $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
      // 		$resultset=$this->db->query($query);
      // 		$row=$resultset->result();
      // 		foreach($row as $rows){}
      // 		$teacher_id=$rows->teacher_id;
      //    $query="SELECT * FROM edu_teachers WHERE teacher_id='$teacher_id'";
      //    $resultset=$this->db->query($query);
      //    return $resultset->result();
   }

   function get_teacheruser($user_id)
      {
         $query="SELECT * FROM edu_users WHERE user_id='$user_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }

  function updateprofile($user_id,$oldpassword,$newpassword)
  {
         $checkpassword="SELECT user_id FROM edu_users WHERE user_password='$oldpassword' AND user_id='$user_id'";
         $res=$this->db->query($checkpassword);
         if($res->num_rows()==1)
		 {
           $query="UPDATE edu_users SET user_password='$newpassword',updated_date=NOW() WHERE user_id='$user_id'";
           $ex=$this->db->query($query);
            $data= array("status" => "success");
           return $data;
         }else{
           $data= array("status" => "failure");
          return $data;
         }
       }


  function teacherprofileupdate($user_id,$teachername,$email,$sec_email,$sex,$dob,$age,$nationality,$religion,$mobile,$sec_phone,$community_class,$community,$address,$userFileName)
    {
	 $query="UPDATE edu_teachers SET name='$teachername',email='$email',sec_email='$sec_email',sex='$sex',dob='$dob',age='$age',nationality='$nationality',religion='$religion',community_class='$community_class',community='$community',phone='$mobile',sec_phone='$sec_phone',address='$address',update_at=NOW() WHERE teacher_id='$user_id'";

      $query1="UPDATE edu_users SET name='$teachername',user_pic='$userFileName',updated_date=NOW() WHERE teacher_id='$user_id' ";

	  $res1=$this->db->query($query1);

    	 $res=$this->db->query($query);
         if($res)
		 {
         $data= array("status" => "success");
         return $data;
        }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }
 }

}

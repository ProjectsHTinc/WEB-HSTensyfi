<?php

Class Parentprofilemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  
  function getuser($user_id)
   {
	   $query="SELECT ed.*,ep.* FROM edu_users AS ed LEFT JOIN edu_parents AS ep ON ed.parent_id=ep.id WHERE ed.user_id='$user_id'";
       $resultset=$this->db->query($query);
       return $resultset->result();
   }
  
    function get_parentuser($user_id)
      {
         $query="SELECT * FROM edu_users WHERE user_id='$user_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }
	   
	   function update_parents($user_id,$parent_id,$single,$admission_id,$father_name,$mother_name,$guardn_name,$occupation,$income,$address,$email,$email1,$home_phone,$office_phone,$mobile,$mobile1,$userFileName)
	    {
		     $query="SELECT parent_id FROM edu_users WHERE user_id='$user_id'";
             $resultset=$this->db->query($query); 
			 $row=$resultset->result();
			 foreach($row as $rows){}
			 $parent_id=$rows->parent_id;
			
            $query5="UPDATE edu_parents SET admission_id='$admission_id',father_name='$father_name',mother_name='$mother_name',guardn_name='$guardn_name',occupation='$occupation',income='$income',address='$address',email='$email',email1='$email1',home_phone='$home_phone',office_phone='$office_phone',mobile='$mobile',mobile1='$mobile1',update_at=NOW() WHERE  parent_id='$parent_id'";
            $res=$this->db->query($query5);
			 
			if(empty($father_name)) 
			  {
				$father_name=$guardn_name;
			  } 
			  
	        $query6="UPDATE edu_users SET name='$father_name',user_pic='$userFileName',updated_date=NOW() WHERE parent_id='$parent_id' ";
	        $res=$this->db->query($query6);

			
         if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }

      }
  function updateprofilepwd($user_id,$oldpassword,$newpassword)
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

 
  
 
}
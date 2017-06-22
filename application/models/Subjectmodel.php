<?php

Class Subjectmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL SECTION

       function getsubject(){
         $query="SELECT * FROM edu_subject ORDER BY subject_id DESC";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }


//CREATE SECTION NAME
       function addsubject($subjectname,$status){
           $check_class="SELECT * FROM edu_subject WHERE subject_name='$subjectname' AND status='$status'";
           $res=$this->db->query($check_class);
           if($res->num_rows()==0){
           $query="INSERT INTO edu_subject (subject_name,status) VALUES ('$subjectname','$status')";
           $resultset=$this->db->query($query);
           $data= array("status" => "success");
            return $data;
           }else{
             $data= array("status" => "Already exist");
              return $data;

         }


       }

//GET SPECIFIC SECTION NAME
       function update_subject($subject_id)
	   {
         $query="SELECT * FROM edu_subject WHERE subject_id='$subject_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }


//UPDATE SECTION NAME
       function save_subject($subject_name,$subject_id,$status)
	   {
         
          $query="UPDATE edu_subject SET subject_name='$subject_name',status='$status' WHERE subject_id='$subject_id'";
          $resultset=$this->db->query($query);
          $data= array("status" => "success");
          return $data;
        
       }

//DELETE SECTION NAME

       function delete_subject($subject_id){
           $query="DELETE FROM edu_subject WHERE subject_id='$subject_id'";
          $resultset=$this->db->query($query);
         $data= array("status" => "success");
         return $data;

       }

}
?>

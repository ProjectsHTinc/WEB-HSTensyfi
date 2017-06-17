<?php

Class Ondutymodel extends CI_Model
{

    public function __construct()
     {
        parent::__construct();
     }
  
    function get_teacher_onduty_details()
     {
    	 $query="SELECT du.*,t.teacher_id,t.name FROM edu_on_duty AS du,edu_teachers AS t WHERE du.user_type=2 AND du.user_id=t.teacher_id"; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
     }

     

    function edit_teacher($id)
    {
       $query="SELECT du.*,t.teacher_id,t.name FROM edu_on_duty AS du,edu_teachers AS t WHERE du.user_type=2 AND du.id='$id' AND du.user_id=t.teacher_id"; 
       $res=$this->db->query($query);
       $result=$res->result();
       return $result;

    }

   function update_groups_list($groups_name,$status,$user_id,$id)
    {

       $sql="UPDATE edu_groups SET group_name='$groups_name',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
    } 
}
	?>
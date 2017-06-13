<?php

Class Groupsmodel extends CI_Model
{

    public function __construct()
     {
        parent::__construct();
     }
  
    function getall_groups_list()
     {
    	 $query="SELECT * FROM edu_groups "; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
     }

     function create_group_list($groups_name,$status,$user_id)
     {
	     $sql="INSERT INTO edu_groups(group_name,status,created_by,created_at) VALUES ('$groups_name','$status','$user_id',NOW())";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
       
    }

    function edit_groups_list($id)
    {
       $query="SELECT * FROM edu_groups WHERE id='$id'"; 
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
<?php

Class Communicationmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct(); 

  }

    function get_teachers()
	 {
		 $query="SELECT * FROM edu_teachers";
         $resultset=$this->db->query($query);
         return $resultset->result();
	 }

	 function get_classes()
	 {
		 $query="SELECT * FROM  edu_class";
         $resultset=$this->db->query($query);
         return $resultset->result();
	 }

	 function communication_create($title,$notes,$formatted_date,$teacher,$class_name)
	 {

		 $query="INSERT INTO edu_communication(commu_title,commu_details,commu_date,teacher_id,class_id,status,created_at,updated_at) VALUES ('$title','$notes','$formatted_date','$teacher','$class_name','A',NOW(),NOW())";
		 $resultset=$this->db->query($query);
		 $data= array("status" => "success");
         return $data;
	 }

	 function view()
	 {
		 $query="SELECT * FROM edu_communication ORDER BY commu_id DESC";
         $res=$this->db->query($query);
         $result1=$res->result();
		 return $result1;
		 //return $result1[0]->teaher_id;
	 }

	 function get_class_id($user_id)
	 {
		/* $query="SELECT * FROM edu_communication where commu_id='$user_id'";
         $res=$this->db->query($query);
         $result1=$res->result();
		// return $result1;
		 return $result1[0]->teacher_id; */
	 }

	 function get_class_name($class_id)
	 {

			  /*  $query="SELECT name FROM edu_teachers WHERE teacher_id IN ($class_id) ";
			   $resultset2=$this->db->query($query);
			   //$result2= $resultset2->result();
			   foreach($resultset2->result() as $rows)
		        {
					 $name[]=$rows->name;
					//print_r($name);
					//return $name;
		       }
			  // $a=$result2[1]->name; */

	 }
	  function convert_id_name($cls_id)
        {
           /*
				// $query="select cm.class_sec_id,cm.class,cm.section,c.class_name,s.sec_name FROM edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE cm.class_sec_id='".$id->class."' AND c.class_id=cm.class AND s.sec_id=cm.section";
               $query="select cm.class_sec_id,cm.class,cm.section,c.class_name,s.sec_name FROM edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE cm.class_sec_id='".$id->class."' AND c.class_id=cm.class AND s.sec_id=cm.section";
               $resultset2=$this->db->query($query);
               $result2= $resultset2->result();

            return $result2; */
        }


   function edit_data($commu_id)
   {
	         $query1="SELECT * FROM edu_communication WHERE commu_id='$commu_id'";
             $res=$this->db->query($query1);
             return $res->result();
   }

	 function communication_update($id,$title,$notes,$date,$teacher,$class_name)
	 {
	  $query="UPDATE edu_communication SET commu_title='$title',commu_details='$notes',commu_date='$date',teacher_id='$teacher',class_id='$class_name' WHERE commu_id='$id'";
	 $res=$this->db->query($query);
	 if($res){
				 $data= array("status" => "success");
				 return $data;
			   }else{
				 $data= array("status" => "Failed to Update");
				 return $data;
			   }
	 }
      
	   function user_leaves()
	   {
		   $query="SELECT * FROM edu_user_leave ORDER BY leave_id desc";
		   $resultset=$this->db->query($query);
           $result= $resultset->result();
		   return $result;
		   
	   }

	  
	   function edit_leave($leave_id)
	   {
		 $que="SELECT * FROM edu_user_leave WHERE leave_id='$leave_id'";
		 $resultset1=$this->db->query($que);
		 $row=$resultset1->result();
		 return $row;
	 	 
	   }
	 
	   function update_leave($leave_id,$status)
	   {
         $query4="UPDATE edu_user_leave SET status='$status',updated_at=NOW() WHERE leave_id='$leave_id'"; 
         $result1=$this->db->query($query4);
		 if($result1){
				 $data= array("status" => "success");
				 return $data;
			   }else{
				 $data= array("status" => "Failed to Update");
				 return $data;
			   }

	   }


}
?>

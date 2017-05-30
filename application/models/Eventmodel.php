<?php

Class Eventmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL Years

        function get_cur_year(){
          $check_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
          $get_year=$this->db->query($check_year);
          foreach($get_year->result() as $current_year){}
          //
          if($get_year->num_rows()==1){
            $acd_year= $current_year->year_id;
            $data= array("status" =>"success","cur_year"=>$acd_year);
            //print_r($data);exit;
             return $data;
          }else{
            $data= array("status" =>"noYearfound");
            return $data;
          }

        }
       function create_event($event_date,$event_name,$event_details,$event_status){
         $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
          $query="INSERT INTO edu_events (year_id,event_name,event_date,event_details,status,created_at) VALUES ('$year_id','$event_name','$event_date','$event_details','$event_status',NOW())";
          $res=$this->db->query($query);
		  if($res){
            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "failed");
            return $data;
          }

       }

       //GET ALL TERMS

        function getall_events(){
          $query="SELECT * FROM edu_events ORDER BY event_id DESC";
          $result=$this->db->query($query);
          return $result->result();
        }
        function get_event_id($event_id){
          $query="SELECT * FROM edu_events WHERE event_id='$event_id'";
          $result=$this->db->query($query);
          return $result->result();
        }
        function save_event($event_id,$event_date,$event_name,$event_details,$event_status){
           $query="UPDATE edu_events SET event_name='$event_name',event_date='$event_date',event_details='$event_details',status='$event_status' WHERE event_id='$event_id'";
           $result=$this->db->query($query);
          if($result){
            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "failed");
            return $data;
          }
        }


        function getall_act_event(){
          $query="SELECT event_date as start,event_name as title,event_details as description FROM edu_events";
          $result=$this->db->query($query);
          return $result->result();
        }

		function save_sub_event($event_id,$sub_event_name,$co_name,$status)
		{
		  $check_event="SELECT * FROM edu_event_coordinator WHERE sub_event_name='$sub_event_name'";
          $result=$this->db->query($check_event);
          if($result->num_rows()==0)
		  {
        $query1="UPDATE edu_events SET sub_event_status='1' WHERE event_id='$event_id'";
         $result1=$this->db->query($query1);
			  $query="INSERT INTO edu_event_coordinator(event_id,sub_event_name,co_name_id,status,created_at) VALUES ('$event_id','$sub_event_name','$co_name','$status',NOW())";

			  $result=$this->db->query($query);
        //$last_id=$this->db->insert_id();


			 if($result){
              $data= array("status" => "success");
               return $data;
            }else{
				$data= array("status" => "failed");
				return $data;
		  }
		  }else{
			  $data= array("status" => "Event Name Already Exist");
            return $data;
		  }

	}
    function view_sub_event($event_id)
	{
		  $query="SELECT * FROM edu_event_coordinator WHERE event_id='$event_id'";
		  $result=$this->db->query($query);
          $res=$result->result();
		  return $res;

	}

	function edit_sub_event($co_id)
	{
		  $query="SELECT * FROM edu_event_coordinator WHERE co_id='$co_id'";
		  $result=$this->db->query($query);
          $res=$result->result();
		  return $res;

	}
	function update_sub_event($event_id,$co_id,$sub_event_name,$co_name,$status)
	{
		 $query="UPDATE edu_event_coordinator SET sub_event_name='$sub_event_name',co_name_id='$co_name',status='$status',updated_at=NOW() WHERE co_id='$co_id' AND event_id='$event_id'";

		 $result=$this->db->query($query);
          if($result){
            $data= array("status"=>"success","eventid"=>$event_id);
            return $data;
          }else{
            $data= array("status"=>"failed");
            return $data;
          }
	}

  function get_all_regularleave(){
    $query="SELECT eh.leave_list_date AS start,lm.leave_type AS title,lm.leave_type AS description FROM edu_holidays_list_history AS eh  LEFT OUTER JOIN edu_leavemaster AS lm ON lm.leave_id=eh.leave_masid";
    $result=$this->db->query($query);
    return $result->result();
  }

}
?>

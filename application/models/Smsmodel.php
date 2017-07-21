<?php
Class Smsmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct(); 

  }
  
  function send_sms_for_teacher_leave($number,$leave_type)
  {
	// http://173.45.76.227/send.aspx?username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS&numbers=12345&message=WELCOME
     //Thank you for the information. This is to inform you that your leave has been approved.
	 
	 $textmessage='Thank you for the information This is to inform you that your '.$leave_type.' has been approved';
	 
	 $textmsg =urlencode($textmessage);
	 
	$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';

	$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';
	
    $api_params = $api_element.'&numbers='.$number.'&message='.$textmsg;
	
	$smsgatewaydata = $smsGatewayUrl.$api_params;

	$url = $smsgatewaydata;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	$output = curl_exec($ch);
	curl_close($ch);

	if(!$output)
	{
      $output =  file_get_contents($smsgatewaydata);
    }

   /* if($return == '1')
   {
    return $output;        
   }else{ echo "send"; } */

 }

 function send_sms_for_teacher_substitution($tname,$sub_teacher,$sub_tname,$leave_date)
{
	$sql="SELECT teacher_id,name,phone FROM edu_teachers WHERE teacher_id='$sub_teacher'";
	$resultset=$this->db->query($sql);
	$res=$resultset->result();
	foreach($res as $cell){}
	$num=$cell->phone;
	
	$textmessage='This is to inform you that as '.$tname.' is on leave, '.$sub_tname.' will be the substitute teacher to fill in for '.$leave_date.' day/s.';
	 
	 $textmsg =urlencode($textmessage);
	 
	$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';

	$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';
	
    $api_params = $api_element.'&numbers='.$num.'&message='.$textmsg;
	
	$smsgatewaydata = $smsGatewayUrl.$api_params;

	$url = $smsgatewaydata;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	$output = curl_exec($ch);
	curl_close($ch);

	if(!$output)
	{
      $output =  file_get_contents($smsgatewaydata);
    }

   /* if($return == '1')
   {
    return $output;        
   }else{ echo "send"; } */

} 	

function send_circular_via_sms($title,$notes,$tusers_id,$pusers_id,$stusers_id)
{
	 //-----------------------------Teacher----------------------
	 
		   //print_r($tusers_id);exit;
		   
			 if($tusers_id!='')
			 {
			 $countid=count($tusers_id);
			 //echo $countid; 
			 
			 for ($i=0;$i<$countid;$i++) {
				$userid=$tusers_id[$i];
				$cirmat=$cm;
				$status1=$status;
				$circulardate1=$circulardate;
				$user_id1=$user_id;
				
				$sql="SELECT user_id,user_type,user_master_id FROM edu_users WHERE ";
				
			    $query3="INSERT INTO edu_circular(user_type,user_id,circular_master_id,circular_date,status,created_by,created_at) VALUES ('2','$userid','$cirmat','$circulardate1','$status1','$user_id1',NOW())";
		        $teacher=$this->db->query($query3);
			 }
			 if($teacher){
				 $data=array("status" =>"success");
				return $data;}else{$data = array("status" => "Failed");
				return $data;}
			} 
}
	
  
  
  
  
  
}
	  ?>
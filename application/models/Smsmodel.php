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
	
  
  
  
  
  
}
	  ?>
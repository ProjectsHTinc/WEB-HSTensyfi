<?php

Class Notificationmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct(); 

  }
  
  //$sMessage = "";
  
function sendPushNotification($data,$gsmkey) 
 {
		//echo "hi";exit;
	//Insert real GCM API key from the Google APIs Console   
	$apiKey = 'AAAADRDlvEI:APA91bFi-gSDCTCnCRv1kfRd8AmWu0jUkeBQ0UfILrUq1-asMkBSMlwamN6iGtEQs72no-g6Nw0lO5h4bpN0q7JCQkuTYsdPnM1yfilwxYcKerhsThCwt10cQUMKrBrQM2B3U3QaYbWQ';
	// Set POST request body
	$post = array(
				'registration_ids'  => $gsmkey,
				'data'              => $data,
				 );
	// Set CURL request headers 
	$headers = array( 
				'Authorization: key=' . $apiKey,
				'Content-Type: application/json'
					);
	// Initialize curl handle       
	$ch = curl_init();
	// Set URL to GCM push endpoint     
	curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
	// Set request method to POST       
	curl_setopt($ch, CURLOPT_POST, true);
	// Set custom request headers       
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	// Get the response back as string instead of printing it       
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set JSON post data
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
	// Actually send the request    
	$result = curl_exec($ch);

	// Handle errors
	//if (curl_errno($ch)) {
		//echo 'GCM error: ' . curl_error($ch);
	//}
	// Close curl handle
	curl_close($ch);	
	// Debug GCM response       
	//echo $result;	
  }
				  
       function send_circular_via_notification($title,$notes,$cdate,$tusers_id,$stusers_id,$pusers_id,$users_id)
         {
		// print_r($stusers_id);exit;
	        if($tusers_id!='')
			{
			     $countid=count($tusers_id);
			     //echo $countid;
                  $data=array(
				              'message' => $notes,
							  'ctitle'  => $title,
							  'vibrate'	=> 1,
			                  'sound'   => 1
							  );
							  
				 for($i=0;$i<$countid;$i++)
				 {
					$userid=$tusers_id[$i];
					//print_r($data);
					
					$sql="SELECT * FROM edu_notification WHERE user_id='$userid'";
					$tgsm=$this->db->query($sql);
				    $res=$tgsm->result();
					foreach($res as $row)
					{ } $gsmkey=array($row->gcm_key);
					//echo $gsmkey; 
					sendPushNotification($data,$gsmkey);
				 }	
				 //$sMessage="Send";
             }//teacher close
			 
			if($stusers_id!='')
			 {
			     $scountid=count($stusers_id);
			      //echo $scountid; exit;
			     //echo $countid;
                  $data=array(
				              'message' => $notes,
							  'ctitle'  => $title,
							  'vibrate'	=> 1,
			                  'sound'   => 1
							  );
							  
				for ($i=0;$i<$scountid;$i++)
				 {
					 $clsid=$stusers_id[$i];
					 //print_r($data);
					 $sql1="SELECT u.user_id,u.user_type,u.user_master_id,u.student_id,e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.name,a.mobile FROM edu_enrollment AS e,edu_admission AS a,edu_users AS u  WHERE e.class_id='$clsid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no AND u.user_type=3 AND a.admission_id=u.user_master_id AND a.admission_id=u.student_id";
					$scell=$this->db->query($sql1);
					$res1=$scell->result();
					foreach($res1 as $row1)
					{
					    $userid=$row1->user_id;
					    $sql="SELECT * FROM edu_notification WHERE user_id='$userid'";
						$tgsm=$this->db->query($sql);
						$res=$tgsm->result();
						foreach($res as $row)
						{  
  						  $gsmkey=array($row->gcm_key);
						   //print_r($gsmkey);
						   sendPushNotification($data,$gsmkey);
						 }
						
					}
					
				 }	
				 //$sMessage="Send";
             }//student close
			 
			 
			 
		/* if($stusers_id!='')
		     {
			     $scountid=count($stusers_id);
                  $data=array(
				              'message' => $notes,
							  'ctitle'  => $title,
							  'vibrate'	=> 1,
			                  'sound'   => 1
							  );
							  
				 for($i=0;$i<$scountid;$i++)
				 {
					
				    $clsid=$stusers_id[$i];
					 //print_r($data);
					$sql1="SELECT u.user_id,u.user_type,u.user_master_id,u.student_id,e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.name,a.mobile FROM edu_enrollment AS e,edu_admission AS a,edu_users AS u  WHERE e.class_id='$clsid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no AND u.user_type=3 AND a.admission_id=u.user_master_id AND a.admission_id=u.student_id";
					$scell=$this->db->query($sql1);
					$res1=$scell->result();
					foreach($res1 as $row1)
					{
					  $userid=$row1->user_id;
					  
					$sql="SELECT * FROM edu_notification WHERE user_id='$userid'";
					$sgsm=$this->db->query($sql);
				    $res=$sgsm->result();
					foreach($res as $row)
					{} $gsmkey=array($row->gcm_key);
					sendPushNotification($data,$gsmkey);
					
					}
				 }	
				 //$sMessage="Send";
             }//studentclose */
             	 
			 
			 
  }//function close
  
  
  
  
  
  
  
  
  
}//class close
  ?>
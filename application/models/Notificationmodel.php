<?php

Class Notificationmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct();

  }


       function send_circular_via_notification($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id)
         {

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
					//sendPushNotification($data,$gsmkey);
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

				 }
				 //$sMessage="Send";
             }//teacher close
	//----------------------------------------------Students----------------------------------------

			//print_r($stusers_id);
			if($stusers_id!='')
		     {
			      $scountid=count($stusers_id);
				  //echo $scountid;
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
					    {
						   $gsmkey=array($row->gcm_key);
						   //print_r($gsmkey);exit;
						  // sendPushNotification($data,$gsmkey);

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
							curl_close($ch);
					    }
					}
				 }
             }//studentclose

		//---------------------------------Parents-------------------------------------------

			 if($pusers_id!='')
		     {
			      $pcountid=count($pusers_id);
				  //echo $pcountid;
                  $data=array(
				              'message' => $notes,
							  'ctitle'  => $title,
							  'vibrate'	=> 1,
			                  'sound'   => 1
							  );

				 for($i=0;$i<$pcountid;$i++)
				 {

				    $clsid=$pusers_id[$i];
					 //print_r($data);
					 $sql2="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.parnt_guardn_id,u.user_id,u.user_type,u.user_master_id,u.parent_id,u.status,p.parent_id,p.mobile FROM edu_enrollment AS e,edu_admission AS a,edu_users AS u,edu_parents AS p WHERE e.class_id='$clsid' AND e.admission_id=a.admission_id AND e.admisn_no=a.admisn_no AND u.user_type=4 AND a.parnt_guardn_id=u.user_master_id AND a.parnt_guardn_id=u.parent_id AND p.parent_id=a.parnt_guardn_id AND u.status='Active' GROUP  BY u.user_id";
					$pcell=$this->db->query($sql2);
					$res2=$pcell->result();
					foreach($res2 as $row2)
					 {
					    $userid=$row2->user_id;
						 $sql="SELECT * FROM edu_notification WHERE user_id='$userid'";
						$pgsm=$this->db->query($sql);
						$pres=$pgsm->result();
						foreach($pres as $prow)
					    {
						   $gsmkey=array($prow->gcm_key);
						   //print_r($gsmkey);exit;
						  // sendPushNotification($data,$gsmkey);

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
							curl_close($ch);
					    }
					}
				 }
             }//Parents close


			  //------------------------------Admin-----------------------
			if($users_id!='')
			{
				$data=array(
				              'message' => $notes,
							  'ctitle'  => $title,
							  'vibrate'	=> 1,
			                  'sound'   => 1
							  );

				//------------------------Teacher----------------------
				if($users_id==2)
				{
				 //echo $users_id;

					$tsql="SELECT u.user_id,u.user_type,u.user_master_id,t.teacher_id,t.name,t.phone FROM edu_users AS u,edu_teachers AS t  WHERE u.user_type='$users_id' AND u.user_master_id=t.teacher_id AND u.status='Active'";
					$tres=$this->db->query($tsql);
					$tresult1=$tres->result();
					foreach($tresult1 as $trows)
					{
						$userid=$trows->user_id;

					     $sql="SELECT * FROM edu_notification WHERE user_id='$userid'";
						$tgsm=$this->db->query($sql);
						$tres1=$tgsm->result();
						foreach($tres1 as $trow)
					    {
						   $gsmkey=array($trow->gcm_key);
						   //print_r($gsmkey);exit;
						  // sendPushNotification($data,$gsmkey);

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
							curl_close($ch);
					    }
				  }
				}

				//---------------------------Students----------------------
				if($users_id==3)
				{
				   //echo $users_id;

					$ssql="SELECT u.user_id,u.user_type,u.user_master_id,u.name,a.admission_id,a.name FROM edu_users AS u,edu_admission AS a  WHERE u.user_type='$users_id' AND u.user_master_id=a.admission_id AND u.name=a.name AND u.status='Active'";
					$sres2=$this->db->query($ssql);
					$sresult2=$sres2->result();
					foreach($sresult2 as $srows1)
					{
					   $suserid=$srows1->user_id;

					    $sql="SELECT * FROM edu_notification WHERE user_id='$suserid'";
						$sgsm=$this->db->query($sql);
						$sres1=$sgsm->result();
						foreach($sres1 as $srow)
					    {
						   $gsmkey=array($srow->gcm_key);
						   //print_r($gsmkey);exit;

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
							curl_close($ch);
					    }

				   }
				}

					//---------------------------Parents--------------------------------------------
				if($users_id==4)
				{
				   //echo $users_id;

					$psql="SELECT u.user_id,u.user_type,u.user_master_id,u.name,p.parent_id FROM edu_users AS u,edu_parents AS p WHERE u.user_type='$users_id' AND u.user_master_id=p.parent_id AND u.status='Active'";
					$pres2=$this->db->query($psql);
					$presult2=$pres2->result();
					foreach($presult2 as $prows1)
					{
					     $puserid=$prows1->user_id;

					    $sql="SELECT * FROM edu_notification WHERE user_id='$puserid'";
						$pgsm=$this->db->query($sql);
						$pres1=$pgsm->result();
						foreach($pres1 as $prow)
					    {
						   $gsmkey=array($prow->gcm_key);
						   //print_r($gsmkey);exit;

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
							curl_close($ch);
					    }

				   }
				}

			}

  }




      function sendNotification($gcm_key,$notes)
            {
              $gcm_key = array($gcm_key);
              $data = array
                    (
                    'message' 	=> $notes,
                    'vibrate'	=> 1,
                    'sound'		=> 1

                    );

            // Insert real GCM API key from the Google APIs Console
            $apiKey = 'AAAADRDlvEI:APA91bFi-gSDCTCnCRv1kfRd8AmWu0jUkeBQ0UfILrUq1-asMkBSMlwamN6iGtEQs72no-g6Nw0lO5h4bpN0q7JCQkuTYsdPnM1yfilwxYcKerhsThCwt10cQUMKrBrQM2B3U3QaYbWQ';
            // Set POST request body
            $post = array(
                'registration_ids'  => $gcm_key,
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
            if (curl_errno($ch)) {
            //echo 'GCM error: ' . curl_error($ch);
            }
            // Close curl handle
            curl_close($ch);

            // Debug GCM response
            //echo $result;
            }


            //Group Notification
         function send_notification($group_id,$notes,$user_id){
           $class="SELECT egm.group_member_id,ep.email,ep.mobile,ep.parent_id FROM edu_grouping_members AS egm
           LEFT JOIN edu_users AS eu ON eu.user_id=egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id=eu.user_master_id
           LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ea.admission_id, ep.admission_id) LEFT JOIN edu_notification AS en ON en.user_id=eu.user_id
           WHERE  egm.group_title_id='$group_id'";
          $pcell=$this->db->query($class);
          $res2=$pcell->result();
          foreach($res2 as $result){
          $parent_id=$result->parent_id;
           $sql="SELECT eu.user_id,en.gcm_key FROM edu_users as eu left join edu_notification as en on eu.user_id=en.user_id WHERE user_type='4' and user_master_id='$parent_id'";
           $sgsm=$this->db->query($sql);
           $res=$sgsm->result();
           foreach($res as $row){
           $gcm_key=$row->gcm_key;
            $this->sendNotification($gcm_key,$notes);
          }

        }
      }




}

  ?>
